<?php
declare(strict_types = 1);

namespace Innmind\UI\View;

use Innmind\UI\{
    View,
    Indent,
    Lines,
};
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Container implements View
{
    private View $view;

    private function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * @psalm-pure
     */
    public static function of(View $view): self
    {
        return new self($view);
    }

    public function render(): Sequence
    {
        return Lines::of(
            '<div class="view">',
            Indent::render($this->view),
            '</div>',
        );
    }
}
