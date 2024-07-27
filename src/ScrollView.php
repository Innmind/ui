<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class ScrollView implements View
{
    private View $inner;

    private function __construct(View $inner)
    {
        $this->inner = $inner;
    }

    /**
     * @psalm-pure
     */
    public static function of(View $inner): self
    {
        return new self($inner);
    }

    public function render(): Sequence
    {
        return Lines::of(
            '<div class="scrollview">',
            Indent::render($this->inner),
            '</div>',
        );
    }
}
