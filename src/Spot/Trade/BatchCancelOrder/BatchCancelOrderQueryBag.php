<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder;

use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;

class BatchCancelOrderQueryBag extends RequestEntity
{
    /**
     * Name of the trading pair
     * @var string $symbol
     */
    protected string $symbol;

    /**
     * Side. BUY, SELL
     * @var string $side
     */
    protected string $side;

    /**
     * Order type. LIMIT in default. It allows multiple types, separated by comma, e.a LIMIT,LIMIT_MAKER
     * @var string $orderTypes
     */
    protected string $orderTypes;

    /**
     * Order category. 0：normal order by default; 1：TP/SL order, Required for TP/SL order.
     * @var int $orderCategory
     */
    protected int $orderCategory;

    public function __construct()
    {
        $this->setRequiredField('symbol');
    }

    /**
     * @param string $symbol
     * @return BatchCancelOrderQueryBag
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
     * @param string $side
     * @return BatchCancelOrderQueryBag
     */
    public function setSide(string $side): self
    {
        $this->side = $side;
        return $this;
    }

    /**
     * @return string
     */
    public function getSide(): string
    {
        return $this->side;
    }

    /**
     * @param string $orderTypes
     * @return BatchCancelOrderQueryBag
     */
    public function setOrderTypes(string $orderTypes): self
    {
        $this->orderTypes = $orderTypes;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderTypes(): string
    {
        return $this->orderTypes;
    }

    /**
     * @param int $orderCategory
     * @return BatchCancelOrderQueryBag
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