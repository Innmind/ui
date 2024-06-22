<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Url\Url;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Window implements View
{
    private string $title;
    private ?View $body;
    private ?Url $style;

    private function __construct(
        string $title,
        ?View $body,
        ?Url $style,
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->style = $style;
    }

    /**
     * @psalm-pure
     */
    public static function of(string $title, View $body = null): self
    {
        return new self($title, $body, null);
    }

    public function stylesheet(Url $url): self
    {
        return new self(
            $this->title,
            $this->body,
            $url,
        );
    }

    public function render(): Sequence
    {
        $lines = Lines::of(
            '<!DOCTYPE html>',
            '<html>',
            '    <head>',
            '        <title>'.$this->title.'</title>',
        );

        if ($this->style) {
            $lines = $lines->append(Lines::of(\sprintf(
                '<link rel="stylesheet" href="%s" />',
                $this->style->toString(),
            )));
        }

        $lines = $lines->append(Lines::of(
            '    </head>',
            '    <body>',
        ));

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
