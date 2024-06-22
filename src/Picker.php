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

    /**
     * @param Sequence<Picker\Value> $values
     */
    private function __construct(\UnitEnum $selected, Sequence $values)
    {
        $this->selected = $selected;
        $this->values = $values;
    }

    /**
     * @psalm-pure
     * @no-named-arguments
     */
    public static function of(\UnitEnum $selected, Picker\Value ...$values): self
    {
        return new self($selected, Sequence::of(...$values));
    }

    public function render(): Sequence
    {
        return Lines::of(
            '<div class="picker">',
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
