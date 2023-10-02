<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Interfaces;

interface ICancelOrderResponseInterface
{
    public function getOrderId(): ?int;
    public function getOrderLinkId(): string;
    public function getSymbol(): string;
    public function getStatus(): string;
    public function getAccountId(): ?int;
    public function getOrderPrice(): ?float;
    public function getCreateTime(): \DateTime;
    public function getOrderQty(): ?float;
    public function getExecQty(): ?float;
    public function getTimeInForce(): ?string;
    public function getOrderType(): ?string;
    public function getSide(): ?string;
}