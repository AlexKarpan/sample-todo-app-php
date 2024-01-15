<?php declare(strict_types=1);

namespace SampleApp;

use SampleApp\Entities\Task;

interface TaskManagerInterface
{
    public function createTask(string $text): Task;
    public function removeTask(Task $task): void;
    public function updateTask(Task $task, string $text): void;
}