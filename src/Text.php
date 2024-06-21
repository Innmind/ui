<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content\Line;
use Innmind\Immutable\{
    Sequence,
    Str,
};

/**
 * @psalm-immutable
 */
final class Text implements View
{
    private string $text;

    private function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @psalm-pure
     */
    public static function of(string $text): self
    {
        return new self($text);
    }

    public function render(): Sequence
    {
        // TODO sanitize
        return Sequence::of(Line::of(Str::of($this->text)));
    }
}
