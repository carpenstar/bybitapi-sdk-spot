<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice;

use Carpenstar\ByBitAPI\Core\Objects\RequestEntity;

class LTPQueryBag extends RequestEntity
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
     * @return LTPQueryBag
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }
}