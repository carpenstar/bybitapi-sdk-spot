<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Options;

use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\LastTradedPrice;

class LastTradedPriceOptions extends RequestEntity
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