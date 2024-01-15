<?php declare(strict_types=1);

class UpdateTaskOperationTest extends \PHPUnit\Framework\TestCase
{
    public function testItUpdatesTasks(): void
    {
        $taskManager = new SampleAppImpl\TaskManager();
        $taskManager->clearTasks();

        $task = $taskManager->createTask("Test task");
        $taskManager->updateTask($task, "Updated task");

        $allTasks = $taskManager->listTasks();
        $this->assertCount(1, $allTasks);
        $this->assertEquals("Updated task", $allTasks[0]->getText());
    }
}