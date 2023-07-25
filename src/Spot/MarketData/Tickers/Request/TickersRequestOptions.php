<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Request;

use Carpenstar\ByBitAPI\Core\Objects\AbstractParameters;

class TickersRequestOptions extends AbstractParameters
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
     * @return TickersRequestOptions
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }
}