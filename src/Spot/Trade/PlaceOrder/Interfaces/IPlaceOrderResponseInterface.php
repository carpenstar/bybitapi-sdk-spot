<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Interfaces;

interface IPlaceOrderResponseInterface
{
    public function getOrderId(): ?int;
    public function getOrderLinkId(): ?string;
    public function getSymbol(): ?string;
    public function getCreateTime(): \DateTime;
    public function getOrderPrice(): ?float;
    public function getOrderQty(): ?float;
    public function getStatusgetOrderType(): ?string;
    public function getSide(): ?string;
    public function getStatus(): ?string;
    public function getTimeInForce(): ?string;
    public function getAccountId(): ?string;
    public function getOrderCategory(): ?int;
    public function getTriggerPrice(): ?float;
}