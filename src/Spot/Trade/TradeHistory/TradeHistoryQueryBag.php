<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\TradeHistory;

use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;

/**
 * Notice: If startTime is not specified, you can only query for records in the last 7 days.
 * If you want to query for records older than 7 days, startTime is required.
 * If the orderId is null, fromTicketId is passed, and toTicketId is null,
 * then the result is sorted by ticketId in ascend. Otherwise, the result is sorted by ticketId in descend.
 */
class TradeHistoryQueryBag extends RequestEntity
{
    /**
     * Name of the trading pair
     * @var string $symbol
     */
    protected string $symbol;

    /**
     * Order ID
     * @var int $orderId
     */
    protected int $orderId;

    /**
     * Default value is 50, max 50
     * @var int $limit
     */
    protected int $limit;

    /**
     * Start timestamp (ms)
     * @var int $startTime
     */
    protected int $startTime;

    /**
     * End time timestamp (ms)
     * @var int $endTime
     */
    protected int $endTime;

    /**
     * Query greater than the trade ID
     * @var int $fromTradeId
     */
    protected int $fromTradeId;

    /**
     * Query smaller than the trade ID
     * @var int $toTradeId
     */
    protected int $toTradeId;

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     * @return TradeHistoryQueryBag
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return TradeHistoryQueryBag
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }

    /**
     * @param int $endTime
     * @return TradeHistoryQueryBag
     */
    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @param int $startTime
     * @return TradeHistoryQueryBag
     */
    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return TradeHistoryQueryBag
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getToTradeId(): int
    {
        return $this->toTradeId;
    }

    /**
     * @param int $toTradeId
     * @return TradeHistoryQueryBag
     */
    public function setToTradeId(int $toTradeId): self
    {
        $this->toTradeId = $toTradeId;
        return $this;
    }

    /**
     * @return int
     */
    public function getFromTradeId(): int
    {
        return $this->fromTradeId;
    }

    /**
     * @param int $fromTradeId
     * @return TradeHistoryQueryBag
     */
    public function setFromTradeId(int $fromTradeId): self
    {
        $this->fromTradeId = $fromTradeId;
        return $this;
    }
}