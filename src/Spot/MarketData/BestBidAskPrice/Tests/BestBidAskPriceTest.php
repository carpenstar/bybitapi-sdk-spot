<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Overrides\TestBestBidAskPrice;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Request\BestBidAskPriceRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Response\BestBidAskPriceResponse;
use PHPUnit\Framework\TestCase;

class BestBidAskPriceTest extends TestCase
{
    private static string $bestBidAskApiResponse = '{"retCode":0,"retMsg":"OK","result":{"symbol":"BTCUSDT","bidPrice":"26298.69","bidQty":"0.106418","askPrice":"26298.7","askQty":"0.008773","time":1683979447464},"retExtInfo":{},"time":1683979447820}';

    public function testBestBidAskPriceDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(BestBidAskPriceResponse::class, json_decode(self::$bestBidAskApiResponse, true)['result']);

        $this->assertInstanceOf(BestBidAskPriceResponse::class, $dto);
        $this->assertIsString($dto->getSymbol());
        $this->assertIsFloat($dto->getAskPrice());
        $this->assertIsFloat($dto->getBidPrice());
        $this->assertIsFloat($dto->getAskQty());
        $this->assertIsFloat($dto->getBidQty());
        $this->assertInstanceOf(\DateTime::class, $dto->getTime());
    }

    public function testBestBidAskPriceResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$bestBidAskApiResponse, CurlResponseHandler::class, BestBidAskPriceResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testBestBidAskPriceEndpoint()
    {
        $endpoint = RestBuilder::make(TestBestBidAskPrice::class, (new BestBidAskPriceRequest())->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$bestBidAskApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);
        $body = $body->fetch();

        $this->assertIsString($body->getSymbol());
        $this->assertIsFloat($body->getAskPrice());
        $this->assertIsFloat($body->getBidPrice());
        $this->assertIsFloat($body->getAskQty());
        $this->assertIsFloat($body->getBidQty());
        $this->assertInstanceOf(\DateTime::class, $body->getTime());
    }
}