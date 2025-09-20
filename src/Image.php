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
    private Url $src;

    private function __construct(Url $src)
    {
        $this->src = $src;
    }

    /**
     * @psalm-pure
     */
    public static function of(Url $src): self
    {
        return new self($src);
    }

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
