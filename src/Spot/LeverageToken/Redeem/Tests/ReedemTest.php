<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\Redeem\Tests;

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
use Carpenstar\ByBitAPI\Spot\LeverageToken\Redeem\Overrides\TestReedem;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Redeem\Request\ReedemRequest;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Redeem\Response\ReedemResponse;
use PHPUnit\Framework\TestCase;

class ReedemTest extends TestCase
{
    static private string $redeemResponse = '{"retCode":0,"retMsg":"success","result":{"id":"2087","ltCode":"DOT3LUSDT","orderAmount":"","orderQuantity":"50","orderStatus":"2","quantity":"","serialNo":"r001","timestamp":1662605726326,"valueCoin":"DOT3L"},"retExtInfo":{},"time":1662605727987}';

    public function testReedemDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(ReedemResponse::class, json_decode(self::$redeemResponse, true)['result']);
        $this->assertInstanceOf(ReedemResponse::class, $dto);
    }

    public function testReedemResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$redeemResponse, CurlResponseHandler::class, ReedemResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testReedemEndpoint()
    {
        $endpoint = RestBuilder::make(TestReedem::class, (new ReedemRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$redeemResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $item) {
            $dto = ResponseDtoBuilder::make(ReedemResponse::class, $item);
            $this->assertInstanceOf(ReedemResponse::class, $dto);
        }
    }
}