<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Dto;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class PublicTradingRecordsDto extends ResponseEntity
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
     * @var int $isBuyerMaker
     */
    private int $isBuyerMaker;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this
            ->setPrice($data['price'])
            ->setQty($data['qty'])
            ->setTime($data['time'])
            ->setIsBuyerMaker($data['isBuyerMaker']);
    }

    /**
     * @param float $price
     * @return PublicTradingRecordsDto
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
     * @return PublicTradingRecordsDto
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
     * @return PublicTradingRecordsDto
     */
    private function setIsBuyerMaker(int $isBuyerMaker): self
    {
        $this->isBuyerMaker = $isBuyerMaker;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsBuyerMaker(): int
    {
        return $this->isBuyerMaker;
    }
}