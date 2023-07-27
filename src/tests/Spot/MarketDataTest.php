<?php
namespace Carpenstar\ByBitAPI\Tests\Spot;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumIntervals;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestBidAskPrice;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestKline;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestLastTradedPrice;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestMergedOrderBook;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestOrderBook;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestPublicTradingRecords;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestSpotInstrumentInfo;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestTickers;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Request\BestBidAskPriceRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Response\BestBidAskPriceResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Response\InstrumentInfoResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Request\KlineRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Response\KlineResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Request\LastTradedPriceRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Response\LastTradedPriceResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Request\MergedOrderBookRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookPriceItemResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Request\OrderBookRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookPriceItemResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Request\PublicTradingRecordsRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Response\PublicTradingRecordsResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Request\TickersRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Response\TickersResponse;
use PHPUnit\Framework\TestCase;


class MarketDataTest extends TestCase
{
    /**
     * SPOT - MARKET DATA
     * Best Bid Ask Price
     */
    private static string $bestBidAskApiResponse = '{"retCode":0,"retMsg":"OK","result":{"symbol":"BTCUSDT","bidPrice":"26298.69","bidQty":"0.106418","askPrice":"26298.7","askQty":"0.008773","time":1683979447464},"retExtInfo":{},"time":1683979447820}';

    public function testBestBidAskPriceDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(BestBidAskPriceResponse::class, json_decode(self::$bestBidAskApiResponse, true)['result']);

