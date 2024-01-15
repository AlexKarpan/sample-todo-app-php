<?php declare(strict_types=1);

namespace SampleApp\Entities;

/**
 * @property string $text
 *
 * @implements Task
 */
trait TaskEntity
{
    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        if (strlen($text) > 255) {
            throw new \InvalidArgumentException('Text is too long');
        }

        $this->text = $text;
    }
}