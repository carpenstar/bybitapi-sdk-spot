<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Response;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\AbstractResponse;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Interfaces\IPurchaseResponseInterface;

class PurchaseResponse extends AbstractResponse implements IPurchaseResponseInterface
{
    /**
     * Actual purchase value of the LT
     * @var float $amount
     */
    private float $amount;

    /**
     * Transaction ID
     * @var string $id
     */
    private string $id;

    /**
     * Abbreviation of the LT
     * @var string $ltCode
     */
    private string $ltCode;

    /**
     * Order value of the LT
     * @var float $orderAmount
     */
    private float $orderAmount;

    /**
     * Order quantity of the LT
     * @var float $orderQuantity
     */
    private float $orderQuantity;

    /**
     * Order status. 1: Completed; 2: In progress; 3: Failed
     * @var int $orderStatus
     */
    private int $orderStatus;

    /**
     * Serial number
     * @var string $serialNo
     */
    private string $serialNo;

    /**
     * Timestamp
     * @var \DateTime $timestamp
     */
    private \DateTime $timestamp;

    /**
     * Quote asset
     * @var string $valueCoin
     */
    private string $valueCoin;

    public function __construct(array $data)
    {
        $this
            ->setAmount((float) $data['amount'])
            ->setId($data['id'])
            ->setLtCode($data['ltCode'])
            ->setOrderAmount((float) $data['orderAmount'])
            ->setOrderQuantity((float) $data['orderQuantity'])
            ->setOrderStatus($data['orderStatus'])
            ->setSerialNo($data['serialNo'])
            ->setTimestamp($data['timestamp'])
            ->setValueCoin($data['valueCoin']);
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return PurchaseResponse
     */
    private function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return PurchaseResponse
     */
    private function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLtCode(): string
    {
        return $this->ltCode;
    }

    /**
     * @param string $ltCode
     * @return PurchaseResponse
     */
    private function setLtCode(string $ltCode): self
    {
        $this->ltCode = $ltCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getOrderAmount(): float
    {
        return $this->orderAmount;
    }

    /**
     * @param float $orderAmount
     * @return PurchaseResponse
     */
    private function setOrderAmount(float $orderAmount): self
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getOrderQuantity(): float
    {
        return $this->orderQuantity;
    }

    /**
     * @param float $orderQuantity
     * @return PurchaseResponse
     */
    private function setOrderQuantity(float $orderQuantity): self
    {
        $this->orderQuantity = $orderQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderStatus(): int
    {
        return $this->orderStatus;
    }

    /**
     * @param int $orderStatus
     * @return PurchaseResponse
     */
    private function setOrderStatus(int $orderStatus): self
    {
        $this->orderStatus = $orderStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerialNo(): string
    {
        return $this->serialNo;
    }

    /**
     * @param string $serialNo
     * @return PurchaseResponse
     */
    private function setSerialNo(string $serialNo): self
    {
        $this->serialNo = $serialNo;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     * @return PurchaseResponse
     */
    private function setTimestamp(int $timestamp): self
    {
        $this->timestamp = DateTimeHelper::makeFromTimestamp($timestamp);
        return $this;
    }

    /**
     * @return string
     */
    public function getValueCoin(): string
    {
        return $this->valueCoin;
    }

    /**
     * @param string $valueCoin
     * @return PurchaseResponse
     */
    private function setValueCoin(string $valueCoin): self
    {
        $this->valueCoin = $valueCoin;
        return $this;
    }
}