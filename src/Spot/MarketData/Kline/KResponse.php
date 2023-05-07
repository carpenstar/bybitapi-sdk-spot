<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Kline;

use Carpenstar\ByBitAPI\Core\Helpers\DateTimeHelper;
use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class KResponse extends ResponseEntity
{
    private \DateTime $time;

    /**
     * Name of the trading pair
     * @var string $symbol
     */
    private string $symbol;

    /**
     * Alias
     * @var string $alias
     */
    private string $alias;

    /**
     * Close price
     * @var float $closePrice
     */
    private float $closePrice;

    /**
     * High price
     * @var float $highPrice
     */
    private float $highPrice;

    /**
     * Low price
     * @var float $lowPrice
     */
    private float $lowPrice;

    /**
     * Open price
     * @var float $openPrice
     */
    private float $openPrice;

    /**
     * Trading volume
     * @var float $tradingVolume
     */
    private float $tradingVolume;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this
            ->setTime($data['t'])
            ->setSymbol($data['s'])
            ->setAlias($data['sn'])
            ->setClosePrice($data['c'])
            ->setHighPrice($data['h'])
            ->setLowPrice($data['l'])
            ->setOpenPrice($data['o'])
            ->setTradingVolume($data['v']);
    }

    /**
     * @param int $timestamp
     * @return KResponse
     */
    private function setTime(int $timestamp): self
    {
        $this->time = DateTimeHelper::makeFromTimestamp($timestamp);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @param string $symbol
     * @return KResponse
     */
    private function setSymbol(string $symbol): self
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
     * @param string $alias
     * @return KResponse
     */
    private function setAlias(string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param float $closePrice
     * @return KResponse
     */
    private function setClosePrice(float $closePrice): self
    {
        $this->closePrice = $closePrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getClosePrice(): float
    {
        return $this->closePrice;
    }

    /**
     * @param float $highPrice
     * @return KResponse
     */
    private function setHighPrice(float $highPrice): self
    {
        $this->highPrice = $highPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getHighPrice(): float
    {
        return $this->highPrice;
    }

    /**
     * @param float $lowPrice
     * @return KResponse
     */
    private function setLowPrice(float $lowPrice): self
    {
        $this->lowPrice = $lowPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getLowPrice(): float
    {
        return $this->lowPrice;
    }

    /**
     * @param float $openPrice
     * @return KResponse
     */
    private function setOpenPrice(float $openPrice): self
    {
        $this->openPrice = $openPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getOpenPrice(): float
    {
        return $this->openPrice;
    }

    /**
     * @param float $tradingVolume
     * @return KResponse
     */
    private function setTradingVolume(float $tradingVolume): self
    {
        $this->tradingVolume = $tradingVolume;
        return $this;
    }

    /**
     * @return float
     */
    public function getTradingVolume(): float
    {
        return $this->tradingVolume;
    }
}