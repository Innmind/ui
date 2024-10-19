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
    /** @var T */
    private \UnitEnum $tag;
    private View $view;

    /**
     * @param T $tag
     */
    private function __construct(\UnitEnum $tag, View $view)
    {
        $this->tag = $tag;
        $this->view = $view;
    }

    /**
     * @psalm-pure
     * @template A of \UnitEnum
     *
     * @param A $tag
     *
     * @return self<A>
     */
    public static function of(\UnitEnum $tag, View $view): self
    {
        return new self($tag, $view);
    }

    public function tag(): \UnitEnum
    {
        return $this->tag;
    }

    public function view(): View
    {
        return $this->view;
    }
}
