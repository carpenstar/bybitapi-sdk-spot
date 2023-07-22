<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Response;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Interfaces\IPublicTradingRecordsResponse;

class PublicTradingRecordsResponse extends ResponseEntity implements IPublicTradingRecordsResponse
{
    /**
     * Order price
     * @var float $price
     */
    private float $price;

    /**
     * Current timestamp
     * @var \DateTime $time
     */
    private \DateTime $time;

    /**
     * Order quantity
     * @var float $quantity
     */
    private float $qty;

    /**
     * 0：Sell or taker order, 1：Buy maker order
     * @var bool $isBuyerMaker
     */
    private bool $isBuyerMaker;

    /**
     * 0：normal trade, 1：Paradigm block trade
     * @var int $type
     */
    private int $type;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this
            ->setPrice($data['price'])
            ->setQty($data['qty'])
            ->setTime($data['time'])
            ->setIsBuyerMaker((bool)$data['isBuyerMaker'])
            ->setType($data['type']);
    }

    /**
     * @param string $type
     * @return self
     */
    private function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param float $price
     * @return PublicTradingRecordsResponse
     */
    private function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $quantity
     * @return PublicTradingRecordsResponse
     */
    private function setQty(float $quantity): self
    {
        $this->qty = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->qty;
    }

    /**
     *
     * @param int $time
     */
    private function setTime(int $time): self
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
     * @param int $isBuyerMaker
     * @return PublicTradingRecordsResponse
     */
    private function setIsBuyerMaker(bool $isBuyerMaker): self
    {
        $this->isBuyerMaker = $isBuyerMaker;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsBuyerMaker(): bool
    {
        return $this->isBuyerMaker;
    }
}