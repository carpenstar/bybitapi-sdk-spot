<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Response;

use Carpenstar\ByBitAPI\Core\Objects\AbstractResponse;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\IBatchCancelOrderResponseInterface;

class BatchCancelOrderResponse extends AbstractResponse implements IBatchCancelOrderResponseInterface
{
    /**
     * @var bool $success
     */
    private bool $success;

    public function __construct(array $data)
    {
        $this
            ->setSuccess($data['success']);
    }

    /**
     * @param int $success
     * @return BatchCancelOrderResponse
     */
    public function setSuccess(int $success): self
    {
        $this->success = (bool)$success;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }
}