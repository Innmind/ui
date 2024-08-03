<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Immutable\Str;

/**
 * @internal
 */
final class Lines
{
    /**
     * @internal
     * @psalm-pure
     */
    public static function of(
        Content|string $first,
        Content|string ...$rest,
    ): Content {
        $content = match (true) {
            \is_string($first) => Content::ofString($first),
            default => $first,
        };

        foreach ($rest as $part) {
            $content = match (true) {
                \is_string($part) => Content::ofLines(
                    $content
                        ->lines()
                        ->add(Content\Line::of(Str::of($part))),
                ),
                default => Content::ofLines(
                    $part
                        ->lines()
                        ->prepend($content->lines()),
                ),
            };
        }

        return $content;
    }
}
