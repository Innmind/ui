<?php
declare(strict_types = 1);

namespace Innmind\UI\Button;

use Innmind\UI\{
    View,
    Button,
    Lines,
    Indent,
};
use Innmind\Filesystem\File\Content;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Group implements View
{
    /** @var Sequence<Button> */
    private Sequence $buttons;

    /**
     * @param Sequence<Button> $buttons
     */
    private function __construct(Sequence $buttons)
    {
        $this->buttons = $buttons;
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     */
    public static function of(
        Button $first,
        Button ...$rest,
    ): self {
        return new self(Sequence::of($first, ...$rest));
    }

    public function render(): Content
    {
        return Lines::of(
            '<div class="button-group">',
            ...$this
                ->buttons
                ->map(View\Container::of(...))
                ->map(Indent::render(...))
                ->toList(),
            ...['</div>'],
        );
    }
}
