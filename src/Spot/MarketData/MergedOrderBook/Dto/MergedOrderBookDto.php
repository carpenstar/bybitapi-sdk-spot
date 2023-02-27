<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Dto;

use Carpenstar\ByBitAPI\Core\Builders\ResponseBuilder;
use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Interfaces\IMergedOrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Dto\OrderBookPriceDto;

class MergedOrderBookDto extends ResponseEntity implements IMergedOrderBookResponse
{
    /**
     * Current time, unit in millisecond
     * @var \DateTime $time
     */
    protected \DateTime $time;

    /**
     * Bid price and quantity, with best bid prices ranked from top to bottom
     * @var EntityCollection $bids
     */
    protected EntityCollection $bids;

    /**
     * Ask price and quantity, with best ask prices ranked from top to bottom
     * @var EntityCollection $asks
     */
    protected EntityCollection $asks;

    /**
     * @param array $data
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        $this->setTime($data['time']);

        $bids = new EntityCollection();
        if (!empty($data['bids'])) {
            array_map(function ($bid) use ($bids) {
                $bids->push(ResponseBuilder::make(OrderBookPriceDto::class, $bid));
            }, $data['bids']);
        }

        $asks = new EntityCollection();
        if (!empty($data['asks'])) {
            array_map(function ($ask) use ($asks) {
                $asks->push(ResponseBuilder::make(OrderBookPriceDto::class, $ask));
            }, $data['asks']);
        }

        $this->setBids($bids);
        $this->setAsks($asks);
    }

    /**
     * @param string $time
     * @return MergedOrderBookDto
     * @throws \Exception
     */
    private function setTime(string $time): self
    {
        $this->time = DateTimeHelper::makeFromTimestamp($time);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @param EntityCollection $asks
     * @return MergedOrderBookDto
     */
    private function setAsks(EntityCollection $asks): self
    {
        $this->asks = $asks;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getAsks(): EntityCollection
    {
        return $this->asks;
    }

    /**
     * @param EntityCollection $bids
     * @return MergedOrderBookDto
     */
    private function setBids(EntityCollection $bids): self
    {
        $this->bids = $bids;
        return $this;
    }

    /**
     * @return EntityCollection
     */
    public function getBids(): EntityCollection
    {
        return $this->bids;
    }
}