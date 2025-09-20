<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Immutable\{
    Sequence,
    Str,
};

/**
 * @psalm-immutable
 */
final class Progress implements View
{
    private function __construct()
    {
    }

    /**
     * @psalm-pure
     */
    public static function new(): self
    {
        return new self;
    }

    #[\Override]
    public function render(): Content
    {
        $svg = static fn(bool $black): string => \sprintf(
            <<<SVG
            <svg width="24" height="24" %s viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_OSmW{transform-origin:center;animation:spinner_T6mA .75s step-end infinite}@keyframes spinner_T6mA{8.3%%{transform:rotate(30deg)}16.6%%{transform:rotate(60deg)}25%%{transform:rotate(90deg)}33.3%%{transform:rotate(120deg)}41.6%%{transform:rotate(150deg)}50%%{transform:rotate(180deg)}58.3%%{transform:rotate(210deg)}66.6%%{transform:rotate(240deg)}75%%{transform:rotate(270deg)}83.3%%{transform:rotate(300deg)}91.6%%{transform:rotate(330deg)}100%%{transform:rotate(360deg)}}</style><g class="spinner_OSmW"><rect x="11" y="1" width="2" height="5" opacity=".14"/><rect x="11" y="1" width="2" height="5" transform="rotate(30 12 12)" opacity=".29"/><rect x="11" y="1" width="2" height="5" transform="rotate(60 12 12)" opacity=".43"/><rect x="11" y="1" width="2" height="5" transform="rotate(90 12 12)" opacity=".57"/><rect x="11" y="1" width="2" height="5" transform="rotate(120 12 12)" opacity=".71"/><rect x="11" y="1" width="2" height="5" transform="rotate(150 12 12)" opacity=".86"/><rect x="11" y="1" width="2" height="5" transform="rotate(180 12 12)"/></g></svg>
            SVG,
            match ($black) {
                true => 'fill="#fff"',
                false => '',
            },
        );

        return Lines::of(
            '<picture>',
            Content::ofLines(Sequence::of(
                Indent::line(Content\Line::of(Str::of('<source media="(prefers-color-scheme: dark)" srcset="data:image/svg+xml;base64,%s"/>')->sprintf(
                    \base64_encode($svg(true)),
                ))),
                Indent::line(Content\Line::of(Str::of('<img src="data:image/svg+xml;base64,%s"/>')->sprintf(
                    \base64_encode($svg(false)),
                ))),
            )),
            '</picture>',
        );
    }
}
