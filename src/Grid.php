<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Grid implements View
{
    /** @var Sequence<Card> */
    private Sequence $cards;

    /**
     * @param Sequence<Card> $cards
     */
    private function __construct(Sequence $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @psalm-pure
     *
     * @param Sequence<Card> $cards
     */
    public static function of(Sequence $cards): self
    {
        return new self($cards);
    }

    #[\Override]
    public function render(): Content
    {
        return Lines::of(
            '<div class="grid">',
            ...$this
                ->cards
                ->map(Indent::render(...))
                ->toList(),
            ...['</div>'],
        );
    }
}
