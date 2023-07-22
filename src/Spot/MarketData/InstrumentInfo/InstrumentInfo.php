<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Core\Objects\StubQueryBag;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Response\InstrumentInfoResponse;

/**
 * Get the spec of symbol information
 *
 * https://bybit-exchange.github.io/docs/spot/public/instrument
 */
class InstrumentInfo extends PublicEndpoint implements IGetEndpointInterface
{
    protected function getEndpointUrl(): string
    {
        return "/spot/v3/public/symbols";
    }

    protected function getResponseClassname(): string
    {
        return InstrumentInfoResponse::class;
    }

    protected function getOptionsClassname(): string
    {
        return StubQueryBag::class;
    }
}