<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Interfaces;

interface IGetOrderResponseInterface
{
    public function getOrderLinkId(): string;
    public function getOrderId(): int;
    public function getOrderPrice(): float;
    public function getSymbol(): string;
    public function getAccountId(): int;
    public function getAvgPrice(): float;
    public function getCreateTime(): \DateTime;
    public function getCummulativeQuoteQty(): float;
    public function getExecQty(): float;
    public function getIsWorking(): int;
    public function getLocked(): float;
    public function getOrderQty(): float;
    public function getOrderType(): string;
    public function getSide(): string;
    public function getStatus(): string;
    public function getStopPrice(): float;
    public function getTimeInForce(): string;
    public function getUpdateTime(): \DateTime;
}