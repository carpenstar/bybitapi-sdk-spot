<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\Overrides;

use Carpenstar\ByBitAPI\Core\Traits\OverrideExecuteTrait;
use Carpenstar\ByBitAPI\Spot\Trade\CancelOrder\CancelOrder;

final class TestCancelOrder extends CancelOrder
{
    use OverrideExecuteTrait;
}