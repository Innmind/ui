<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Listing implements View
{
    /** @var Sequence<View> */
    private Sequence $elements;

    /**
     * @param Sequence<View> $elements
     */
    private function __construct(Sequence $elements)
    {
        $this->elements = $elements;
    }

    /**
     * @psalm-pure
     *
     * @param Sequence<View> $elements
     */
    public static function of(Sequence $elements): self
    {
        return new self($elements);
    }

    public function render(): Content
    {
        return Lines::of(
            '<ul>',
            Content::ofLines(Indent::lines(
                $this->elements->flatMap(
                    static fn($view) => Lines::of(
                        '<li>',
                        Indent::render($view),
                        '</li>',
                    )->lines(),
                ),
            )),
            '</ul>',
        );
    }
}
