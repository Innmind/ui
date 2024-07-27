<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;
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

    public function render(): Sequence
    {
        return Lines::of(\sprintf(
            '<img src="%s"/>',
            $this->src->toString(),
        ));
    }
}
