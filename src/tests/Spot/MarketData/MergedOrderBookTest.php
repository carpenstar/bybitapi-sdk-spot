<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookPriceItemResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\MergedOrderBook;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Request\MergedOrderBookRequestOptions;
use PHPUnit\Framework\TestCase;

class MergedOrderBookTest extends TestCase
{
    private static string $mergedOrderBookApiResponse = '{"retCode":0,"retMsg":"OK","result":{"asks":[["26796.1","0.011429"],["26796.9","0.000958"],["26800","0.026581"],["26807.7","0.000135"],["26810.2","0.000592"]],"bids":[["26796","0.077068"],["26795.9","0.115983"],["26711","0.002177"],["26693.1","0.001057"],["26683.9","0.001006"]],"time":1683983945762},"retExtInfo":{},"time":1683983945762}';

    public function testMergedOrderBookRequest()
    {
        $bestBidAskEndpoint = RestBuilder::make(MergedOrderBook::class, (new MergedOrderBookRequestOptions())->setSymbol('BTCUSDT'));

        $reflectionWalletEndpoint = new \ReflectionClass($bestBidAskEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseClassname');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($bestBidAskEndpoint, []);
        $this->assertEquals(MergedOrderBookResponse::class, $checkMethodResult);
    }

    public function testMergedOrderBookResponse()
    {
        $lastTradedPriceResponseData = (new CurlResponse(self::$mergedOrderBookApiResponse))
            ->bindEntity(MergedOrderBookResponse::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $lastTradedPriceResponseData->getBody());


        /** @var MergedOrderBookResponse $lastTradedPrice */
        while(!empty($lastTradedPrice = $lastTradedPriceResponseData->getBody()->fetch())) {
            $this->assertInstanceOf(MergedOrderBookResponse::class, $lastTradedPrice);
            $this->assertInstanceOf(\DateTime::class, $lastTradedPrice->getTime());
            $this->assertInstanceOf(EntityCollection::class, $lastTradedPrice->getAsks());
            $this->checkCollection($lastTradedPrice->getAsks());
            $this->assertInstanceOf(EntityCollection::class, $lastTradedPrice->getBids());
            $this->checkCollection($lastTradedPrice->getBids());
        }
    }

    private function checkCollection(EntityCollection $collection)
    {
        /**
         * @var MergedOrderBookPriceItemResponse $item
         */
        foreach ($collection->all() as $item) {
            $this->assertIsFloat($item->getPrice());
            $this->assertIsFloat($item->getQuantity());
        }
    }
}