<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Stack implements View
{
    /**
     * @param Sequence<View> $views
     */
    private function __construct(
        private bool $horizontal,
        private Sequence $views,
    ) {
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     */
    #[\NoDiscard]
    public static function horizontal(View $first, View $second, View ...$rest): self
    {
        return new self(true, Sequence::of($first, $second, ...$rest));
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     */
    #[\NoDiscard]
    public static function vertical(View $first, View $second, View ...$rest): self
    {
        return new self(false, Sequence::of($first, $second, ...$rest));
    }

    #[\Override]
    public function render(): Content
    {
        $class = match ($this->horizontal) {
            true => 'horizontal-stack',
            false => 'vertical-stack',
        };

        return Lines::of(
            "<div class=\"$class\">",
            ...$this
                ->views
                ->map(View\Container::of(...))
                ->map(Indent::render(...))
                ->toList(),
            ...['</div>'],
        );
    }
}
