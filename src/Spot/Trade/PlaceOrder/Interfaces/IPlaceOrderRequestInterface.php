<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Interfaces;

interface IPlaceOrderRequestInterface
{
    public function getSymbol(): ?string;
    public function getOrderType(): ?string;
    public function getSide(): ?string;
    public function getOrderLinkId(): ?string;
    public function getOrderQty(): ?string;
    public function getOrderPrice(): ?float;
    public function getTimeInForce(): ?string;
    public function getOrderCategory(): ?string;
    public function getTriggerPrice(): ?float;
}