<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Picker implements View
{
    /**
     * @param Sequence<Picker\Value> $values
     */
    private function __construct(
        private \UnitEnum $selected,
        private Sequence $values,
        private bool $disable,
    ) {
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     * @template A of \UnitEnum
     *
     * @param A $selected
     * @param Picker\Value<A> $values
     */
    #[\NoDiscard]
    public static function of(\UnitEnum $selected, Picker\Value ...$values): self
    {
        return new self($selected, Sequence::of(...$values), false);
    }

    #[\NoDiscard]
    public function disableWhen(bool $disable): self
    {
        return new self(
            $this->selected,
            $this->values,
            $disable,
        );
    }

    #[\Override]
    public function render(): Content
    {
        return Lines::of(
            \sprintf(
                '<div class="picker %s">',
                match ($this->disable) {
                    true => 'disabled',
                    false => '',
                },
            ),
            ...$this
                ->values
                ->map(fn($value) => Lines::of(
                    \sprintf(
                        '<div class="value %s">',
                        match ($this->selected) {
                            $value->tag() => 'selected',
                            default => '',
                        },
                    ),
                    Indent::render($value->view()),
                    '</div>',
                ))
                ->toList(),
            ...['</div>'],
        );
    }
}
