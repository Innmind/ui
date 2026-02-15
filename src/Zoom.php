<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;

/**
 * @psalm-immutable
 */
final class Zoom implements View
{
    /**
     * @param int<1, 100> $size
     */
    private function __construct(
        private View $inner,
        private int $size,
    ) {
    }

    /**
     * @psalm-pure
     *
     * @param int<1, 100> $size
     */
    #[\NoDiscard]
    public static function of(View $inner, int $size): self
    {
        return new self($inner, $size);
    }

    #[\Override]
    public function render(): Content
    {
        return Lines::of(
            \sprintf('<div style="zoom: %s%%">', $this->size),
            Indent::render($this->inner),
            '</div>',
        );
    }
}
