<?php
namespace Carpenstar\ByBitAPI\Spot\LeverageToken\Redeem\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\LeverageToken\Redeem\Reedem;

final class TestReedem extends Reedem
{
    use OverrideExecuteTrait;
}