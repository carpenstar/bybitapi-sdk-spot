<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Dto\InstrumentInfoDto;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\InstrumentInfo;
use PHPUnit\Framework\TestCase;

class InstrumentInfoTest extends TestCase
{
    private static string $instrumentInfoApiResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"name":"BTCUSDT","alias":"BTCUSDT","baseCoin":"BTC","quoteCoin":"USDT","basePrecision":"0.000001","quotePrecision":"0.00000001","minTradeQty":"0.00004","minTradeAmt":"1","maxTradeQty":"500","maxTradeAmt":"1200000","minPricePrecision":"0.01","category":"1","showStatus":"1","innovation":"0"},{"name":"ETHUSDT","alias":"ETHUSDT","baseCoin":"ETH","quoteCoin":"USDT","basePrecision":"0.00001","quotePrecision":"0.0000001","minTradeQty":"0.0005","minTradeAmt":"1","maxTradeQty":"100000000","maxTradeAmt":"1200000","minPricePrecision":"0.01","category":"1","showStatus":"1","innovation":"0"},{"name":"EOSUSDT","alias":"EOSUSDT","baseCoin":"EOS","quoteCoin":"USDT","basePrecision":"0.01","quotePrecision":"0.000001","minTradeQty":"0.01","minTradeAmt":"0.01","maxTradeQty":"90909.090909","maxTradeAmt":"10000","minPricePrecision":"0.0001","category":"1","showStatus":"1","innovation":"0"}]},"retExtInfo":{},"time":1683980087416}';

    public function testWalletRequest()
    {
        $walletBalanceEndpoint = RestBuilder::make(InstrumentInfo::class);

        $reflectionWalletEndpoint = new \ReflectionClass($walletBalanceEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseDTOClass');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($walletBalanceEndpoint, []);
        $this->assertEquals(InstrumentInfoDto::class, $checkMethodResult);
    }



    public function testWalletResponse()
    {
        $walletResponseData = (new CurlResponse(self::$instrumentInfoApiResponse))
            ->bindEntity(InstrumentInfoDto::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $walletResponseData->getBody());

        $this->assertNotEquals(0, $walletResponseData->getBody()->count());

        /** @var InstrumentInfoDto $checkItem */
        while(!empty($checkItem = $walletResponseData->getBody()->fetch())) {
            $this->assertInstanceOf(InstrumentInfoDto::class, $checkItem);
            $this->assertIsString($checkItem->getName());
            $this->assertIsString($checkItem->getAlias());
            $this->assertIsString($checkItem->getQuoteCoin());
            $this->assertIsString($checkItem->getBaseCoin());
            $this->assertIsFloat($checkItem->getBasePrecision());
            $this->assertIsFloat($checkItem->getQuotePrecision());
            $this->assertIsInt($checkItem->getInnovation());
            $this->assertIsInt($checkItem->getMaxTradeAmt());
            $this->assertIsFloat($checkItem->getMaxTradeQty());
            $this->assertIsFloat($checkItem->getMinTradeAmt());
            $this->assertIsFloat($checkItem->getMinTradeQty());
            $this->assertIsFloat($checkItem->getMinPricePrecision());
            $this->assertIsInt($checkItem->getCategory());
            $this->assertIsInt($checkItem->getShowStatus());
            $this->assertIsInt($checkItem->getInnovation());
        }
    }
}