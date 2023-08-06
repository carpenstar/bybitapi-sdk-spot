<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Overrides\TestPurchase;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Request\PurchaseRequest;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Purchase\Response\PurchaseResponse;
use PHPUnit\Framework\TestCase;

class PurchaseTest extends TestCase
{
    static private string $purchaseResponse = '{"retCode":0,"retMsg":"success","result":{"amount":"100","id":"2085","ltCode":"DOT3LUSDT","orderAmount":"","orderQuantity":"","orderStatus":"2","serialNo":"x005","timestamp": 1662549845373,"valueCoin":"USDT"},"retExtInfo":{},"time":1662549845453}';

    public function testMarketInfoDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(PurchaseResponse::class, json_decode(self::$purchaseResponse, true)['result']);
        $this->assertInstanceOf(PurchaseResponse::class, $dto);
    }

    public function testMarketInfoResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$purchaseResponse, CurlResponseHandler::class, PurchaseResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testMarketInfoEndpoint()
    {
        $endpoint = RestBuilder::make(TestPurchase::class, (new PurchaseRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$purchaseResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $wallet) {
            $dto = ResponseDtoBuilder::make(PurchaseResponse::class, $wallet);
            $this->assertInstanceOf(PurchaseResponse::class, $dto);
        }
    }
}