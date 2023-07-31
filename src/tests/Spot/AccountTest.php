<?php
namespace Spot;


use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Overrides\Spot\TestWalletBalance;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Account\WalletBalance\Response\WalletBalanceResponse;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    /**
     * SPOT - Account
     * Wallet Data
     */
    static private string $walletResponse = '{"retCode":0,"retMsg":"OK","result":{"balances":[{"coin":"EOS","coinId":"EOS","total":"2000","free":"2000","locked":"0"},{"coin":"ETH","coinId":"ETH","total":"1","free":"1","locked":"0"},{"coin":"USDC","coinId":"USDC","total":"50000","free":"50000","locked":"0"},{"coin":"USDT","coinId":"USDT","total":"50000","free":"50000","locked":"0"},{"coin":"XRP","coinId":"XRP","total":"10000","free":"10000","locked":"0"}]},"retExtInfo":{},"time":1683973704401}';

    public function testTickersDTOBuilder()
    {
        foreach (json_decode(self::$walletResponse, true)['result']["balances"] as $wallet) {
            $dto = ResponseDtoBuilder::make(WalletBalanceResponse::class, $wallet);
            $this->assertInstanceOf(WalletBalanceResponse::class, $dto);
            $this->assertIsString($dto->getCoin());
            $this->assertIsFloat($dto->getFree());
            $this->assertIsFloat($dto->getTotal());
            $this->assertIsBool($dto->getLocked());
        }


    }

    public function testTickersResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$walletResponse, CurlResponseHandler::class, WalletBalanceResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
        $this->assertGreaterThan(0, $handler->getBody()->count());
    }

    public function testTickersEndpoint()
    {
        $endpoint = RestBuilder::make(TestWalletBalance::class);

        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$walletResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);

        foreach ($body->fetch() as $wallet) {
            $dto = ResponseDtoBuilder::make(WalletBalanceResponse::class, $wallet);
            $this->assertInstanceOf(WalletBalanceResponse::class, $dto);
            $this->assertIsString($dto->getCoin());
            $this->assertIsFloat($dto->getFree());
            $this->assertIsFloat($dto->getTotal());
            $this->assertIsBool($dto->getLocked());
        }
    }
}