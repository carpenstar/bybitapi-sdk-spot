<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Response\KlineResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Kline;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Request\KlineRequestOptions;
use PHPUnit\Framework\TestCase;

class KlineTest extends TestCase
{
    private static string $klineApiResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"t":1683922260000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26413.58","h":"26444.15","l":"26413.58","o":"26440","v":"0.038419"},{"t":1683922320000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26405.44","h":"26420.02","l":"26402.16","o":"26413.58","v":"0.024527"},{"t":1683922380000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26390.96","h":"26406.3","l":"26390.95","o":"26405.44","v":"0.030255"},{"t":1683922440000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26397.07","h":"26399.92","l":"26390.95","o":"26390.96","v":"0.028976"},{"t":1683922500000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26390.98","h":"26397.07","l":"26390.95","o":"26397.07","v":"0.03669"},{"t":1683922560000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26409.24","h":"26409.24","l":"26389.68","o":"26390.98","v":"0.024756"},{"t":1683922620000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26443.27","h":"26453.24","l":"26390.95","o":"26409.24","v":"0.025462"},{"t":1683922680000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26451.86","h":"26451.89","l":"26440.91","o":"26443.27","v":"0.026304"},{"t":1683922740000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26426.59","h":"26451.86","l":"26424.63","o":"26451.86","v":"0.02513"},{"t":1683922800000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26429.66","h":"26435.5","l":"26419.97","o":"26426.59","v":"0.021732"},{"t":1683922860000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26426.6","h":"26435.01","l":"26421.77","o":"26429.66","v":"0.024761"},{"t":1683922920000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26404.56","h":"26434.34","l":"26401.55","o":"26426.6","v":"0.020718"},{"t":1683922980000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26403.24","h":"26414.24","l":"26386.61","o":"26404.56","v":"0.02995"},{"t":1683923040000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26391.6","h":"26403.24","l":"26391.57","o":"26403.24","v":"0.016944"},{"t":1683923100000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26386.62","h":"26391.6","l":"26386.61","o":"26391.6","v":"0.03116"}]},"retExtInfo":{},"time":1683982237622}';

    public function testKlineRequest()
    {
        $walletBalanceEndpoint = RestBuilder::make(Kline::class, (new KlineRequestOptions())->setSymbol('BTCUSDT'));

        $reflectionWalletEndpoint = new \ReflectionClass($walletBalanceEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseClassname');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($walletBalanceEndpoint, []);
        $this->assertEquals(KlineResponse::class, $checkMethodResult);
    }

    public function testKlineResponse()
    {
        $klineResponseData = (new CurlResponse(self::$klineApiResponse))
            ->bindEntity(KlineResponse::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $klineResponseData->getBody());

        $kline = $klineResponseData->getBody()->fetch();

        /** @var KlineResponse $kline */
        $this->assertInstanceOf(KlineResponse::class, $kline);
        $this->assertInstanceOf(\DateTime::class, $kline->getTime());
        $this->assertIsString($kline->getSymbol());
        $this->assertIsString($kline->getAlias());
        $this->assertIsFloat($kline->getClosePrice());
        $this->assertIsFloat($kline->getHighPrice());
        $this->assertIsFloat($kline->getLowPrice());
        $this->assertIsFloat($kline->getOpenPrice());
        $this->assertIsFloat($kline->getTradingVolume());
    }
}