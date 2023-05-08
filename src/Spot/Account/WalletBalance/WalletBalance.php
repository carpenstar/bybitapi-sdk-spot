<?php
namespace Carpenstar\ByBitAPI\Spot\Account\WalletBalance;

use Carpenstar\ByBitAPI\Core\Endpoints\PrivateEndpoint;
use Carpenstar\ByBitAPI\Core\Interfaces\IGetEndpointInterface;
use Carpenstar\ByBitAPI\Spot\Account\WalletBalance\Dto\WalletBalanceDto;

/**
 * https://bybit-exchange.github.io/docs/spot/wallet
 */
class WalletBalance extends PrivateEndpoint implements IGetEndpointInterface
{
    protected string $url = "/spot/v3/private/account";

    protected function getResponseEntityClassName(): string
    {
        return WalletBalanceDto::class;
    }
}