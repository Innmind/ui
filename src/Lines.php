<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content\Line;
use Innmind\Immutable\{
    Sequence,
    Str,
};

/**
 * @internal
 */
final class Lines
{
    /**
     * @psalm-pure
     *
     * @param Sequence<Line>|string $first
     * @param Sequence<Line>|string $rest
     *
     * @return Sequence<Line>
     */
    public static function of(
        Sequence|string $first,
        Sequence|string ...$rest,
    ): Sequence {
        $lines = match (true) {
            \is_string($first) => Sequence::lazyStartingWith(Line::of(Str::of($first))),
            default => $first,
        };

        foreach ($rest as $part) {
            $lines = match (true) {
                \is_string($part) => $lines->add(Line::of(Str::of($part))),
                default => $lines->append($part),
            };
        }

        return $lines;
    }
}
