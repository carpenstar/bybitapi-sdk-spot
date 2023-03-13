<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OpenOrders;

use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;

class OOQueryBag extends RequestEntity
{
    /**
     * Name of the trading pair
     * @var string $symbol
     */
    protected string $symbol;

    /**
     * Specify orderId to return all the orders that orderId of which are smaller than
     * this particular one for pagination purpose
     * @var int $orderId
     */
    protected int $orderId;

    /**
     * Limit for data size. [1, 500]. Default: 500
     * @var int $limit
     */
    protected int $limit = 500;

    /**
     * Order category. 0：normal order by default; 1：TP/SL order, Required for TP/SL order.
     * @var int $orderCategory
     */
    protected int $orderCategory;

    /**
     * @param string $symbol
     * @return $this
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
     * @return OOQueryBag
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
     * @return OOQueryBag
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
     * @param int $orderCategory
     * @return OOQueryBag
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