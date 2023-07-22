<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookPriceItemResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Request\OrderBookRequestOptions;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\OrderBook;
use PHPUnit\Framework\TestCase;

class OrderBookTest extends TestCase
{
    private static string $orderBookApiResult = '{"retCode":0,"retMsg":"OK","result":{"asks":[["26847.07","0.026755"],["26847.09","0.018993"],["26847.11","0.023623"],["26847.13","0.054235"],["26847.15","0.02979"]],"bids":[["26844.02","0.017595"],["26844","0.020731"],["26843.98","0.039244"],["26843.96","0.035931"],["26843.94","0.053928"]],"time":1683984334496},"retExtInfo":{},"time":1683984334496}';

    public function testOrderBookRequest()
    {
        $bestBidAskEndpoint = RestBuilder::make(OrderBook::class, (new OrderBookRequestOptions())->setSymbol('BTCUSDT'));

        $reflectionWalletEndpoint = new \ReflectionClass($bestBidAskEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseClassname');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($bestBidAskEndpoint, []);
        $this->assertEquals(OrderBookResponse::class, $checkMethodResult);
    }

    public function testOrderBookResponse()
    {
        $orderBookData = (new CurlResponse(self::$orderBookApiResult))
            ->bindEntity(OrderBookResponse::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $orderBookData->getBody());


        /** @var OrderBookResponse $orderBook */
        while(!empty($orderBook = $orderBookData->getBody()->fetch())) {
            $this->assertInstanceOf(OrderBookResponse::class, $orderBook);
            $this->assertInstanceOf(\DateTime::class, $orderBook->getTime());
            $this->assertInstanceOf(EntityCollection::class, $orderBook->getAsks());
            $this->checkCollection($orderBook->getAsks());
            $this->assertInstanceOf(EntityCollection::class, $orderBook->getBids());
            $this->checkCollection($orderBook->getBids());
        }
    }

    private function checkCollection(EntityCollection $collection)
    {
        /** @var OrderBookPriceItemResponse $item */
        foreach ($collection->all() as $item) {
            $this->assertIsFloat($item->getPrice());
            $this->assertIsFloat($item->getQuantity());
        }
    }

}