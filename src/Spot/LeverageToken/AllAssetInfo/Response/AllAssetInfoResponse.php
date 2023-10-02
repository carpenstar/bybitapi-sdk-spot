<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Response;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\AbstractResponse;
use Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Interfaces\AllAssetInfoResponseInterface;

class AllAssetInfoResponse extends AbstractResponse implements AllAssetInfoResponseInterface
{
    /**
     * Abbreviation of the LT
     * @var string $ltCode
     */
    private string $ltCode;

    /**
     * Full name of the LT
     * @var string $ltName
     */
    private string $ltName;

    /**
     * Max. purchase amount per transaction
     * @var float $maxPurchase
     */
    private float $maxPurchase;

    /**
     * Min. purchase amount per transaction
     * @var float $minPurchase
     */
    private float $minPurchase;

    /**
     * Max. purchase amount per day
     * @var float $maxPurchaseDaily
     */
    private float $maxPurchaseDaily;

    /**
     * Max. redemption amount per transaction
     * @var float $maxRedeem
     */
    private float $maxRedeem;

    /**
     * Min. redemption amount per transaction
     * @var float $minRedeem
     */
    private float $minRedeem;

    /**
     * Max. redemption amount per day
     * @var float $maxRedeemDaily
     */
    private float $maxRedeemDaily;

    /**
     * Purchase fees
     * @var float $purchaseFeeRate
     */
    private float $purchaseFeeRate;

    /**
     * Redemption fees
     * @var float $redeemFeeRate
     */
    private float $redeemFeeRate;

    /**
     * Whether the LT can be purchased or redeemed
     * @var string $status
     */
    private string $status;

    /**
     * Funding fees charged daily to users who hold LT
     * @var float $fundFee
     */
    private float $fundFee;

    /**
     * Timestamps when funding fees are charged
     * @var \DateTime $fundFeeTime
     */
    private \DateTime $fundFeeTime;

    /**
     * Management fees
     * @var float $manageFeeRate
     */
    private float $manageFeeRate;

    /**
     * Timestamps when management fees are charged
     * @var \DateTime $manageFeeTime
     */
    private \DateTime $manageFeeTime;

    /**
     * Application upper limit
     * @var float $total
     */
    private float $total;

    /**
     * Net asset value
     * @var float $netValue
     */
    private float $netValue;

