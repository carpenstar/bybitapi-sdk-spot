<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Options;

use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;

class BatchCancelOrderByIdOptions extends RequestEntity
{
    /**
     * Order ID, use commas to indicate multiple orderIds. Maximum of 100 ids.
     * @var string $orderIds
     */
    protected string $orderIds;

    /**
     * Order category. 0：normal order by default; 1：TP/SL order, Required for TP/SL order.
     * @var int $orderCategory
     */
    protected int $orderCategory;

    public function __construct()
    {
        $this->setRequiredField('orderIds');
    }

    /**
     * @param string $orderIds
     * @return BatchCancelOrderByIdOptions
     */
    public function setOrderIds(string $orderIds): self
    {
        $this->orderIds = $orderIds;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderIds(): string
    {
        return $this->orderIds;
    }

    /**
     * @param int $orderCategory
     * @return BatchCancelOrderByIdOptions
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