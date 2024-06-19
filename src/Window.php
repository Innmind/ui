<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Window implements View
{
    private string $title;
    private ?View $body;

    private function __construct(string $title, View $body = null)
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * @psalm-pure
     */
    public static function of(string $title, View $body = null): self
    {
        return new self($title, $body);
    }

    public function render(): Sequence
    {
        $lines = Lines::of(
            '<!DOCTYPE html>',
            '<html>',
            '    <head>',
            '        <title>'.$this->title.'</title>',
            '    </head>',
            '    <body>',
        );

        if ($this->body) {
            $lines = $lines->append(
                Indent::render($this->body),
            );
        }

        return $lines->append(
            Lines::of(
                '    </body>',
                '</html>',
            ),
        );
    }
}