    public function __construct(array $data)
    {
        $this
            ->setLtCode($data['ltCode'])
            ->setLtName($data['ltName'])
            ->setMaxPurchase($data['maxPurchase'])
            ->setMinPurchase($data['minPurchase'])
            ->setMaxPurchaseDaily($data['maxPurchaseDaily'])
            ->setMaxRedeem($data['maxRedeem'])
            ->setMaxRedeemDaily($data['maxRedeemDaily'])
            ->setPurchaseFeeRate($data['purchaseFeeRate'])
            ->setRedeemFeeRate($data['redeemFeeRate'])
            ->setStatus($data['status'])
            ->setFundFee($data['fundFee'])
            ->setFundFeeTime($data['fundFeeTime'])
            ->setManageFeeRate($data['manageFeeRate'])
            ->setManageFeeTime($data['manageFeeTime'])
            ->setTotal($data['total'])
            ->setNetValue($data['netValue']);
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
     * @return AllAssetInfoResponse
     */
    private function setLtCode(string $ltCode): self
    {
        $this->ltCode = $ltCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLtName(): string
    {
        return $this->ltName;
    }

    /**
     * @param string $ltName
     * @return AllAssetInfoResponse
     */
    private function setLtName(string $ltName): self
    {
        $this->ltName = $ltName;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxPurchase(): float
    {
        return $this->maxPurchase;
    }

    /**
     * @param float $maxPurchase
     * @return AllAssetInfoResponse
     */
    private function setMaxPurchase(float $maxPurchase): self
    {
        $this->maxPurchase = $maxPurchase;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinPurchase(): float
    {
        return $this->minPurchase;
    }

    /**
     * @param float $minPurchase
     * @return AllAssetInfoResponse
     */
    private function setMinPurchase(float $minPurchase): self
    {
        $this->minPurchase = $minPurchase;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxPurchaseDaily(): float
    {
        return $this->maxPurchaseDaily;
    }

    /**
     * @param float $maxPurchaseDaily
     * @return AllAssetInfoResponse
     */
    private function setMaxPurchaseDaily(float $maxPurchaseDaily): self
    {
        $this->maxPurchaseDaily = $maxPurchaseDaily;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxRedeem(): float
    {
        return $this->maxRedeem;
    }

    /**
     * @param float $maxRedeem
     * @return AllAssetInfoResponse
     */
    private function setMaxRedeem(float $maxRedeem): self
    {
        $this->maxRedeem = $maxRedeem;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinRedeem(): float
    {
        return $this->minRedeem;
    }

    /**
     * @param float $minRedeem
     * @return AllAssetInfoResponse
     */
    private function setMinRedeem(float $minRedeem): self
    {
        $this->minRedeem = $minRedeem;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxRedeemDaily(): float
    {
        return $this->maxRedeemDaily;
    }

    /**
     * @param float $maxRedeemDaily
     * @return AllAssetInfoResponse
     */
    private function setMaxRedeemDaily(float $maxRedeemDaily): self
    {
        $this->maxRedeemDaily = $maxRedeemDaily;
        return $this;
    }

    /**
     * @return float
     */
    public function getPurchaseFeeRate(): float
    {
        return $this->purchaseFeeRate;
    }

    /**
     * @param float $purchaseFeeRate
     * @return AllAssetInfoResponse
     */
    private function setPurchaseFeeRate(float $purchaseFeeRate): self
    {
        $this->purchaseFeeRate = $purchaseFeeRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getRedeemFeeRate(): float
    {
        return $this->redeemFeeRate;
    }

    /**
     * @param float $redeemFeeRate
     * @return AllAssetInfoResponse
     */
    private function setRedeemFeeRate(float $redeemFeeRate): self
    {
        $this->redeemFeeRate = $redeemFeeRate;
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
     * @param string $status
     * @return AllAssetInfoResponse
     */
    private function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return float
     */
    public function getFundFee(): float
    {
        return $this->fundFee;
    }

    /**
     * @param float $fundFee
     * @return AllAssetInfoResponse
     */
    private function setFundFee(float $fundFee): self
    {
        $this->fundFee = $fundFee;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFundFeeTime(): \DateTime
    {
        return $this->fundFeeTime;
    }

    /**
     * @param string $fundFeeTime
     * @return AllAssetInfoResponse
     */
    private function setFundFeeTime(string $fundFeeTime): self
    {
        $this->fundFeeTime = DateTimeHelper::makeFromTimestamp($fundFeeTime);
        return $this;
    }

    /**
     * @return float
     */
    public function getManageFeeRate(): float
    {
        return $this->manageFeeRate;
    }

    /**
     * @param float $manageFeeRate
     * @return AllAssetInfoResponse
     */
    private function setManageFeeRate(float $manageFeeRate): self
    {
        $this->manageFeeRate = $manageFeeRate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getManageFeeTime(): \DateTime
    {
        return $this->manageFeeTime;
    }

    /**
     * @param string $manageFeeTime
     * @return AllAssetInfoResponse
     */
    public function setManageFeeTime(string $manageFeeTime): self
    {
        $this->manageFeeTime = DateTimeHelper::makeFromTimestamp($manageFeeTime);
        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     * @return AllAssetInfoResponse
     */
    public function setTotal(float $total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetValue(): float
    {
        return $this->netValue;
    }

    /**
     * @param float $netValue
     * @return AllAssetInfoResponse
     */
    private function setNetValue(float $netValue): self
    {
        $this->netValue = $netValue;
        return $this;
    }
}