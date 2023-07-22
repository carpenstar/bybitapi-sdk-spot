<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Response\KlineResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Response\TickersResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Request\TickersRequestOptions;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Tickers;
use PHPUnit\Framework\TestCase;

class TickersTest extends TestCase
{
    private static string $tickersApiResponse = '{"retCode":0,"retMsg":"OK","result":{"t":1683986136017,"s":"BTCUSDT","bp":"26799.99","ap":"26810.3","lp":"26810.3","o":"26875.03","h":"28073.41","l":"25992.06","v":"2389.959483","qv":"65100545.90244497"},"retExtInfo":{},"time":1683986136450}';

    public function testKlineRequest()
    {
        $walletBalanceEndpoint = RestBuilder::make(Tickers::class, (new TickersRequestOptions())->setSymbol('BTCUSDT'));

        $reflectionWalletEndpoint = new \ReflectionClass($walletBalanceEndpoint);
        $checkMethod = $reflectionWalletEndpoint->getMethod('getResponseClassname');
        $checkMethod->setAccessible(true);

        $checkMethodResult = $checkMethod->invokeArgs($walletBalanceEndpoint, []);
        $this->assertEquals(TickersResponse::class, $checkMethodResult);
    }

    public function testKlineResponse()
    {
        $tickersData = (new CurlResponse(self::$tickersApiResponse))
            ->bindEntity(TickersResponse::class)
            ->handle(EnumOutputMode::MODE_ENTITY);

        $this->assertInstanceOf(EntityCollection::class, $tickersData->getBody());

        $ticker = $tickersData->getBody()->fetch();

        /** @var KlineResponse $kline */
        $this->assertInstanceOf(TickersResponse::class, $ticker);
        $this->assertInstanceOf(\DateTime::class, $ticker->getTime());
        $this->assertIsFloat($ticker->getHighPrice());
        $this->assertIsFloat($ticker->getTradingVolume());
        $this->assertIsFloat($ticker->getOpenPrice());
        $this->assertIsFloat($ticker->getLowPrice());
        $this->assertIsFloat($ticker->getBestAskPrice());
        $this->assertIsFloat($ticker->getBestBidPrice());
        $this->assertIsFloat($ticker->getLastTradedPrice());
        $this->assertIsFloat($ticker->getTradingQuoteVolume());
        $this->assertIsString($ticker->getSymbol());
    }
}