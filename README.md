[![phpunit](https://github.com/carpenstar/bybitapi-sdk-spot/actions/workflows/github-action.yml/badge.svg?branch=master)](https://github.com/carpenstar/bybitapi-sdk-spot/actions/workflows/github-action.yml/badge.svg?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-spot/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-spot/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-spot/badges/build.png?b=master)](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-spot/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/carpenstar/bybitapi-sdk-spot/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
# ByBitAPI - spot-trading package

**Дисклэймер: это неофициальный SDK для интеграции с биржей ByBit.   
Поддержка функционала осуществляется только в пределах зоны отвественности кода и при возможности со стороны разработчика**

**Разработка интеграции еще не закончена, поэтому работоспособность (как полностью, так и отдельных компонентов) не гарантируется.**

## Эндпоинты:
* MARKET DATA
- [Best Bid Ask Price](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---best-bid-ask-price)
- [Instrument Info](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---instrument-info)
- [Kline](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---kline)
- [Last Traded Price](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---last-traded-price)
- [Merged Order Book](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---merged-order-book)
- [Public Trading Records](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---public-trading-records)
- [Tickers](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---tickers)
- [Order Book](https://github.com/carpenstar/bybitapi-sdk-spot#market-data---order-book)  
* TRADE
- [Place Order](https://github.com/carpenstar/bybitapi-sdk-spot#trade---place-order)
- [Get Order](https://github.com/carpenstar/bybitapi-sdk-spot#trade---get-order)
- [Cancel Order](https://github.com/carpenstar/bybitapi-sdk-spot#trade---cancel-order)

## Требования

- PHP >= 7.4

## Установка

```sh 
composer require carpenstar/bybitapi-sdk-spot
```

## Поддерживаемые эндпоинты:

### Market Data - Best Bid Ask Price
https://bybit-exchange.github.io/docs/spot/public/bid-ask

<details><summary> <b>Параметры запроса:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Request\BestBidAskPriceRequest::class

$options = (new BestBidAskPriceRequest())
    ->setSymbol("BTCUSDT");
```
</details>


<details><summary> <b>Структура ответа:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\BestBidAskPrice::class;

interface BestBidAskPrice
{
    public function getSymbol(): string;
    public function getAskPrice(): float;
    public function getAskQty(): float;
    public function getBidPrice(): float;
    public function getBidQty(): float;
    public function getTime(): \DateTime;
}
```
</details>

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\BestBidAskPrice;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Request\BestBidAskPriceRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\BestBidAskPrice\Response\BestBidAskPriceResponse;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

$options = (new BestBidAskPriceRequest())->setSymbol("BTCUSDT");

/** @var BestBidAskPriceResponse $bestBidAskPrice */
$bestBidAskPrice = $bybit->rest(BestBidAskPrice::class, $options)->getBody()->fetch();

echo "Symbol: {$bestBidAskPrice->getSymbol()}" . PHP_EOL;
echo "Bid Price: {$bestBidAskPrice->getBidPrice()}" . PHP_EOL;
echo "Bid Qty: {$bestBidAskPrice->getBidQty()}" . PHP_EOL;
echo "Ask Price: {$bestBidAskPrice->getAskPrice()}" . PHP_EOL;
echo "Ask Qty: {$bestBidAskPrice->getAskQty()}" . PHP_EOL;
echo "Time: {$bestBidAskPrice->getTime()->format("Y-m-d H:i:s")}" . PHP_EOL;

/**
 * Result:
 *
 * Symbol: BTCUSDT
 * Bid Price: 27776
 * Bid Qty: 0.002492{}
 * Ask Price: 27776.01
 * Ask Qty: 0.004536
 * Time: 2023-05-09 18:03:57
 */
```
---

### Market Data - Instrument Info
https://bybit-exchange.github.io/docs/spot/public/instrument

<details><summary> <b>Структура ответа:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Interfaces\IInstrumentInfoResponse::class;

interface IInstrumentInfoResponse
{
    public function getName(): string;
    public function getAlias(): string;
    public function getBaseCoin(): string;
    public function getQuoteCoin(): string;
    public function getBasePrecision(): float;
    public function getQuotePrecision(): float;
    public function getMinTradeQty(): float;
    public function getMinTradeAmt(): float;
    public function getMaxTradeQty(): float;
    public function getMaxTradeAmt(): int;
    public function getMinPricePrecision(): float;
    public function getCategory(): int;
    public function getShowStatus(): int;
    public function getInnovation(): int;
}
```
</details>

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\InstrumentInfo;
use Carpenstar\ByBitAPI\Spot\MarketData\InstrumentInfo\Response\InstrumentInfoResponse;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

/** @var InstrumentInfoResponse[] $instrumentInfoData */
$instrumentInfo = $bybit->rest(InstrumentInfo::class)->getBody()->all();
$instrumentInfo = array_slice($instrumentInfo, 0, 5);

/** @var InstrumentInfoResponse $instrumentItem */
foreach ($instrumentInfo as $instrumentItem) {
    echo "Name: {$instrumentItem->getName()}" . PHP_EOL;
    echo "Alias: {$instrumentItem->getAlias()}" . PHP_EOL;
    echo "Base Coin: {$instrumentItem->getBaseCoin()}" . PHP_EOL;
    echo "Quote Coin: {$instrumentItem->getQuoteCoin()}" . PHP_EOL;
    echo "Base Precision: {$instrumentItem->getBasePrecision()}" . PHP_EOL;
    echo "Quote Precision: {$instrumentItem->getQuotePrecision()}" . PHP_EOL;
    echo "Min Trade Quantity: {$instrumentItem->getMinTradeQty()}" . PHP_EOL;
    echo "Min Trade Amount: {$instrumentItem->getMaxTradeAmt()}" . PHP_EOL;
    echo "Min Price Precision: {$instrumentItem->getMinPricePrecision()}" . PHP_EOL;
    echo "Max Trade Quantity: {$instrumentItem->getMaxTradeQty()}" . PHP_EOL;
    echo "Max Trade Amt: {$instrumentItem->getMaxTradeAmt()}" . PHP_EOL;
    echo "Category: {$instrumentItem->getCategory()}" . PHP_EOL;
    echo "Innovation: {$instrumentItem->getInnovation()}" . PHP_EOL;
    echo "Show Status: {$instrumentItem->getShowStatus()}" . PHP_EOL;
    echo "-----" . PHP_EOL;
}

/**
 * Result:
 * 
 * Name: BTCUSDT
 * Alias: BTCUSDT
 * Base Coin: BTC
 * Quote Coin: USDT
 * Base Precision: 1.0E-6
 * Quote Precision: 1.0E-8
 * Min Trade Quantity: 4.0E-5
 * Min Trade Amount: 1200000
 * Min Price Precision: 0.01
 * Max Trade Quantity: 500
 * Max Trade Amt: 1200000
 * Category: 1
 * Innovation: 0
 * Show Status: 1
 * -----
 * Name: ETHUSDT
 * Alias: ETHUSDT
 * Base Coin: ETH
 * Quote Coin: USDT
 * Base Precision: 1.0E-5
 * Quote Precision: 1.0E-7
 * Min Trade Quantity: 0.0005
 * Min Trade Amount: 1200000
 * Min Price Precision: 0.01
 * Max Trade Quantity: 100000000
 * Max Trade Amt: 1200000
 * Category: 1
 * Innovation: 0
 * Show Status: 1
 * -----
 * Name: EOSUSDT
 * Alias: EOSUSDT
 * Base Coin: EOS
 * Quote Coin: USDT
 * Base Precision: 0.01
 * Quote Precision: 1.0E-6
 * Min Trade Quantity: 0.01
 * Min Trade Amount: 10000
 * Min Price Precision: 0.0001
 * Max Trade Quantity: 90909.090909
 * Max Trade Amt: 10000
 * Category: 1
 * Innovation: 0
 * Show Status: 1
 * -----
 * Name: SHIBIUSDT
 * Alias: SHIBIUSDT
 * Base Coin: SHIBI
 * Quote Coin: USDT
 * Base Precision: 1.0E-9
 * Quote Precision: 1.0E-5
 * Min Trade Quantity: 0.0033
 * Min Trade Amount: 0
 * Min Price Precision: 0.1
 * Max Trade Quantity: 0
 * Max Trade Amt: 0
 * Category: 1
 * Innovation: 0
 * Show Status: 1
 * -----
 * Name: NEOBTC
 * Alias: NEOBTC
 * Base Coin: NEO
 * Quote Coin: BTC
 * Base Precision: 0.01
 * Quote Precision: 0.01
 * Min Trade Quantity: 0.01
 * Min Trade Amount: 10000
 * Min Price Precision: 0.01
 * Max Trade Quantity: 100
 * Max Trade Amt: 10000
 * Category: 1
 * Innovation: 0
 * Show Status: 1
 * -----
 */
```
---

### Market Data - Kline
https://bybit-exchange.github.io/docs/spot/public/kline

<details><summary> <b>Параметры запроса:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\Kline\Request\KlineRequest::class

$options = (new KlineRequest())
    ->setSymbol("BTCUSDT");
```
</details>


<details><summary> <b>Структура ответа:</b></summary>

```php
Carpenstar\ByBitAPI\Spot\MarketData\Kline\Interfaces\IKlineResponse::class;

interface IKlineResponse
{
    public function getTime(): \DateTime;
    public function getSymbol(): string;
    public function getAlias(): string;
    public function getClosePrice(): float;
    public function getHighPrice(): float;
    public function getLowPrice(): float;
    public function getOpenPrice(): float;
    public function getTradingVolume(): float;
}
```
</details>

```php
use Carpenstar\ByBitAPI\Spot\MarketData\Kline\Response\KlineResponse;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

$options = (new KlineRequest())
    ->setSymbol("ATOMUSDT")
    ->setInterval(EnumIntervals::MINUTE1)
    ->setLimit(3);

/** @var KlineResponse $kline */
$kline = $bybit->rest(Kline::class, $options)->getBody()->fetch();

echo "Time: {$kline->getTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo "Symbol: {$kline->getSymbol()}" . PHP_EOL;
echo "Alias: {$kline->getAlias()}" . PHP_EOL;
echo "Close Price: {$kline->getClosePrice()}" . PHP_EOL;
echo "High Price: {$kline->getHighPrice()}" . PHP_EOL;
echo "Low Price: {$kline->getLowPrice()}" . PHP_EOL;
echo "Open Price: {$kline->getOpenPrice()}" . PHP_EOL;
echo "Trading Volume: {$kline->getTradingVolume()}" . PHP_EOL;

/**
 * Result:
 *
 * Time: 2023-05-09 18:30:00
 * Symbol: ATOMUSDT
 * Alias: ATOMUSDT
 * Close Price: 702.8
 * High Price: 702.85
 * Low Price: 702.65
 * Open Price: 702.65
 * Trading Volume: 0.03
 */
```
---

### Market Data - Last Traded Price
https://bybit-exchange.github.io/docs/spot/public/last-price


<details><summary> <b>Параметры запроса:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Request\LastTradedPriceRequest::class

$options = (new LastTradedPriceRequest())
    ->setSymbol("BTCUSDT");
```
</details>

<details><summary> <b>Структура ответа:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Interfaces\ILastTradedPriceResponse::class

interface ILastTradedPriceResponse
{
    public function getSymbol(): string;
    public function getPrice(): float;
}
```
</details>

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Request\LastTradedPriceRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\Response\LastTradedPriceResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\LastTradedPrice\LastTradedPrice;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

$options = (new LastTradedPriceRequest())
    ->setSymbol("ATOMUSDT");


/** @var LastTradedPriceResponse $lastTradePrice */
$lastTradePrice = $bybit->rest(LastTradedPrice::class, $options)->getBody()->fetch();

echo "Symbol: {$lastTradePrice->getSymbol()}" . PHP_EOL;
echo "Price: {$lastTradePrice->getPrice()}" . PHP_EOL;

/**
 * Result:
 *
 * Symbol: ATOMUSDT
 * Price: 702.85
 */
```

### Market Data - Merged Order Book
https://bybit-exchange.github.io/docs/spot/public/merge-depth


<details><summary> <b>Параметры запроса:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Request\MergedOrderBookRequest::class

$options = (new MergedOrderBookRequest())
    ->setSymbol("BTCUSDT")
    ->setScale(1)
    ->setLimit(5);
```
</details>

<details><summary> <b>Структура ответа:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Interfaces\IMergedOrderBookResponse::class;

interface IMergedOrderBookResponse
{
    public function getTime(): \DateTime;
    public function getAsks(): EntityCollection;
    public function getBids(): EntityCollection;
}
```
```php
\Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Interfaces\IMergedOrderBookPriceResponse::class;

interface IMergedOrderBookPriceResponse
{
    public function getPrice(): float;
    public function getQuantity(): float;
}
```
</details>

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Request\MergedOrderBookRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\MergedOrderBook;
use Carpenstar\ByBitAPI\Spot\MarketData\MergedOrderBook\Response\MergedOrderBookPriceResponse;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

$options = (new MergedOrderBookRequest())
    ->setSymbol("BTCUSDT")
    ->setScale(1)
    ->setLimit(5);


/** @var MergedOrderBookResponse $mergedOrderBook */
$mergedOrderBook = $bybit->rest(MergedOrderBook::class, $options)->getBody()->fetch();

echo "Time: {$mergedOrderBook->getTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo '---' . PHP_EOL;
/** @var MergedOrderBookPriceResponse $bid */
foreach ($mergedOrderBook->getBids()->all() as $bid) {
    echo " - Bid Price: {$bid->getPrice()} Bid Quantity: {$bid->getQuantity()}" . PHP_EOL;
}
echo '---' . PHP_EOL;
/** @var MergedOrderBookPriceResponse $ask */
foreach ($mergedOrderBook->getAsks()->all() as $ask) {
    echo " - Ask Price: {$ask->getPrice()} Ask Quantity: {$ask->getQuantity()}" . PHP_EOL;
}
echo '---' . PHP_EOL;


/**
 * Result:
 *
 * Time: 2023-05-11 21:10:57
 * ---
 * - Bid Price: 27028.4 Bid Quantity: 0.052636
 * - Bid Price: 27028.3 Bid Quantity: 0.193124
 * - Bid Price: 27014.8 Bid Quantity: 0.020057
 * - Bid Price: 27014.7 Bid Quantity: 0.003761
 * - Bid Price: 26938.2 Bid Quantity: 0.001864
 * ---
 * - Ask Price: 27028.5 Ask Quantity: 0.132579
 * - Ask Price: 27028.6 Ask Quantity: 0.077184
 * - Ask Price: 27033.1 Ask Quantity: 0.152256
 * - Ask Price: 27033.2 Ask Quantity: 0.016766
 * - Ask Price: 27033.4 Ask Quantity: 0.112448
 * ---
 */
```
---
### Market Data - Public Trading Records
https://bybit-exchange.github.io/docs/spot/public/recent-trade


<details><summary> <b>Параметры запроса:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Request\PublicTradingRecordsRequest::class

$options = (new PublicTradingRecordsRequest())
    ->setSymbol("BTCUSDT")
    ->setLimit(5);
```
</details>

<details><summary> <b>Структура ответа:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Interfaces\IPublicTradingRecordsResponse::class;

interface IPublicTradingRecordsResponse
{
    public function getPrice(): float;
    public function getQuantity(): float;
    public function getTime(): \DateTime;
    public function getIsBuyerMaker(): bool;
    public function getType(): int;
}
```
</details>

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Request\PublicTradingRecordsRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\PublicTradingRecords;
use Carpenstar\ByBitAPI\Spot\MarketData\PublicTradingRecords\Response\PublicTradingRecordsResponse;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

$options = (new PublicTradingRecordsRequest())
    ->setSymbol("BTCUSDT")
    ->setLimit(5);


/** @var PublicTradingRecordsResponse[] $publicTradingRecordsList */
$publicTradingRecordsList = $bybit->rest(PublicTradingRecords::class, $options)->getBody()->all();

foreach ($publicTradingRecordsList as $publicTradingRecord) {
    echo "Time: {$publicTradingRecord->getTime()->format('Y-m-d H:i:i')}" . PHP_EOL;
    echo "Price: {$publicTradingRecord->getPrice()}" . PHP_EOL;
    echo "Quantity: {$publicTradingRecord->getQuantity()}" . PHP_EOL;
    echo "Is Buyer Maker: {$publicTradingRecord->getIsBuyerMaker()}" . PHP_EOL;
    echo "Type: {$publicTradingRecord->getType()}" . PHP_EOL;
    echo "-----" . PHP_EOL;
}

/**
 * Result:
 *
 * Time: 2023-05-12 09:45:45
 * Price: 26327.59
 * Quantity: 0.00038
 * Is Buyer Maker: 1
 * Type: 0
 * -----
 * Time: 2023-05-12 09:45:45
 * Price: 26327.59
 * Quantity: 0.000342
 * Is Buyer Maker: 1
 * Type: 0
 * -----
 * Time: 2023-05-12 09:45:45
 * Price: 26327.59
 * Quantity: 0.00038
 * Is Buyer Maker: 1
 * Type: 0
 * -----
 * Time: 2023-05-12 09:45:45
 * Price: 26327.59
 * Quantity: 0.00019
 * Is Buyer Maker: 1
 * Type: 0
 * -----
 * Time: 2023-05-12 09:45:45
 * Price: 26327.59
 * Quantity: 0.00038
 * Is Buyer Maker: 1
 * Type: 0
 * -----
 */
```
---
### Market Data - Tickers
https://bybit-exchange.github.io/docs/spot/public/tickers


<details><summary> <b>Параметры запроса:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Request\TickersRequest::class

$options = (new TickersRequest())
    ->setSymbol("BTCUSDT");
```
</details>

<details><summary> <b>Структура ответа:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\Tickers\ITickersResponse::class;

interface ITickersResponse
{
    public function getTime(): \DateTime;
    public function getSymbol(): string;
    public function getBestAskPrice(): float;
    public function getLastTradedPrice(): float;
    public function getHighPrice(): float;
    public function getLowPrice(): float;
    public function getOpenPrice(): float;
    public function getBestBidPrice(): float;
    public function getTradingVolume(): float;
    public function getTradingQuoteVolume(): float;
}
```
</details>

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Request\TickersRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Response\TickersResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\Tickers\Tickers;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

$options = (new TickersRequest())
    ->setSymbol("ATOMUSDT");


/** @var TickersResponse $tickersData */
$tickersData = $bybit->rest(Tickers::class, $options)->getBody()->fetch();

echo "Time: {$tickersData->getTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo "Symbol: {$tickersData->getSymbol()}" . PHP_EOL;
echo "Best Ask Price: {$tickersData->getBestAskPrice()}" . PHP_EOL;
echo "Last Traded Price: {$tickersData->getLastTradedPrice()}" . PHP_EOL;
echo "High Price: {$tickersData->getHighPrice()}" . PHP_EOL;
echo "Low Price: {$tickersData->getLowPrice()}" . PHP_EOL;
echo "Open Price: {$tickersData->getOpenPrice()}" . PHP_EOL;
echo "Best Bid Price: {$tickersData->getBestAskPrice()}" . PHP_EOL;
echo "Trading Volume: {$tickersData->getTradingVolume()}" . PHP_EOL;
echo "Trading Quote Volume: {$tickersData->getTradingQuoteVolume()}" . PHP_EOL;

/**
 * Result:
 *
 * Time: 2023-05-12 10:00:24
 * Symbol: ATOMUSDT
 * Best Ask Price: 702.85
 * Last Traded Price: 702.85
 * High Price: 702.85
 * Low Price: 702.4
 * Open Price: 702.85
 * Best Bid Price: 702.85
 * Trading Volume: 25.74
 * Trading Quote Volume: 18091.003
 */
```
### Market Data - Order Book
https://bybit-exchange.github.io/docs/spot/public/depth


<details><summary> <b>Параметры запроса:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Request\OrderBookRequest::class

$options = (new OrderBookRequest())
    ->setSymbol("ATOMUSDT")
    ->setLimit(5);
```
</details>

<details><summary> <b>Структура ответа:</b></summary>

```php
\Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Interfaces\IOrderBookResponse::class;

interface IOrderBookResponse
{
public function getTime(): \DateTime;
public function getAsks(): EntityCollection; // IOrderBookPriceResponse[]
public function getBids(): EntityCollection; // IOrderBookPriceResponse[]
}
```
```php
\Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Interfaces\IOrderBookPriceResponse::class;

interface IOrderBookPriceResponse
{
    public function getPrice(): float;
    public function getQuantity(): float;
}
```
</details>

```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\OrderBook;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookResponse;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Request\OrderBookRequest;
use Carpenstar\ByBitAPI\Spot\MarketData\OrderBook\Response\OrderBookPriceResponse;

$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

$options = (new OrderBookRequest())
    ->setSymbol("ATOMUSDT")
    ->setLimit(5);

/** @var OrderBookResponse $orderBookData */
$orderBookData = $bybit->rest(OrderBook::class, $options)->getBody()->fetch();

echo "Time: {$orderBookData->getTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo "Bids:" . PHP_EOL;
/** @var OrderBookPriceResponse $bid */
foreach ($orderBookData->getBids()->all() as $bid) {
    echo " - Bid Price: {$bid->getPrice()} Bid Quantity: {$bid->getQuantity()}" . PHP_EOL;
}
echo "Asks:" . PHP_EOL;
/** @var OrderBookPriceResponse $ask */
foreach ($orderBookData->getAsks()->all() as $ask) {
    echo " - Bid Price: {$ask->getPrice()} Bid Quantity: {$ask->getQuantity()}" . PHP_EOL;
}

/**
 * Result:
 * 
 * Time: 2023-05-12 10:15:41
 * Bids:
 * - Bid Price: 171.45 Bid Quantity: 19.29
 * - Bid Price: 104.15 Bid Quantity: 9.96
 * - Bid Price: 90.25 Bid Quantity: 99.72
 * - Bid Price: 81.05 Bid Quantity: 0.75
 * - Bid Price: 16.7 Bid Quantity: 5.98
 * Asks:
 * - Bid Price: 702.85 Bid Quantity: 1639.55
 * - Bid Price: 702.9 Bid Quantity: 0.01
 * - Bid Price: 703 Bid Quantity: 0.01
 * - Bid Price: 703.25 Bid Quantity: 0.01
 * - Bid Price: 704.8 Bid Quantity: 179.16
 */
```
---
### Trade - Place Order
https://bybit-exchange.github.io/docs/spot/trade/place-order

***Example:***
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Request\PlaceOrderRequest;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\PlaceOrder;
use Carpenstar\ByBitAPI\Spot\Trade\PlaceOrder\Response\PlaceOrderResponse;


$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

/** @var  PlaceOrderResponse $placeOrderData */
$placeOrderData = $bybit->rest(PlaceOrder::class, (new PlaceOrderRequest())
        ->setSymbol('BTCUSDT')
        ->setOrderType('Limit') // see full list at Carpenstar\ByBitAPI\Core\Enums\EnumOrderType
        ->setSide('Buy') // see full list Carpenstar\ByBitAPI\Core\Enums\EnumSide
        ->setOrderLinkId(uniqid())
        ->setOrderQty(0.001)
        ->setOrderPrice(1000)
        ->setTimeInForce('GTC')) // see full list at Carpenstar\ByBitAPI\Core\Enums\EnumTimeInForce
    ->getBody()
    ->fetch();



echo "Order ID: {$placeOrderData->getOrderId()}" . PHP_EOL;
echo "Order Link ID: {$placeOrderData->getOrderLinkId()}" . PHP_EOL;
echo "Symbol: {$placeOrderData->getSymbol()}" . PHP_EOL;
echo "Create Time: {$placeOrderData->getCreateTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo "Order Price: {$placeOrderData->getOrderPrice()}" . PHP_EOL;
echo "Order Quantity: {$placeOrderData->getOrderQty()}" . PHP_EOL;
echo "Order Type: {$placeOrderData->getOrderType()}" . PHP_EOL;
echo "Side: {$placeOrderData->getSide()}" . PHP_EOL;
echo "Status: {$placeOrderData->getStatus()}" . PHP_EOL;
echo "Time In Force: {$placeOrderData->getTimeInForce()}" . PHP_EOL;
echo "Account ID: {$placeOrderData->getAccountId()}" . PHP_EOL;
echo "Order Category: {$placeOrderData->getOrderCategory()}" . PHP_EOL;
echo "Trigger Price: {$placeOrderData->getTriggerPrice()}" . PHP_EOL;


/**
 * Result:
 *
 * Order ID: 1419802462493152768
 * Order Link ID: 645fa48a26ccb
 * Symbol: BTCUSDT
 * Create Time: 2023-05-13 14:54:02
 * Order Price: 1000
 * Order Quantity: 0.001
 * Order Type: LIMIT
 * Side: BUY
 * Status: NEW
 * Time In Force: GTC
 * Account ID: 1111837
 * Order Category: 0
 * Trigger Price:
 */
```
---
### Trade - Get Order
https://bybit-exchange.github.io/docs/spot/trade/get-order

***Example:***
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Response\GetOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\GetOrder;
use Carpenstar\ByBitAPI\Spot\Trade\GetOrder\Request\GetOrderRequest;


$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

/** @var GetOrderResponse $orderData */
$orderData = $bybit->rest(GetOrder::class, (new GetOrderRequest())
    ->setOrderLinkId('645fa48a26ccb'))->getBody()->fetch();



echo "Account ID: {$orderData->getAccountId()}" . PHP_EOL;
echo "Symbol: {$orderData->getSymbol()}" . PHP_EOL;
echo "Order Link ID: {$orderData->getOrderLinkId()}" . PHP_EOL;
echo "Order ID: {$orderData->getOrderId()}" . PHP_EOL;
echo "Order Price: {$orderData->getOrderPrice()}" . PHP_EOL;
echo "Order Quantity: {$orderData->getOrderQty()}" . PHP_EOL;
echo "Execution Quantity: {$orderData->getExecQty()}" . PHP_EOL;
echo "Cummulative Quote Quantity: {$orderData->getCummulativeQuoteQty()}" . PHP_EOL;
echo "Avg Price: {$orderData->getAvgPrice()}" . PHP_EOL;
echo "Status: {$orderData->getStatus()}" . PHP_EOL;
echo "Time In Force: {$orderData->getTimeInForce()}" . PHP_EOL;
echo "Order Type: {$orderData->getOrderType()}" . PHP_EOL;
echo "Side: {$orderData->getSide()}" . PHP_EOL;
echo "Stop Price: {$orderData->getStopPrice()}" . PHP_EOL;
echo "Create Time: {$orderData->getCreateTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo "Update Time: {$orderData->getUpdateTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo "Is Working: {$orderData->getIsWorking()}" . PHP_EOL;
echo "Is Locked {$orderData->getLocked()}" . PHP_EOL;

/**
 * Result:
 *
 * Account ID: 1111837
 * Symbol: BTCUSDT
 * Order Link ID: 645fa48a26ccb
 * Order ID: 1419802462493152768
 * Order Price: 1000
 * Order Quantity: 0.001
 * Execution Quantity: 0
 * Cummulative Quote Quantity: 0
 * Avg Price: 0
 * Status: CANCELED
 * Time In Force: GTC
 * Order Type: LIMIT
 * Side: BUY
 * Stop Price: 0
 * Create Time: 2023-05-13 14:54:02
 * Update Time: 2023-05-13 15:06:29
 * Is Working: 1
 * Is Locked 0
 */
```
---
### Trade - Cancel Order
https://bybit-exchange.github.io/docs/spot/trade/cancel

***Example:***
```php
use Carpenstar\ByBitAPI\BybitAPI;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\CancelOrder;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Response\CancelOrderResponse;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Request\CancelOrderRequest;


$bybit = new BybitAPI('https://api-testnet.bybit.com',"apiKey", "secret");

/** @var CancelOrderResponse $canceledOrderData */
$canceledOrderData = $bybit->rest(CancelOrder::class, (new CancelOrderRequest())
        ->setOrderLinkId('645fa48a26ccb')
    )->getBody()
    ->fetch();



echo "Order ID: {$canceledOrderData->getOrderId()}" . PHP_EOL;
echo "Order Link ID: {$canceledOrderData->getOrderLinkId()}" . PHP_EOL;
echo "Status: {$canceledOrderData->getStatus()}" . PHP_EOL;
echo "Symbol: {$canceledOrderData->getSymbol()}" . PHP_EOL;
echo "Account ID: {$canceledOrderData->getAccountId()}" . PHP_EOL;
echo "Order Price: {$canceledOrderData->getOrderPrice()}" . PHP_EOL;
echo "Create Time: {$canceledOrderData->getCreateTime()->format('Y-m-d H:i:s')}" . PHP_EOL;
echo "Order Quantity: {$canceledOrderData->getOrderQty()}" . PHP_EOL;
echo "Execution Quantity: {$canceledOrderData->getExecQty()}" . PHP_EOL;
echo "Time In Force: {$canceledOrderData->getTimeInForce()}" . PHP_EOL;
echo "Order Type: {$canceledOrderData->getOrderType()}" . PHP_EOL;
echo "Side: {$canceledOrderData->getSide()}" . PHP_EOL;

/**
 * Result:
 *
 * Order ID: 1419802462493152768
 * Order Link ID: 645fa48a26ccb
 * Status: CANCELED
 * Symbol: BTCUSDT
 * Account ID: 1111837
 * Order Price: 1000
 * Create Time: 2023-05-13 14:54:02
 * Order Quantity: 0.001
 * Execution Quantity: 0
 * Time In Force: GTC
 * Order Type: LIMIT
 * Side: BUY
 */
```