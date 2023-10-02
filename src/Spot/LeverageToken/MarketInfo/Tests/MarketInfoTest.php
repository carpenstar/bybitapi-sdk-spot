<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Account\WalletBalance\Overrides\TestWalletBalance;
use Carpenstar\ByBitAPI\Spot\Account\WalletBalance\Response\WalletBalanceResponse;
use Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Overrides\TestMarketInfo;
use Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Request\MarketInfoRequest;
use Carpenstar\ByBitAPI\Spot\LeverageToken\MarketInfo\Response\MarketInfoResponse;
use PHPUnit\Framework\TestCase;

class MarketInfoTest extends TestCase
{
    static private string $marketInfoResponse = '{"retCode":0,"retMsg":"OK","result":{"basket":"230666.700009559600667216","circulation":"24999.840207851103706443","leverage": "2.302545313639639446","ltCode":"EOS2L","nav":"3.790797803797135639","navTime":1673346095226},"retExtInfo":{},"time":1673346095239}';

    public function testMarketInfoDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(MarketInfoResponse::class, json_decode(self::$marketInfoResponse, true)['result']);
        $this->assertInstanceOf(MarketInfoResponse::class, $dto);
    }

    public function testMarketInfoResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$marketInfoResponse, CurlResponseHandler::class, MarketInfoResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testMarketInfoEndpoint()
    {
        $endpoint = RestBuilder::make(TestMarketInfo::class, (new MarketInfoRequest()));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$marketInfoResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $wallet) {
            $dto = ResponseDtoBuilder::make(MarketInfoResponse::class, $wallet);
            $this->assertInstanceOf(MarketInfoResponse::class, $dto);
        }
    }
}