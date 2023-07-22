<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Request;

use Carpenstar\ByBitAPI\Core\Objects\OptionsEntity;

class MergedOrderBookRequestOptions extends OptionsEntity
{
    /**
     * Name of the trading pair
     * @required true
     * @var string $symbol
     */
    protected string $symbol;

    /**
     * Precision of the merged orderbook, 1 means 1 digit
     * @required false
     * @var int $scale
     */
    protected int $scale = 1;

    /**
     * Limit for data size. [1, 200]. Default: 100
     * @required false
     * @var int $limit
     */
    protected int $limit = 100;

    public function __construct()
    {
        $this->setRequiredField('symbol');
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     * @return MergedOrderBookRequestOptions
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return int
     */
    public function getScale(): int
    {
        return $this->scale;
    }

    /**
     * @param int $scale
     * @return MergedOrderBookRequestOptions
     */
    public function setScale(int $scale): self
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return MergedOrderBookRequestOptions
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }
}