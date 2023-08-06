<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Overrides\TestLastTradedPrice;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Request\LastTradedPriceRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Response\LastTradedPriceResponse;
use PHPUnit\Framework\TestCase;

class LastTradedPriceTest extends TestCase
{
    private static string $lastTradedPriceApiResponse = '{"retCode":0,"retMsg":"OK","result":{"symbol":"BTCUSDT","price":"26386.61"},"retExtInfo":{},"time":1683982585451}';

    public function testLastTradedPriceDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(LastTradedPriceResponse::class, json_decode(self::$lastTradedPriceApiResponse, true)['result']);
        $this->assertInstanceOf(LastTradedPriceResponse::class, $dto);
        $this->assertIsString($dto->getSymbol());
        $this->assertIsFloat($dto->getPrice());
    }

    public function testLastTradedPriceResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$lastTradedPriceApiResponse, CurlResponseHandler::class, LastTradedPriceResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testLastTradedPriceEndpoint()
    {
        $endpoint = RestBuilder::make(TestLastTradedPrice::class, (new LastTradedPriceRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$lastTradedPriceApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();
        $this->assertInstanceOf(LastTradedPriceResponse::class, $dto);
        $this->assertIsString($dto->getSymbol());
        $this->assertIsFloat($dto->getPrice());
    }
}