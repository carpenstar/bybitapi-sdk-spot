<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;

/**
 * Info: If startTime and endTime are both not specified, it returns last 7 days records by default.
 * 3 days records for institutional clients.
 * Supports fetching 3 months worth of data per request. Returns data up to 6 months old.
 */
class OrderHistoryQueryBag extends RequestEntity
{
    /**
     * Name of the trading pair
     * @var string $symbol
     */
    protected string $symbol;

    /**
     * Specify orderId to return all the orders that orderId of which are smaller
     * than this particular one for pagination purpose
     * @var int $orderId
     */
    protected int $orderId;

    /**
     * Limit for data size. [1, 500]. Default: 100
     * @var int $limit = 100;
     */
    protected int $limit;

    /**
     * The start timestamp (ms)
     * @var int $startTime
     */
    protected int $startTime;

    /**
     * The end timestamp (ms)
     * @var int $endTime
     */
    protected int $endTime;

    /**
     * Order category. 0：normal order by default; 1：TP/SL order, Required for TP/SL order.
     * @var int $orderCategory
     */
    protected int $orderCategory;

    /**
     * @param string $symbol
     * @return OrderHistoryQueryBag
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param int $orderId
     * @return OrderHistoryQueryBag
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;
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
     * @param int $limit
     * @return OrderHistoryQueryBag
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
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
     * The start timestamp (ms)
     * @param string $dateTime
     * @return OrderHistoryQueryBag
     */
    public function setStartTime(string $dateTime): self
    {
        $this->startTime = DateTimeHelper::makeTimestampFromDateString($dateTime);
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
     * @param string $endTime
     * @return OrderHistoryQueryBag
     */
    public function setEndTime(string $endTime): self
    {
        $this->endTime = DateTimeHelper::makeTimestampFromDateString($endTime);
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
     * @param int $orderCategory
     * @return OrderHistoryQueryBag
     */
    public function setOrderCategory(int $orderCategory): self
    {
        $this->orderCategory = $orderCategory;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderCategory(): int
    {
        return $this->orderCategory;
    }
}