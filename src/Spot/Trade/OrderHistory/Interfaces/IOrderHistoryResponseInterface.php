<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OrderHistory\Interfaces;

interface IOrderHistoryResponseInterface
{
    public function getAccountId(): int;
    public function getSymbol(): string;
    public function getOrderLinkId(): string;
    public function getOrderId(): int;
    public function getOrderPrice(): float;
    public function getOrderQty(): float;
    public function getExecQty(): float;
    public function getCummulativeQuoteQty(): float;
    public function getAvgPrice(): float;
    public function getStatus(): string;
    public function getTimeInForce(): string;
    public function getOrderType(): string;
    public function getSide(): string;
    public function getStopPrice(): float;
    public function getCreateTime(): \DateTime;
    public function getUpdateTime(): \DateTime;
    public function getIsWorking(): int;
    public function getOrderCategory(): int;
    public function getTriggerPrice(): ?float;
}