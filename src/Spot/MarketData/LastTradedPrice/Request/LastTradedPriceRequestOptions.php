<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Request;

use Carpenstar\ByBitAPI\Core\Objects\OptionsEntity;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\LastTradedPrice;

class LastTradedPriceRequestOptions extends OptionsEntity
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
     * @return LastTradedPrice
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }
}