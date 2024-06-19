<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Url\Url;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Button implements View
{
    private Url $url;
    private View $label;

    private function __construct(Url $url, View $label)
    {
        $this->url = $url;
        $this->label = $label;
    }

    /**
     * @psalm-pure
     */
    public static function of(Url $url, View $label): self
    {
        return new self($url, $label);
    }

    /**
     * @psalm-pure
     */
    public static function text(Url $url, string $label): self
    {
        return new self($url, Text::of($label));
    }

    public function render(): Sequence
    {
        return Lines::of(
            \sprintf('<a href="%s">', $this->url->toString()),
            Indent::render($this->label),
            '</a>',
        );
    }
}
