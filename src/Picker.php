<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Picker implements View
{
    private \UnitEnum $selected;
    /** @var Sequence<Picker\Value> */
    private Sequence $values;
    private bool $disable;

    /**
     * @param Sequence<Picker\Value> $values
     */
    private function __construct(
        \UnitEnum $selected,
        Sequence $values,
        bool $disable,
    ) {
        $this->selected = $selected;
        $this->values = $values;
        $this->disable = $disable;
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     * @template A of \UnitEnum
     *
     * @param A $selected
     * @param Picker\Value<A> $values
     */
    public static function of(\UnitEnum $selected, Picker\Value ...$values): self
    {
        return new self($selected, Sequence::of(...$values), false);
    }

    public function disableWhen(bool $disable): self
    {
        return new self(
            $this->selected,
            $this->values,
            $disable,
        );
    }

    public function render(): Sequence
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
