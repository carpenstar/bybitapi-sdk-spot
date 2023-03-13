<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Tickers;

use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;

class TQueryBag extends RequestEntity
{
    /**
     * Name of the trading pair
     * @required false
     * @var string $symbol
     */
    protected string $symbol;

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     * @return TQueryBag
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }
}