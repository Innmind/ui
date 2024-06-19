<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Stack implements View
{
    private bool $horizontal;
    /** @var non-empty-list<View> */
    private array $views;

    /**
     * @param non-empty-list<View> $views
     */
    private function __construct(bool $horizontal, array $views)
    {
        $this->horizontal = $horizontal;
        $this->views = $views;
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     */
    public static function horizontal(View $first, View $second, View ...$rest): self
    {
        return new self(true, [$first, $second, ...$rest]);
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     */
    public static function vertical(View $first, View $second, View ...$rest): self
    {
        return new self(false, [$first, $second, ...$rest]);
    }

    public function render(): Sequence
    {
        $class = match ($this->horizontal) {
            true => 'horizontal-stack',
            false => 'vertical-stack',
        };

        return Lines::of(
            "<div class=\"$class\">",
            ...\array_map(
                Indent::render(...),
                $this->views,
            ),
            '</div>',
        );
    }
}
