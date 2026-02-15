<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Url\Url;

/**
 * @psalm-immutable
 */
final class Image implements View
{
    private function __construct(private Url $src)
    {
    }

    /**
     * @psalm-pure
     */
    #[\NoDiscard]
    public static function of(Url $src): self
    {
        return new self($src);
    }

    #[\NoDiscard]
    public function shape(Shape $shape): View
    {
        return $shape->wrap($this);
    }

    #[\Override]
    public function render(): Content
    {
        return Lines::of(\sprintf(
            '<img src="%s"/>',
            $this->src->toString(),
        ));
    }
}
