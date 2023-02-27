<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Interfaces;

interface IInstrumentInfoResponse
{
    public function getName(): string;
    public function getAlias(): string;
    public function getBaseCoin(): string;
    public function getQuoteCoin(): string;
    public function getBasePrecision(): float;
    public function getQuotePrecision(): float;
    public function getMinTradeQty(): float;
    public function getMinTradeAmt(): float;
    public function getMaxTradeQty(): float;
    public function getMaxTradeAmt(): int;
    public function getMinPricePrecision(): float;
    public function getCategory(): int;
    public function getShowStatus(): int;
    public function getInnovation(): int;
}