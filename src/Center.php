<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;

/**
 * @psalm-immutable
 */
final class Center implements View
{
    private function __construct(private View $inner)
    {
    }

    /**
     * @psalm-pure
     */
    public static function of(View $inner): self
    {
        return new self($inner);
    }

    #[\Override]
    public function render(): Content
    {
        return Lines::of(
            '<div class="center">',
            Indent::render($this->inner),
            '</div>',
        );
    }
}
