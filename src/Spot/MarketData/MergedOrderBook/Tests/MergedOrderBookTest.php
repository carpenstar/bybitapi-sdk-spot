<?php
namespace Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Overrides\TestMergedOrderBook;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Request\MergedOrderBookRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookPriceItemResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookResponse;
use PHPUnit\Framework\TestCase;

class MergedOrderBookTest extends TestCase
{
    private static string $mergedOrderBookApiResponse = '{"retCode":0,"retMsg":"OK","result":{"asks":[["26796.1","0.011429"],["26796.9","0.000958"],["26800","0.026581"],["26807.7","0.000135"],["26810.2","0.000592"]],"bids":[["26796","0.077068"],["26795.9","0.115983"],["26711","0.002177"],["26693.1","0.001057"],["26683.9","0.001006"]],"time":1683983945762},"retExtInfo":{},"time":1683983945762}';

    public function testMergedOrderBookDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(MergedOrderBookResponse::class, json_decode(self::$mergedOrderBookApiResponse, true)['result']);
        $this->assertInstanceOf(MergedOrderBookResponse::class, $dto);
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

    public function testMergedOrderBookResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$mergedOrderBookApiResponse, CurlResponseHandler::class, MergedOrderBookResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testMergedOrderBookEndpoint()
    {
        $endpoint = RestBuilder::make(TestMergedOrderBook::class, (new MergedOrderBookRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$mergedOrderBookApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();

        $this->assertInstanceOf(MergedOrderBookResponse::class, $dto);
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