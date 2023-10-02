<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Interfaces;

interface IGetOrderRequestInterface
{
    public function getOrderId(): string;
    public function getOrderLinkId(): string;
    public function getOrderCategory(): string;
}