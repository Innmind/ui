<?php
declare(strict_types = 1);

namespace Innmind\UI\Picker;

use Innmind\UI\View;

/**
 * @psalm-immutable
 */
final class Value
{
    private \UnitEnum $tag;
    private View $view;

    private function __construct(\UnitEnum $tag, View $view)
    {
        $this->tag = $tag;
        $this->view = $view;
    }

    /**
     * @psalm-pure
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
