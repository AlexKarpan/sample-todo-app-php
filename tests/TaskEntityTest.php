<?php declare(strict_types=1);

class TaskEntityTest extends \PHPUnit\Framework\TestCase
{
    public function testTextCannotExceedMaxLength(): void
    {
        $task = SampleAppImpl\TaskModel::create('Test task');

        $task->setText(str_repeat('a', 255));

        $this->expectException(\InvalidArgumentException::class);
        $task->setText(str_repeat('a', 256));
    }
}