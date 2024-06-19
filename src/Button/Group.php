<?php
declare(strict_types = 1);

namespace Innmind\UI\Button;

use Innmind\UI\{
    View,
    Button,
    Lines,
    Indent,
};
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Group implements View
{
    /** @var non-empty-list<Button> */
    private array $buttons;

    /**
     * @param non-empty-list<Button> $buttons
     */
    private function __construct(array $buttons)
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
        return new self([$first, ...$rest]);
    }

    public function render(): Sequence
    {
        return Lines::of(
            '<div class="button-group">',
            ...\array_map(
                Indent::render(...),
                $this->buttons,
            ),
            ...['</div>'],
        );
    }
}
