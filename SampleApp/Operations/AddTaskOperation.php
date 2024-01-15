<?php declare(strict_types=1);

namespace SampleApp\Operations;

use SampleApp\Entities\Task;
use SampleApp\TaskManagerInterface;

class AddTaskOperation
{
    public function __construct(
        private readonly TaskManagerInterface $taskManager,
    ) {
    }

    public function __invoke(string $text): Task
    {
        return $this->taskManager->createTask($text);
    }
}