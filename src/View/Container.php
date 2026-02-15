<?php
declare(strict_types = 1);

namespace Innmind\UI\View;

use Innmind\UI\{
    View,
    Indent,
    Lines,
};
use Innmind\Filesystem\File\Content;

/**
 * @psalm-immutable
 */
final class Container implements View
{
    private function __construct(private View $view)
    {
    }

    /**
     * @psalm-pure
     */
    #[\NoDiscard]
    public static function of(View $view): self
    {
        return new self($view);
    }

    #[\Override]
    public function render(): Content
    {
        return Lines::of(
            '<div class="view">',
            Indent::render($this->view),
            '</div>',
        );
    }
}
