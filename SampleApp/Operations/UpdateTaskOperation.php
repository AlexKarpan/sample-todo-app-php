<?php declare(strict_types=1);

namespace SampleApp\Operations;

use SampleApp\Entities\Task;
use SampleApp\TaskManagerInterface;

class UpdateTaskOperation
{
    public function __construct(
        private readonly TaskManagerInterface $taskManager,
    ) {
    }

    public function __invoke(Task $task, string $text): void
    {
        $this->taskManager->updateTask($task, $text);
    }
}