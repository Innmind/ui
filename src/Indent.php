<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content\Line;
use Innmind\Immutable\Sequence;

/**
 * @internal
 */
final class Indent
{
    /**
     * @psalm-pure
     *
     * @return Sequence<Line>
     */
    public static function render(View $view): Sequence
    {
        return self::lines($view->render());
    }

    /**
     * @psalm-pure
     *
     * @param Sequence<Line> $lines
     *
     * @return Sequence<Line>
     */
    public static function lines(Sequence $lines): Sequence
    {
        return $lines->map(self::line(...));
    }

    /**
     * @psalm-pure
     */
    public static function line(Line $line): Line
    {
        return $line->map(static fn($str) => $str->prepend('    '));
    }
}
