<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OpenOrders;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Dto\OpenOrderDto;
use Carpenstar\ByBitAPI\Spot\Trade\OpenOrders\Options\OpenOrdersOptions;

class OpenOrders extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = '/spot/v3/private/open-orders';

    public function getRequestOptionsDTOClass(): string
    {
        return OpenOrdersOptions::class;
    }

    protected function getResponseDTOClass(): string
    {
        return OpenOrderDto::class;
    }
}