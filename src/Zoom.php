<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Zoom implements View
{
    private View $inner;
    /** @var int<1, 100> */
    private int $size;

    /**
     * @param int<1, 100> $size
     */
    private function __construct(View $inner, int $size)
    {
        $this->inner = $inner;
        $this->size = $size;
    }

    /**
     * @psalm-pure
     *
     * @param int<1, 100> $size
     */
    public static function of(View $inner, int $size): self
    {
        return new self($inner, $size);
    }

    public function render(): Sequence
    {
        return Lines::of(
            \sprintf('<div style="zoom: %s%%">', $this->size),
            Indent::render($this->inner),
            '</div>',
        );
    }
}
