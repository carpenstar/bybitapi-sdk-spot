<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class COResponse extends ResponseEntity
{
    /**
     * Order ID
     * @var int $orderId
     */
    private ?int $orderId;

    /**
     * User-generated order ID
     * @var string $orderLinkId
     */
    private ?string $orderLinkId;

    /**
     * Name of the trading pair
     * @var string $symbol
     */
    private ?string $symbol;

    /**
     * Order status
     * @var string $status
     */
    private ?string $status;

    /**
     * Account ID
     * @var int $accountId
     */
    private ?int $accountId;

    /**
     * Order price
     * @var float $orderPrice
     */
    private ?float $orderPrice;

    /**
     * Order Creation Time
     * @var \DateTime $createTime
     */
    private ?\DateTime $createTime;

    /**
     * Order quantity
     * @var float $orderQty
     */
    private ?float $orderQty;

    /**
     * Executed quantity
     * @var float $execQty
     */
    private ?float $execQty;

    /**
     * Time in force
     * @var string $timeInForce
     */
    private ?string $timeInForce;

    /**
     * Order type
     * @var string $orderType
     */
    private ?string $orderType;

    /**
     * Side. BUY, SELL
     * @var string $side
     */
    private ?string $side;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this
            ->setOrderId($data['orderId'])
            ->setOrderLinkId($data['orderLinkId'])
            ->setSymbol($data['symbol'])
            ->setStatus($data['status'])
            ->setAccountId($data['accountId'])
            ->setOrderPrice($data['orderPrice'])
            ->setCreateTime($data['createTime'])
            ->setOrderQty($data['orderQty'])
            ->setExecQty($data['execQty'])
            ->setTimeInForce($data['timeInForce'])
            ->setOrderType($data['orderType'])
            ->setSide($data['side']);
    }

    /**
     * @param int $orderId
     * @return COResponse
     */
    private function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param string $orderLinkId
     * @return COResponse
     */
    private function setOrderLinkId(?string $orderLinkId): self
    {
        $this->orderLinkId = $orderLinkId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderLinkId(): string
    {
        return $this->orderLinkId;
    }

    /**
     * @param string $symbol
     * @return COResponse
     */
    private function setSymbol(?string $symbol): self
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
     * @param string $status
     * @return COResponse
     */
    private function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param int $accountId
     * @return COResponse
     */
    private function setAccountId(?int $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    /**
     * @param float $orderPrice
     * @return COResponse
     */
    private function setOrderPrice(?float $orderPrice): self
    {
        $this->orderPrice = $orderPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getOrderPrice(): ?float
    {
        return $this->orderPrice;
    }

    /**
     * @param string|null $createTime
     * @return COResponse
     */
    private function setCreateTime(?string $createTime): self
    {
        $this->createTime = DateTimeHelper::makeFromTimestamp($createTime);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    /**
     * @param float $orderQty
     * @return COResponse
     */
    private function setOrderQty(?float $orderQty): self
    {
        $this->orderQty = $orderQty;
        return $this;
    }

    /**
     * @return float
     */
    public function getOrderQty(): ?float
    {
        return $this->orderQty;
    }

    /**
     * @param float $execQty
     * @return COResponse
     */
    private function setExecQty(?float $execQty): self
    {
        $this->execQty = $execQty;
        return $this;
    }

    /**
     * @return float
     */
    public function getExecQty(): ?float
    {
        return $this->execQty;
    }

    /**
     * @param string $timeInForce
     * @return COResponse
     */
    private function setTimeInForce(?string $timeInForce): self
    {
        $this->timeInForce = $timeInForce;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeInForce(): ?string
    {
        return $this->timeInForce;
    }

    /**
     * @param string $orderType
     * @return COResponse
     */
    private function setOrderType(?string $orderType): self
    {
        $this->orderType = $orderType;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    /**
     * @param string $side
     * @return COResponse
     */
    public function setSide(?string $side): self
    {
        $this->side = $side;
        return $this;
    }

    /**
     * @return string
     */
    public function getSide(): ?string
    {
        return $this->side;
    }
}