<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\Response;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\AbstractResponse;
use Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\Interfaces\IPurchaseReedemHistoryResponseInterface;

class PurchaseRedeemHistoryResponse extends AbstractResponse implements IPurchaseReedemHistoryResponseInterface
{
    /**
     * Actual purchase quantity of the ETP
     * @var float $amount
     */
    private float $amount;

    /**
     * Last update time of the order status
     * @var \DateTime $execTime
     */
    private \DateTime $execTime;

    /**
     * Trading fees
     * @var float $fee
     */
    private float $fee;

    /**
     * Abbreviation of the LT
     * @var string $ltCode
     */
    private string $ltCode;

    /**
     * Order ID
     * @var string $orderId
     */
    private string $orderId;

    /**
     * Order status. 1: Completed; 2: In progress; 3: Failed
     * @var int $orderStatus
     */
    private int $orderStatus;

    /**
     * Order time
     * @var \DateTime $orderTime
     */
    private \DateTime $orderTime;

    /**
     * Order type; 1. Purchase; 2. Redemption
     * @var int $orderType
     */
    private int $orderType;

    /**
     * Serial number
     * @var string $serialNo
     */
    private string $serialNo;

    /**
     * Filled value
     * @var float $value
     */
    private float $value;

    /**
     * Quote asset
     * @var string $valueCoin
     */
    private string $valueCoin;


    public function __construct(array $data)
    {
        $this
            ->setAmount((float) $data['amount'])
            ->setExecTime((int) $data['excTime'])
            ->setFee((float) $data['fee'])
            ->setLtCode($data['ltCode'])
            ->setOrderId($data['orderId'])
            ->setOrderStatus($data['orderStatus'])
            ->setOrderTime($data['orderTime'])
            ->setOrderType($data['orderType'])
            ->setSerialNo($data['serialNo'])
            ->setValue((float) $data['value'])
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
     * @return PurchaseRedeemHistoryResponse
     */
    private function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExecTime(): \DateTime
    {
        return $this->execTime;
    }

    /**
     * @param int $execTime
     * @return PurchaseRedeemHistoryResponse
     */
    private function setExecTime(int $execTime): self
    {
        $this->execTime = DateTimeHelper::makeFromTimestamp($execTime);
        return $this;
    }

    /**
     * @return float
     */
    public function getFee(): float
    {
        return $this->fee;
    }

    /**
     * @param float $fee
     * @return PurchaseRedeemHistoryResponse
     */
    private function setFee(float $fee): self
    {
        $this->fee = $fee;
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
     * @return PurchaseRedeemHistoryResponse
     */
    private function setLtCode(string $ltCode): self
    {
        $this->ltCode = $ltCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     * @return PurchaseRedeemHistoryResponse
     */
    private function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;
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
     * @return PurchaseRedeemHistoryResponse
     */
    private function setOrderStatus(int $orderStatus): self
    {
        $this->orderStatus = $orderStatus;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderTime(): \DateTime
    {
        return $this->orderTime;
    }

    /**
     * @param int $orderTime
     * @return PurchaseRedeemHistoryResponse
     */
    private function setOrderTime(int $orderTime): self
    {
        $this->orderTime = DateTimeHelper::makeFromTimestamp($orderTime);
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderType(): int
    {
        return $this->orderType;
    }

    /**
     * @param int $orderType
     * @return PurchaseRedeemHistoryResponse
     */
    private function setOrderType(int $orderType): self
    {
        $this->orderType = $orderType;
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
     * @return PurchaseRedeemHistoryResponse
     */
    private function setSerialNo(string $serialNo): self
    {
        $this->serialNo = $serialNo;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return PurchaseRedeemHistoryResponse
     */
    private function setValue(float $value): self
    {
        $this->value = $value;
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
     * @return PurchaseRedeemHistoryResponse
     */
    private function setValueCoin(string $valueCoin): self
    {
        $this->valueCoin = $valueCoin;
        return $this;
    }
}