<?php
namespace Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Tests;

use Carpenstar\ByBitAPI\Core\Builders\ResponseDtoBuilder;
use Carpenstar\ByBitAPI\Core\Builders\ResponseHandlerBuilder;
use Carpenstar\ByBitAPI\Core\Builders\RestBuilder;
use Carpenstar\ByBitAPI\Core\Enums\EnumOutputMode;
use Carpenstar\ByBitAPI\Core\Objects\Collection\EntityCollection;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseDto;
use Carpenstar\ByBitAPI\Core\Response\CurlResponseHandler;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Overrides\TestBatchCancelOrderById;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Request\BatchCancelOrderByIdRequest;
use Carpenstar\ByBitAPI\Spot\Trade\BatchCancelOrderById\Response\BatchCancelOrderByIdResponse;
use PHPUnit\Framework\TestCase;

class BatchCancelOrderByIdTest extends TestCase
{
    static private string $batchCancelOrderByIdResponse = '{"retCode":0,"retMsg":"OK","result":{"list":[]},"retExtInfo":{},"time":1659080815222}';

    public function testBatchCancelOrderByIdDTOBuilder()
    {
        $dto = ResponseDtoBuilder::make(BatchCancelOrderByIdResponse::class, ["orderId" => 12345, "code" => "test-error"]);
        $this->assertInstanceOf(BatchCancelOrderByIdResponse::class, $dto);
    }

    public function testBatchCancelOrderByIdResponseHandlerBuilder()
    {
        $handler = ResponseHandlerBuilder::make(self::$batchCancelOrderByIdResponse, CurlResponseHandler::class, BatchCancelOrderByIdResponse::class);
        $this->assertInstanceOf(EntityCollection::class, $handler->getBody());
    }

    public function testBatchCancelOrderByIdEndpoint()
    {
        $endpoint = RestBuilder::make(TestBatchCancelOrderById::class, (new BatchCancelOrderByIdRequest())->setOrderIds("12345"));
        $entityResponse = $endpoint->execute(EnumOutputMode::MODE_ENTITY, self::$batchCancelOrderByIdResponse);
        $this->assertInstanceOf(CurlResponseDto::class, $entityResponse);
        $body = $entityResponse->getBody();
        $this->assertInstanceOf(EntityCollection::class, $body);
    }
}