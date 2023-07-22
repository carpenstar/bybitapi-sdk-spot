<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Response\LastTradedPriceResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\LastTradedPrice;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Request\LastTradedPriceRequestOptions;
use PHPUnit\Framework\TestCase;

class LastTradedPriceTest extends TestCase
{
    private static string $lastTradedPriceApiResponse = '{"retCode":0,"retMsg":"OK","result":{"symbol":"BTCUSDT","price":"26386.61"},"retExtInfo":{},"time":1683982585451}';

    public function testLastTradedPriceRequest()
    {
        $bestBidAskEndpoint = RestBuilder::make(LastTradedPrice::class, (new LastTradedPriceRequestOptions())->setSymbol('BTCUSDT'));

        $reflectionWalletEndpoint = new \ReflectionClass($bestBidAskEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseClassname');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($bestBidAskEndpoint, []);
        $this->assertEquals(LastTradedPriceResponse::class, $checkMethodResult);
    }

    public function testLastTradedPriceResponse()
    {
        $lastTradedPriceResponseData = (new CurlResponse(self::$lastTradedPriceApiResponse))
            ->bindEntity(LastTradedPriceResponse::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $lastTradedPriceResponseData->getBody());

        $lastTradedPrice = $lastTradedPriceResponseData->getBody()->fetch();

        /** @var LastTradedPriceResponse $checkItem */
        $this->assertInstanceOf(LastTradedPriceResponse::class, $lastTradedPrice);
        $this->assertIsString($lastTradedPrice->getSymbol());
        $this->assertIsFloat($lastTradedPrice->getPrice());
    }
}