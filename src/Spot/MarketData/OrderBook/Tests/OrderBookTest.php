<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookPriceItemResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Overrides\TestOrderBook;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Request\OrderBookRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookPriceItemResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookResponse;
use PHPUnit\Framework\TestCase;

class OrderBookTest extends TestCase
{
    private static string $orderBookApiResult = '{"retCode":0,"retMsg":"OK","result":{"asks":[["26847.07","0.026755"],["26847.09","0.018993"],["26847.11","0.023623"],["26847.13","0.054235"],["26847.15","0.02979"]],"bids":[["26844.02","0.017595"],["26844","0.020731"],["26843.98","0.039244"],["26843.96","0.035931"],["26843.94","0.053928"]],"time":1683984334496},"retExtInfo":{},"time":1683984334496}';

    public function testOrderBookDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(OrderBookResponse::class, json_decode(self::$orderBookApiResult, true)['result']);
        $this->assertInstanceOf(OrderBookResponse::class, $dto);

        /** @var OrderBookPriceItemResponse $bid */
        while(!empty($bid = $dto->getBids()->fetch())) {
            $this->assertIsFloat($bid->getPrice());
            $this->assertIsFloat($bid->getQuantity());
        }

        /** @var OrderBookPriceItemResponse $ask */
        while(!empty($ask = $dto->getAsks()->fetch())) {
            $this->assertIsFloat($ask->getPrice());
            $this->assertIsFloat($ask->getQuantity());
        }
    }

    public function testOrderBookResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$orderBookApiResult, CurlResponseHandler::class, OrderBookResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testOrderBookEndpoint()
    {
        $endpoint = RestBuilder::make(TestOrderBook::class, (new OrderBookRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$orderBookApiResult);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();

        $this->assertInstanceOf(OrderBookResponse::class, $dto);
        $this->assertInstanceOf(\DateTime::class, $dto->getTime());

        /** @var MergedOrderBookPriceItemResponse $bid */
        while(!empty($bid = $dto->getBids()->fetch())) {
            $this->assertIsFloat($bid->getPrice());
            $this->assertIsFloat($bid->getQuantity());
        }

        /** @var MergedOrderBookPriceItemResponse $ask */
        while(!empty($ask = $dto->getAsks()->fetch())) {
            $this->assertIsFloat($ask->getPrice());
            $this->assertIsFloat($ask->getQuantity());
        }
    }
}