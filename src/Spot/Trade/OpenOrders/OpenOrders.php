<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OpenOrders;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Response\OpenOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Request\OpenOrdersResponseOptions;

class OpenOrders extends PrivateEndpoint implements IGetEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/private/open-orders";
    }

    protected function getResponseClassname(): string
    {
        return OpenOrderResponse::class;
    }

    protected function getOptionsClassname(): string
    {
        return OpenOrdersResponseOptions::class;
    }
}