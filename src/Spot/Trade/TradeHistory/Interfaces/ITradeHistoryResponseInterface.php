<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\TradeHistory\Interfaces;

interface ITradeHistoryResponseInterface
{
    public function getOrderId(): int;
    public function getSymbol(): string;
    public function getOrderQty(): float;
    public function getOrderPrice(): float;
    public function getCreatTime(): \DateTime;
    public function getExecFee(): float;
    public function getExecutionTime(): \DateTime;
    public function getFeeTokenId(): string;
    public function getId(): int;
    public function getIsBuyer(): int;
    public function getIsMaker(): int;
    public function getMakerRebate(): int;
    public function getMatchOrderId(): int;
    public function getTradeId(): int;
}