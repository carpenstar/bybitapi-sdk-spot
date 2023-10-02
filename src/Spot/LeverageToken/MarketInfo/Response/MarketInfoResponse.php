<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Response;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\AbstractResponse;
use Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Interfaces\IMarketInfoResponseInterface;

class MarketInfoResponse extends AbstractResponse implements IMarketInfoResponseInterface
{
    /**
     * Total position value = basket value * total circulation
     * @var float $basket
     */
    private float $basket;

    /**
     * Circulating supply in the secondary market
     * @var float $circulation
     */
    private float $circulation;

    /**
     * Real Leverage calculated by last traded price.
     * @var float $leverage
     */
    private float $leverage;

    /**
     * Abbreviation of the LT
     * @var string $ltCode
     */
    private string $ltCode;

    /**
     * Net asset value
     * @var float $nav
     */
    private float $nav;

    /**
     * Update time for net asset value
     * @var \DateTime $navTime
     */
    private \DateTime $navTime;

    public function __construct(array $data)
    {
        $this
            ->setBasket((float) $data['basket'])
            ->setLeverage((float) $data['leverage'])
            ->setNav((float) $data['nav'])
            ->setCirculation((float) $data['circulation'])
            ->setNavTime($data['navTime'])
            ->setLtCode($data['ltCode']);
    }

    /**
     * @return float
     */
    public function getBasket(): float
    {
        return $this->basket;
    }

    /**
     * @param float $basket
     * @return MarketInfoResponse
     */
    private function setBasket(float $basket): self
    {
        $this->basket = $basket;
        return $this;
    }

    /**
     * @return float
     */
    public function getCirculation(): float
    {
        return $this->circulation;
    }

    /**
     * @param float $circulation
     * @return MarketInfoResponse
     */
    private function setCirculation(float $circulation): self
    {
        $this->circulation = $circulation;
        return $this;
    }

    /**
     * @return float
     */
    public function getLeverage(): float
    {
        return $this->leverage;
    }

    /**
     * @param float $leverage
     * @return MarketInfoResponse
     */
    private function setLeverage(float $leverage): self
    {
        $this->leverage = $leverage;
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
     * @return MarketInfoResponse
     */
    private function setLtCode(string $ltCode): self
    {
        $this->ltCode = $ltCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getNav(): float
    {
        return $this->nav;
    }

    /**
     * @param float $nav
     * @return MarketInfoResponse
     */
    private function setNav(float $nav): self
    {
        $this->nav = $nav;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getNavTime(): \DateTime
    {
        return $this->navTime;
    }

    /**
     * @param int $navTime
     * @return MarketInfoResponse
     */
    private function setNavTime(int $navTime): self
    {
        $this->navTime = DateTimeHelper::makeFromTimestamp($navTime);
        return $this;
    }


}