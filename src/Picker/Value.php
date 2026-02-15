<?php
declare(strict_types = 1);

namespace Innmind\UI\Picker;

use Innmind\UI\View;

/**
 * @psalm-immutable
 * @template T of \UnitEnum
 */
final class Value
{
    /**
     * @param T $tag
     */
    private function __construct(
        private \UnitEnum $tag,
        private View $view,
    ) {
    }

    /**
     * @psalm-pure
     * @template A of \UnitEnum
     *
     * @param A $tag
     *
     * @return self<A>
     */
    #[\NoDiscard]
    public static function of(\UnitEnum $tag, View $view): self
    {
        return new self($tag, $view);
    }

    #[\NoDiscard]
    public function tag(): \UnitEnum
    {
        return $this->tag;
    }

    #[\NoDiscard]
    public function view(): View
    {
        return $this->view;
    }
}
