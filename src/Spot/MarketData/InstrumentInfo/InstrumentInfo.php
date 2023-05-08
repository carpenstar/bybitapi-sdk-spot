<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo;

use Carpenstar\ByBitAPI\Core\Endpoints\PublicEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Dto\InstrumentInfoDto;

/**
 * Get the spec of symbol information
 *
 * https://bybit-exchange.github.io/docs/spot/public/instrument
 */
class InstrumentInfo extends PublicEndpoint implements IGetEndpointInterface
{
    protected string $url = '/spot/v3/public/symbols';

    protected function getResponseEntityClassName(): string
    {
        return InstrumentInfoDto::class;
    }
}