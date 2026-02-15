<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;

/**
 * @psalm-immutable
 */
final class Svg implements View
{
    private function __construct(private Content $data)
    {
    }

    /**
     * @psalm-pure
     */
    #[\NoDiscard]
    public static function of(Content $data): self
    {
        return new self($data);
    }

    /**
     * @param int<1, 100> $size
     */
    #[\NoDiscard]
    public function zoom(int $size): View
    {
        return Zoom::of($this, $size);
    }

    #[\Override]
    public function render(): Content
    {
        return Lines::of(
            '<div class="svg">',
            $this->data,
            '</div>',
        );
    }
}
