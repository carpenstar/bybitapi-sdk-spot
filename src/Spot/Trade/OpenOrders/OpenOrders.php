<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\OpenOrders;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;

class OpenOrders extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = '/spot/v3/private/open-orders';

    public function getQueryBagClassName(): string
    {
        return OOQueryBag::class;
    }

    protected function getResponseEntityClassName(): string
    {
        return OOResponse::class;
    }
}