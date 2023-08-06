<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\Overrides\TestPurchaseRedeemHistory;
use Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\Request\PurchaseRedeemHistoryRequest;
use Carpenstar\ByBitAPI\Spot\LeverageToken\PurchaseRedeemHistory\Response\PurchaseRedeemHistoryResponse;
use PHPUnit\Framework\TestCase;

class PurchaseRedeemHistoryTest extends TestCase
{
    static private string $purchaseRedeemResponse = '{"retCode":0,"retMsg":"success","result":{"list":[{"amount":"","excTime":1662549752000,"fee":"","ltCode":"DOT3L","orderId":"2083","orderStatus":"3","orderTime":1662549752000,"orderType":1,"serialNo":"x003","value":"","valueCoin":"USDT"},{"amount":"","excTime":1662549702000,"fee":"","ltCode":"DOT3L","orderId":"2082","orderStatus":"3","orderTime":1662549702000,"orderType":1,"serialNo":"x002","value":"","valueCoin":"USDT"}]},"retExtInfo":{},"time":1662608374640}';

    public function testPurchaseRedeemHistoryDTOBuilder()
    {
        foreach (json_decode(self::$purchaseRedeemResponse, true)['result']["list"] as $item) {
            $dto = ResponseDtoBuilder::make(PurchaseRedeemHistoryResponse::class, $item);
            $this->assertInstanceOf(PurchaseRedeemHistoryResponse::class, $dto);
        }
    }

    public function testPurchaseRedeemHistoryResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$purchaseRedeemResponse, CurlResponseHandler::class, PurchaseRedeemHistoryResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testPurchaseRedeemHistoryEndpoint()
    {
        $endpoint = RestBuilder::make(TestPurchaseRedeemHistory::class, (new PurchaseRedeemHistoryRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$purchaseRedeemResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $item) {
            $dto = ResponseDtoBuilder::make(PurchaseRedeemHistoryResponse::class, $item);
            $this->assertInstanceOf(PurchaseRedeemHistoryResponse::class, $dto);
        }
    }
}