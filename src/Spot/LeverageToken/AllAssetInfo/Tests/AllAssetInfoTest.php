<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Overrides\TestAllAssetInfo;
use Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Request\AllAssetInfoRequest;
use Carpenstar\ByBitAPI\Spot\LeverageToken\AllAssetInfo\Response\AllAssetInfoResponse;
use PHPUnit\Framework\TestCase;

class AllAssetInfoTest extends TestCase
{
    static private string $allAssetInfoResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"fundFee":"21.79800315","fundFeeTime":1673366400000,"ltCode":"EOS2LUSDT","ltName":"Long EOS (2x Leverage)","manageFeeRate":"0.00005","manageFeeTime":1673398800000,"maxPurchase":"5000","maxPurchaseDaily":"200000","maxRedeem":"861","maxRedeemDaily":"20000","minPurchase":"100","minRedeem":"17","netValue":"3.781571076822412032","purchaseFeeRate":"0.0005","redeemFeeRate":"0.0005","status":"1","total":"5000000","value":"23624.848996419293002588635"}]},"retExtInfo":{},"time": 1673345413125}';

    public function testAllAssetInfoDTOBuilder()
    {
        foreach (json_decode(self::$allAssetInfoResponse, true)['result']["list"] as $info) {
            $dto = ResponseDtoBuilder::make(AllAssetInfoResponse::class, $info);
            $this->assertInstanceOf(AllAssetInfoResponse::class, $dto);
        }
    }

    public function testAllAssetInfoResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$allAssetInfoResponse, CurlResponseHandler::class, AllAssetInfoResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testAllAssetInfoEndpoint()
    {
        $endpoint = RestBuilder::make(TestAllAssetInfo::class, (new AllAssetInfoRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$allAssetInfoResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $info) {
            $dto = ResponseDtoBuilder::make(AllAssetInfoResponse::class, $info);
            $this->assertInstanceOf(AllAssetInfoResponse::class, $dto);
        }
    }
}