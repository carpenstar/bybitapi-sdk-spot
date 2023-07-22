<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder\Response;

use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class BatchCancelOrderResponse extends ResponseEntity
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