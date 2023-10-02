<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Request\MarketInfoRequest;
use Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Response\MarketInfoResponse;

class MarketInfo extends PublicEndpoint implements IGetEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/private/reference";
    }

    protected function getResponseClassname(): string
    {
        return MarketInfoResponse::class;
    }

    protected function getRequestClassname(): string
    {
        return MarketInfoRequest::class;
    }
}