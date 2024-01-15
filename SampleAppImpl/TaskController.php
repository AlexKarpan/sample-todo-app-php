<?php declare(strict_types=1);

namespace SampleAppImpl;

use SampleApp\Operations\AddTaskOperation;
use SampleApp\Operations\RemoveTaskOperation;
use SampleApp\Operations\UpdateTaskOperation;

class TaskController
{
    public function __construct(
        private readonly TaskManager $taskManager,
    ) {
    }

    public function __invoke(array $request)
    {
        if (isset($request['action'])) {
            try {
                switch ($request['action']) {
                    case 'add':
                        $this->addTask($request);
                        break;

                    case 'remove':
                        $this->removeTask($request);
                        break;

                    case 'update':
                        $this->updateTask($request);
                        break;
                }

                header('Location: /');
                exit;
            } catch (\InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        $tasks = $this->taskManager->listTasks();
        require ROOT_DIR . '/view.php';
    }

    private function addTask(array $request): void
    {
        $text = $request['text'] ?? null;
        if ($text === null) {
            throw new \InvalidArgumentException('Missing required parameter "text"');
        }

        $operation = new AddTaskOperation($this->taskManager);
        $operation->__invoke($text);
    }

    private function removeTask(array $request): void
    {
        $id = $request['id'] ?? null;
        if ($id === null) {
            throw new \InvalidArgumentException('Missing required parameter "id"');
        }

        $task = $this->taskManager->getById($id);
        if ($task === null) {
            throw new \InvalidArgumentException('Task not found');
        }

        $operation = new RemoveTaskOperation($this->taskManager);
        $operation->__invoke($task);
    }

    private function updateTask(array $request): void
    {
        $id = $request['id'] ?? null;
        if ($id === null) {
            throw new \InvalidArgumentException('Missing required parameter "id"');
        }

        $text = $request['text'] ?? null;
        if ($text === null) {
            throw new \InvalidArgumentException('Missing required parameter "text"');
        }

        $task = $this->taskManager->getById($id);
        if ($task === null) {
            throw new \InvalidArgumentException('Task not found');
        }

        $operation = new UpdateTaskOperation($this->taskManager);
        $operation->__invoke($task, $text);
    }
}