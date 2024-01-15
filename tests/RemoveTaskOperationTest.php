<?php declare(strict_types=1);

class RemoveTaskOperationTest extends \PHPUnit\Framework\TestCase
{
    public function testItRemovesTasks(): void
    {
        $taskManager = new SampleAppImpl\TaskManager();
        $taskManager->clearTasks();

        $task1 = $taskManager->createTask("Test task1");
        $task2 = $taskManager->createTask("Test task2");

        $taskManager->removeTask($task1);

        $allTasks = $taskManager->listTasks();
        $this->assertCount(1, $allTasks);
        $this->assertEquals($task2, $allTasks[0]);
    }
}