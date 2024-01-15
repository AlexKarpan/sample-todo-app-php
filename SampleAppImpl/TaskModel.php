<?php declare(strict_types=1);

namespace SampleAppImpl;

use SampleApp\Entities\Task;
use SampleApp\Entities\TaskEntity;

class TaskModel implements Task
{
    use TaskEntity;

    public string $id;
    public string $text;

    public static function create(string $text, ?string $id = null): static
    {
        $task = new static();

        $task->id = $id ?? uniqid();
        $task->setText($text);

        return $task;
    }
}