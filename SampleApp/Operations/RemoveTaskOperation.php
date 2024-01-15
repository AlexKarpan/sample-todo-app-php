<?php declare(strict_types=1);

namespace SampleApp\Operations;

use SampleApp\Entities\Task;
use SampleApp\TaskManagerInterface;

class RemoveTaskOperation
{
    public function __construct(
        private readonly TaskManagerInterface $taskRepository,
    ) {
    }

    public function __invoke(Task $task): void
    {
        $this->taskRepository->removeTask($task);
    }
}