<?php
declare(strict_types = 1);

namespace Innmind\UI;

/**
 * @psalm-immutable
 */
enum Shape
{
    case cornered;
    case circle;

    public function wrap(View $view): View
    {
        return match ($this) {
            self::cornered => Shape\Kind::cornered($view),
            self::circle => Shape\Kind::circle($view),
        };
    }
}
