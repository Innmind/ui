<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Url\Url;

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

    public function render(): Content
    {
        $lines = Lines::of(
            '<!DOCTYPE html>',
            '<html>',
            '    <head>',
            '        <title>'.$this->title.'</title>',
        )->lines();

        if ($this->style) {
            $lines = $lines->append(Lines::of(\sprintf(
                '        <link rel="stylesheet" href="%s" />',
                $this->style->toString(),
            ))->lines());
        }

        $lines = $lines->append(Lines::of(
            '    </head>',
            '    <body>',
        )->lines());

        if ($this->body) {
            $lines = $lines->append(
                Indent::lines(Indent::render($this->body)->lines()),
            );
        }

        return Content::ofLines($lines->append(
            Lines::of(
                '    </body>',
                '</html>',
            )->lines(),
        ));
    }
}
