<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Dto;

use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Interfaces\ILastTradedPriceResponse;

class LastTradedPriceDto extends ResponseEntity implements ILastTradedPriceResponse
{
    /**
     * Name of the trading pair
     * @var string $symbol
     */
    private string $symbol;

    /**
     * Last traded price
     * @var float
     */
    private float $price;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this
            ->setSymbol($data['symbol'])
            ->setPrice($data['price']);
    }

    /**
     * @param string $symbol
     * @return LastTradedPriceDto
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
     * @param float $price
     * @return LastTradedPriceDto
     */
    private function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}