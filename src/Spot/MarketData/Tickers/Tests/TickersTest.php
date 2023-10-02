<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Overrides\TestTickers;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Request\TickersRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Response\TickersResponse;
use PHPUnit\Framework\TestCase;

class TickersTest extends TestCase
{
    private static string $tickersApiResponse = '{"retCode":0,"retMsg":"OK","result":{"t":1683986136017,"s":"BTCUSDT","bp":"26799.99","ap":"26810.3","lp":"26810.3","o":"26875.03","h":"28073.41","l":"25992.06","v":"2389.959483","qv":"65100545.90244497"},"retExtInfo":{},"time":1683986136450}';

    public function testTickersDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(TickersResponse::class, json_decode(self::$tickersApiResponse, true)['result']);
        $this->assertInstanceOf(TickersResponse::class, $dto);
        $this->assertInstanceOf(\DateTime::class, $dto->getTime());
        $this->assertIsFloat($dto->getHighPrice());
        $this->assertIsFloat($dto->getTradingVolume());
        $this->assertIsFloat($dto->getOpenPrice());
        $this->assertIsFloat($dto->getLowPrice());
        $this->assertIsFloat($dto->getBestAskPrice());
        $this->assertIsFloat($dto->getBestBidPrice());
        $this->assertIsFloat($dto->getLastTradedPrice());
        $this->assertIsFloat($dto->getTradingQuoteVolume());
        $this->assertIsString($dto->getSymbol());
    }

    public function testTickersResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$tickersApiResponse, CurlResponseHandler::class, TickersResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testTickersEndpoint()
    {
        $endpoint = RestBuilder::make(TestTickers::class, (new TickersRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$tickersApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $body = $body->fetch();

        $this->assertInstanceOf(TickersResponse::class, $body);
        $this->assertInstanceOf(\DateTime::class, $body->getTime());
        $this->assertIsFloat($body->getHighPrice());
        $this->assertIsFloat($body->getTradingVolume());
        $this->assertIsFloat($body->getOpenPrice());
        $this->assertIsFloat($body->getLowPrice());
        $this->assertIsFloat($body->getBestAskPrice());
        $this->assertIsFloat($body->getBestBidPrice());
        $this->assertIsFloat($body->getLastTradedPrice());
        $this->assertIsFloat($body->getTradingQuoteVolume());
        $this->assertIsString($body->getSymbol());
    }
}