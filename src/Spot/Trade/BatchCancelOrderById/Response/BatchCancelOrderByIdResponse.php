<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Response;

use Carpenstar\ByBitAPI\Core\Objects\AbstractResponse;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Interfaces\IBatchCancelOrderByIdResponseInterface;

/**
 * Notice:  If all success, it will be empty
 */
class BatchCancelOrderByIdResponse extends AbstractResponse implements IBatchCancelOrderByIdResponseInterface
{

    /**
     * Order ID
     * @var int $orderId
     */
    private int $orderId;

    /**
     * @var string $code;
     */
    private string $code;

    public function __construct(array $data)
    {
        $this
            ->setOrderId($data['orderId'])
            ->setCode($data['code']);
    }

    /**
     * @param int $orderId
     * @return BatchCancelOrderByIdResponse
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
     * @param string $code
     * @return BatchCancelOrderByIdResponse
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

}