<?php declare(strict_types=1);

namespace SampleAppImpl;

use SampleApp\Entities\Task;
use SampleApp\TaskManagerInterface;

class TaskManager implements TaskManagerInterface
{
    private ?array $tasks;

    public function __construct()
    {
        $this->loadTasks();
    }

    private function getFilename(): string
    {
        return ROOT_DIR . DIRECTORY_SEPARATOR . 'tasks.json';
    }

    private function loadTasks(): void
    {
        try {
            if (!file_exists($this->getFilename())) {
                $this->tasks = [];
                return;
            }

            $tasks = json_decode(file_get_contents($this->getFilename()), flags: JSON_THROW_ON_ERROR);
            $this->tasks = array_map(
                fn($task) => TaskModel::create($task->text, $task->id),
                $tasks
            );
        } catch (\Throwable) {
            $this->tasks = [];
        }
    }

    private function saveTasks(): void
    {
        $tasks = array_map(
            fn(TaskModel $task) => ['id' => $task->id, 'text' => $task->getText()],
            $this->tasks
        );
        file_put_contents($this->getFilename(), json_encode($tasks));
    }

    public function createTask(string $text): Task
    {
        $task = TaskModel::create($text);

        $this->tasks[] = $task;
        $this->saveTasks();

        return $task;
    }

    public function removeTask(Task $task): void
    {
        $this->tasks = array_filter($this->tasks, fn(TaskModel $t) => $t->id !== $task->id);
        $this->saveTasks();
    }

    public function updateTask(Task $task, string $text): void
    {
        $task->setText($text);
        $this->saveTasks();
    }

    public function getById(string $id): ?Task
    {
        foreach ($this->tasks as $task) {
            if ($task->id === $id) {
                return $task;
            }
        }

        return null;
    }

    public function listTasks(): array
    {
        return array_values($this->tasks);
    }

    public function clearTasks(): void
    {
        $this->tasks = [];
        $this->saveTasks();
    }
}