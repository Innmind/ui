<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;

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

    /**
     * @internal
     * @psalm-pure
     */
    public static function escape(string $string): string
    {
        return \htmlspecialchars(
            $string,
            \ENT_QUOTES | \ENT_SUBSTITUTE | \ENT_HTML5,
            'UTF-8',
        );
    }

    #[\Override]
    public function render(): Content
    {
        return Content::ofString(self::escape($this->text));
    }
}
