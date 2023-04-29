<?php

declare(strict_types=1);

namespace Tests\Invoice;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Application\ApprovalFacade;
use Illuminate\Contracts\Events\Dispatcher;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ActionsTest extends TestCase
{

    /**
     * @var Dispatcher|MockObject
     */
    private $dispatcher;

    private ApprovalFacade $approvalFacade;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        $this->dispatcher = $this->createMock(Dispatcher::class);
        $this->dispatcher->expects($this->any())
        ->method('dispatch')
        ->willReturn([]);

        $this->approvalFacade = new ApprovalFacade($this->dispatcher);
    }

   /**
    * Approve invoice scenarios.
    *
    * /**
    * @test
    * @dataProvider data
    */
    public function testApprove(StatusEnum $status): void
    {
        $approvalDto = new ApprovalDto(
            Uuid::fromString('c80c9177-f4ad-3b38-982a-cf7e919f0049'),
            $status,
            'invoice'
        );

        if (StatusEnum::DRAFT !== $status) {
            $this->expectException(\LogicException::class);
        }
        $this->assertTrue($this->approvalFacade->approve($approvalDto));
    }

    /**
     * Approve invoice scenarios.
     *
     * /**
     * @test
     * @dataProvider data
     */
    public function testReject(StatusEnum $status): void
    {
        $approvalDto = new ApprovalDto(
            Uuid::fromString('c80c9177-f4ad-3b38-982a-cf7e919f0049'),
            $status,
            'invoice'
        );

        if (StatusEnum::DRAFT !== $status) {
            $this->expectException(\LogicException::class);
        }

        $this->assertTrue($this->approvalFacade->reject($approvalDto));
    }

    /**
     * @return StatusEnum[][]
     */
    public function data(): array
    {
        return [
            [StatusEnum::DRAFT],
            [StatusEnum::APPROVED],
            [StatusEnum::REJECTED],
        ];
    }
}
