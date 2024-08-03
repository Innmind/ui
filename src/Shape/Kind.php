<?php
declare(strict_types = 1);

namespace Innmind\UI\Shape;

use Innmind\UI\{
    View,
    Lines,
    Indent,
};
use Innmind\Filesystem\File\Content;

/**
 * @psalm-immutable
 */
final class Kind implements View
{
    private View $inner;
    private string $kind;

    private function __construct(View $inner, string $kind)
    {
        $this->inner = $inner;
        $this->kind = $kind;
    }

    /**
     * @psalm-pure
     */
    public static function cornered(View $inner): self
    {
        return new self($inner, 'cornered');
    }

    /**
     * @psalm-pure
     */
    public static function circle(View $inner): self
    {
        return new self($inner, 'circle');
    }

    public function render(): Content
    {
        return Lines::of(
            \sprintf(
                '<div class="shape %s">',
                $this->kind,
            ),
            Indent::render($this->inner),
            '</div>',
        );
    }
}
