<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrder;

use Carpenstar\ByBitAPI\Core\Objects\ResponseEntity;

class BCOResponse extends ResponseEntity
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
     * @return BCOResponse
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