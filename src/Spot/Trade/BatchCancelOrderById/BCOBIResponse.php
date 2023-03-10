<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById;

use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

/**
 * Notice:  If all success, it will be empty
 */
class BCOBIResponse extends ResponseEntity
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
     * @return BCOBIResponse
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
     * @return BCOBIResponse
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