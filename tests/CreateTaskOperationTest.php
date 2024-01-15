<?php declare(strict_types=1);

class CreateTaskOperationTest extends \PHPUnit\Framework\TestCase
{
    public function testItCreatesTasks(): void
    {
        $taskManager = new SampleAppImpl\TaskManager();
        $taskManager->clearTasks();

        $task = $taskManager->createTask("Test task");
        $this->assertEquals("Test task", $task->getText());

        $allTasks = $taskManager->listTasks();
        $this->assertCount(1, $allTasks);
        $this->assertEquals($task, $allTasks[0]);
    }
}