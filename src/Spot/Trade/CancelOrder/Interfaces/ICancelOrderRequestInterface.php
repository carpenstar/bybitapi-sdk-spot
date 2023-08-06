<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Interfaces;

interface ICancelOrderRequestInterface
{
    public function getOrderId(): ?int;
    public function getOrderLinkId(): ?string;
    public function getOrderCategory(): int;
}