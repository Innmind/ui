<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Immutable\Sequence;

/**
 * @internal
 */
final class Indent
{
    /**
     * @internal
     * @psalm-pure
     */
    public static function render(View $view): Content
    {
        return self::content($view->render());
    }

    /**
     * @internal
     * @psalm-pure
     */
    public static function content(Content $content): Content
    {
        return $content->map(self::line(...));
    }

    /**
     * @internal
     * @psalm-pure
     *
     * @param Sequence<Content\Line> $lines
     *
     * @return Sequence<Content\Line>
     */
    public static function lines(Sequence $lines): Sequence
    {
        return $lines->map(self::line(...));
    }

    /**
     * @internal
     * @psalm-pure
     */
    public static function line(Content\Line $line): Content\Line
    {
        return $line->map(static fn($str) => $str->prepend('    '));
    }
}