        $this->assertInstanceOf(BestBidAskPriceResponse::class, $dto);
        $this->assertIsString($dto->getSymbol());
        $this->assertIsFloat($dto->getAskPrice());
        $this->assertIsFloat($dto->getBidPrice());
        $this->assertIsFloat($dto->getAskQty());
        $this->assertIsFloat($dto->getBidQty());
        $this->assertInstanceOf(\DateTime::class, $dto->getTime());
    }

    public function testBestBidAskPriceResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$bestBidAskApiResponse, CurlResponseHandler::class, BestBidAskPriceResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testBestBidAskPriceEndpoint()
    {
        $endpoint = RestBuilder::make(TestBidAskPrice::class, (new BestBidAskPriceRequest())->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$bestBidAskApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);
        $body = $body->fetch();

        $this->assertIsString($body->getSymbol());
        $this->assertIsFloat($body->getAskPrice());
        $this->assertIsFloat($body->getBidPrice());
        $this->assertIsFloat($body->getAskQty());
        $this->assertIsFloat($body->getBidQty());
        $this->assertInstanceOf(\DateTime::class, $body->getTime());
    }

    /**
     * SPOT - MARKET DATA
     * InstrumentInfo
     */
    private static string $instrumentInfoApiResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"name":"BTCUSDT","alias":"BTCUSDT","baseCoin":"BTC","quoteCoin":"USDT","basePrecision":"0.000001","quotePrecision":"0.00000001","minTradeQty":"0.00004","minTradeAmt":"1","maxTradeQty":"500","maxTradeAmt":"1200000","minPricePrecision":"0.01","category":"1","showStatus":"1","innovation":"0"},{"name":"ETHUSDT","alias":"ETHUSDT","baseCoin":"ETH","quoteCoin":"USDT","basePrecision":"0.00001","quotePrecision":"0.0000001","minTradeQty":"0.0005","minTradeAmt":"1","maxTradeQty":"100000000","maxTradeAmt":"1200000","minPricePrecision":"0.01","category":"1","showStatus":"1","innovation":"0"},{"name":"EOSUSDT","alias":"EOSUSDT","baseCoin":"EOS","quoteCoin":"USDT","basePrecision":"0.01","quotePrecision":"0.000001","minTradeQty":"0.01","minTradeAmt":"0.01","maxTradeQty":"90909.090909","maxTradeAmt":"10000","minPricePrecision":"0.0001","category":"1","showStatus":"1","innovation":"0"}]},"retExtInfo":{},"time":1683980087416}';

    public function testInstrumentInfoDTOBuilder()
    {
        foreach (json_decode(self::$instrumentInfoApiResponse, true)['result']['list'] as $dataItem) {
            $dto = ResponseDtoBuilder::make(InstrumentInfoResponse::class, $dataItem);
            $this->assertInstanceOf(InstrumentInfoResponse::class, $dto);
            $this->assertIsString($dto->getName());
            $this->assertIsString($dto->getAlias());
            $this->assertIsString($dto->getQuoteCoin());
            $this->assertIsString($dto->getBaseCoin());
            $this->assertIsFloat($dto->getBasePrecision());
            $this->assertIsFloat($dto->getQuotePrecision());
            $this->assertIsInt($dto->getInnovation());
            $this->assertIsInt($dto->getMaxTradeAmt());
            $this->assertIsFloat($dto->getMaxTradeQty());
            $this->assertIsFloat($dto->getMinTradeAmt());
            $this->assertIsFloat($dto->getMinTradeQty());
            $this->assertIsFloat($dto->getMinPricePrecision());
            $this->assertIsInt($dto->getCategory());
            $this->assertIsInt($dto->getShowStatus());
            $this->assertIsInt($dto->getInnovation());
        }
    }

    public function testInstrumentInfoResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$instrumentInfoApiResponse, CurlResponseHandler::class, InstrumentInfoResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testInstrumentInfoEndpoint()
    {
        $endpoint = RestBuilder::make(TestSpotInstrumentInfo::class);

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$instrumentInfoApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $dataItem) {
            $dto = ResponseDtoBuilder::make(InstrumentInfoResponse::class, $dataItem);
            $this->assertInstanceOf(InstrumentInfoResponse::class, $dto);
            $this->assertIsString($dto->getName());
            $this->assertIsString($dto->getAlias());
            $this->assertIsString($dto->getQuoteCoin());
            $this->assertIsString($dto->getBaseCoin());
            $this->assertIsFloat($dto->getBasePrecision());
            $this->assertIsFloat($dto->getQuotePrecision());
            $this->assertIsInt($dto->getInnovation());
            $this->assertIsInt($dto->getMaxTradeAmt());
            $this->assertIsFloat($dto->getMaxTradeQty());
            $this->assertIsFloat($dto->getMinTradeAmt());
            $this->assertIsFloat($dto->getMinTradeQty());
            $this->assertIsFloat($dto->getMinPricePrecision());
            $this->assertIsInt($dto->getCategory());
            $this->assertIsInt($dto->getShowStatus());
            $this->assertIsInt($dto->getInnovation());
        }
    }

    /**
     * SPOT - Market Data
     * Kline
     */
    private static string $klineApiResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"t":1683922260000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26413.58","h":"26444.15","l":"26413.58","o":"26440","v":"0.038419"},{"t":1683922320000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26405.44","h":"26420.02","l":"26402.16","o":"26413.58","v":"0.024527"},{"t":1683922380000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26390.96","h":"26406.3","l":"26390.95","o":"26405.44","v":"0.030255"},{"t":1683922440000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26397.07","h":"26399.92","l":"26390.95","o":"26390.96","v":"0.028976"},{"t":1683922500000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26390.98","h":"26397.07","l":"26390.95","o":"26397.07","v":"0.03669"},{"t":1683922560000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26409.24","h":"26409.24","l":"26389.68","o":"26390.98","v":"0.024756"},{"t":1683922620000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26443.27","h":"26453.24","l":"26390.95","o":"26409.24","v":"0.025462"},{"t":1683922680000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26451.86","h":"26451.89","l":"26440.91","o":"26443.27","v":"0.026304"},{"t":1683922740000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26426.59","h":"26451.86","l":"26424.63","o":"26451.86","v":"0.02513"},{"t":1683922800000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26429.66","h":"26435.5","l":"26419.97","o":"26426.59","v":"0.021732"},{"t":1683922860000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26426.6","h":"26435.01","l":"26421.77","o":"26429.66","v":"0.024761"},{"t":1683922920000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26404.56","h":"26434.34","l":"26401.55","o":"26426.6","v":"0.020718"},{"t":1683922980000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26403.24","h":"26414.24","l":"26386.61","o":"26404.56","v":"0.02995"},{"t":1683923040000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26391.6","h":"26403.24","l":"26391.57","o":"26403.24","v":"0.016944"},{"t":1683923100000,"s":"BTCUSDT","sn":"BTCUSDT","c":"26386.62","h":"26391.6","l":"26386.61","o":"26391.6","v":"0.03116"}]},"retExtInfo":{},"time":1683982237622}';

    public function testKlineInfoDTOBuilder()
    {
        foreach (json_decode(self::$klineApiResponse, true)['result']['list'] as $dataItem) {
            $dto = ResponseDtoBuilder::make(KlineResponse::class, $dataItem);
            $this->assertInstanceOf(KlineResponse::class, $dto);
            $this->assertInstanceOf(\DateTime::class, $dto->getTime());
            $this->assertIsString($dto->getSymbol());
            $this->assertIsString($dto->getAlias());
            $this->assertIsFloat($dto->getClosePrice());
            $this->assertIsFloat($dto->getHighPrice());
            $this->assertIsFloat($dto->getLowPrice());
            $this->assertIsFloat($dto->getOpenPrice());
            $this->assertIsFloat($dto->getTradingVolume());
        }
    }

    public function testKlineResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$klineApiResponse, CurlResponseHandler::class, KlineResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testKlineEndpoint()
    {
        $endpoint = RestBuilder::make(TestKline::class, (new KlineRequest())
            ->setSymbol("BTCUSDT")->setInterval(EnumIntervals::HOUR_1));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$klineApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $dataItem) {
            $dto = ResponseDtoBuilder::make(KlineResponse::class, $dataItem);
            $this->assertInstanceOf(KlineResponse::class, $dto);
            $this->assertInstanceOf(\DateTime::class, $dto->getTime());
            $this->assertIsString($dto->getSymbol());
            $this->assertIsString($dto->getAlias());
            $this->assertIsFloat($dto->getClosePrice());
            $this->assertIsFloat($dto->getHighPrice());
            $this->assertIsFloat($dto->getLowPrice());
            $this->assertIsFloat($dto->getOpenPrice());
            $this->assertIsFloat($dto->getTradingVolume());
        }
    }

    /**
     * SPOT - MARKET DATA
     * Last Traded Price
     */
    private static string $lastTradedPriceApiResponse = '{"retCode":0,"retMsg":"OK","result":{"symbol":"BTCUSDT","price":"26386.61"},"retExtInfo":{},"time":1683982585451}';

    public function testLastTradedPriceDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(LastTradedPriceResponse::class, json_decode(self::$lastTradedPriceApiResponse, true)['result']);
        $this->assertInstanceOf(LastTradedPriceResponse::class, $dto);
        $this->assertIsString($dto->getSymbol());
        $this->assertIsFloat($dto->getPrice());
    }

    public function testLastTradedPriceResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$lastTradedPriceApiResponse, CurlResponseHandler::class, LastTradedPriceResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testLastTradedPriceEndpoint()
    {
        $endpoint = RestBuilder::make(TestLastTradedPrice::class, (new LastTradedPriceRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$lastTradedPriceApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();
        $this->assertInstanceOf(LastTradedPriceResponse::class, $dto);
        $this->assertIsString($dto->getSymbol());
        $this->assertIsFloat($dto->getPrice());
    }

    /**
     * SPOT - Market Data
     * Merged Order Book
     */
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

    /**
     * SPOT - Market Data
     * Order Book
     */

    private static string $orderBookApiResult = '{"retCode":0,"retMsg":"OK","result":{"asks":[["26847.07","0.026755"],["26847.09","0.018993"],["26847.11","0.023623"],["26847.13","0.054235"],["26847.15","0.02979"]],"bids":[["26844.02","0.017595"],["26844","0.020731"],["26843.98","0.039244"],["26843.96","0.035931"],["26843.94","0.053928"]],"time":1683984334496},"retExtInfo":{},"time":1683984334496}';

    public function testOrderBookDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(OrderBookResponse::class, json_decode(self::$orderBookApiResult, true)['result']);
        $this->assertInstanceOf(OrderBookResponse::class, $dto);

        /** @var OrderBookPriceItemResponse $bid */
        while(!empty($bid = $dto->getBids()->fetch())) {
            $this->assertIsFloat($bid->getPrice());
            $this->assertIsFloat($bid->getQuantity());
        }

        /** @var OrderBookPriceItemResponse $ask */
        while(!empty($ask = $dto->getAsks()->fetch())) {
            $this->assertIsFloat($ask->getPrice());
            $this->assertIsFloat($ask->getQuantity());
        }
    }

    public function testOrderBookResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$orderBookApiResult, CurlResponseHandler::class, OrderBookResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testOrderBookEndpoint()
    {
        $endpoint = RestBuilder::make(TestOrderBook::class, (new OrderBookRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$orderBookApiResult);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();

        $this->assertInstanceOf(OrderBookResponse::class, $dto);
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

    /**
     * SPOT - Market Data
     * Public Trading Records
     */
    private static string $publicTradingRecordsApiResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[{"price":"26822.93","time":1683984799441,"qty":"0.000336","isBuyerMaker":1,"type":"0"},{"price":"26822.93","time":1683984799749,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.93","time":1683984800267,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.93","time":1683984801045,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984801819,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984802595,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984803370,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984803430,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26822.72","time":1683984804148,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984804430,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26822.72","time":1683984804923,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984805427,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26820.45","time":1683984805496,"qty":"0.000242","isBuyerMaker":0,"type":"0"},{"price":"26822.72","time":1683984805698,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984806472,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984807250,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984807427,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26822.72","time":1683984808031,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984808434,"qty":"0.000261","isBuyerMaker":0,"type":"0"},{"price":"26822.72","time":1683984808807,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984809582,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984809845,"qty":"0.001","isBuyerMaker":0,"type":"0"},{"price":"26822.72","time":1683984810358,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984810874,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984811387,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984811433,"qty":"0.000298","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984811516,"qty":"0.000242","isBuyerMaker":0,"type":"0"},{"price":"26822.72","time":1683984811901,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984812415,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984812932,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26822.72","time":1683984813447,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.45","time":1683984813455,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26820.46","time":1683984813961,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.31","time":1683984814440,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26820.46","time":1683984814475,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984814990,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.31","time":1683984815440,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26820.46","time":1683984815507,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984816023,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.31","time":1683984816430,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26820.46","time":1683984816539,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.31","time":1683984816841,"qty":"0.000354","isBuyerMaker":0,"type":"0"},{"price":"26820.46","time":1683984817056,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.31","time":1683984817430,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26820.46","time":1683984817568,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984818348,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984819136,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984819916,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984820698,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.31","time":1683984821432,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26820.46","time":1683984821470,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984822251,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26820.46","time":1683984823027,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.31","time":1683984823434,"qty":"0.000373","isBuyerMaker":0,"type":"0"},{"price":"26819.32","time":1683984823799,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.32","time":1683984824571,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.32","time":1683984825349,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.32","time":1683984826123,"qty":"0.000037","isBuyerMaker":1,"type":"0"},{"price":"26819.32","time":1683984826445,"qty":"0.000205","isBuyerMaker":1,"type":"0"},{"price":"26817.46","time":1683984826525,"qty":"0.000298","isBuyerMaker":0,"type":"0"}]},"retExtInfo":{},"time":1683984826883}';

    public function testPublicTradingRecordsDTOBuilder()
    {
        foreach (json_decode(self::$publicTradingRecordsApiResponse, true)['result']['list'] as $record) {
            $dto = ResponseDtoBuilder::make(PublicTradingRecordsResponse::class, $record);
            $this->assertInstanceOf(PublicTradingRecordsResponse::class, $dto);
            $this->assertIsFloat($dto->getPrice());
            $this->assertInstanceOf(\DateTime::class, $dto->getTime());
            $this->assertIsFloat($dto->getQuantity());
            $this->assertIsBool($dto->getIsBuyerMaker());
            $this->assertIsInt($dto->getType());
        }
    }

    public function testPublicTradingRecordsResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$publicTradingRecordsApiResponse, CurlResponseHandler::class, PublicTradingRecordsResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testPublicTradingRecordsEndpoint()
    {
        $endpoint = RestBuilder::make(TestPublicTradingRecords::class, (new PublicTradingRecordsRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$publicTradingRecordsApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $dto = $body->fetch();

        $this->assertInstanceOf(PublicTradingRecordsResponse::class, $dto);
        $this->assertInstanceOf(\DateTime::class, $dto->getTime());
        $this->assertIsFloat($dto->getPrice());
        $this->assertIsFloat($dto->getQuantity());
        $this->assertIsBool($dto->getIsBuyerMaker());
        $this->assertIsInt($dto->getType());
    }

    /**
     * SPOT - Market Data
     * Tickers
     */
    private static string $tickersApiResponse = '{"retCode":0,"retMsg":"OK","result":{"t":1683986136017,"s":"BTCUSDT","bp":"26799.99","ap":"26810.3","lp":"26810.3","o":"26875.03","h":"28073.41","l":"25992.06","v":"2389.959483","qv":"65100545.90244497"},"retExtInfo":{},"time":1683986136450}';

    public function testTickersDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(TickersResponse::class, json_decode(self::$tickersApiResponse, true)['result']);
        $this->assertInstanceOf(TickersResponse::class, $dto);
        $this->assertInstanceOf(\DateTime::class, $dto->getTime());
        $this->assertIsFloat($dto->getHighPrice());
        $this->assertIsFloat($dto->getTradingVolume());
        $this->assertIsFloat($dto->getOpenPrice());
        $this->assertIsFloat($dto->getLowPrice());
        $this->assertIsFloat($dto->getBestAskPrice());
        $this->assertIsFloat($dto->getBestBidPrice());
        $this->assertIsFloat($dto->getLastTradedPrice());
        $this->assertIsFloat($dto->getTradingQuoteVolume());
        $this->assertIsString($dto->getSymbol());
    }

    public function testTickersResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$tickersApiResponse, CurlResponseHandler::class, TickersResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testTickersEndpoint()
    {
        $endpoint = RestBuilder::make(TestTickers::class, (new TickersRequest())
            ->setSymbol("BTCUSDT"));

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$tickersApiResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        $body = $body->fetch();

        $this->assertInstanceOf(TickersResponse::class, $body);
        $this->assertInstanceOf(\DateTime::class, $body->getTime());
        $this->assertIsFloat($body->getHighPrice());
        $this->assertIsFloat($body->getTradingVolume());
        $this->assertIsFloat($body->getOpenPrice());
        $this->assertIsFloat($body->getLowPrice());
        $this->assertIsFloat($body->getBestAskPrice());
        $this->assertIsFloat($body->getBestBidPrice());
        $this->assertIsFloat($body->getLastTradedPrice());
        $this->assertIsFloat($body->getTradingQuoteVolume());
        $this->assertIsString($body->getSymbol());
    }
}