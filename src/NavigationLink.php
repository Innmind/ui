<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Url\Url;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class NavigationLink implements View
{
    private Url $url;
    private View $label;
    private bool $active;

    private function __construct(Url $url, View $label, bool $active)
    {
        $this->url = $url;
        $this->label = $label;
        $this->active = $active;
    }

    /**
     * @psalm-pure
     */
    public static function of(Url $url, View $label): self
    {
        return new self($url, $label, false);
    }

    /**
     * @psalm-pure
     */
    public static function text(Url $url, string $label): self
    {
        return new self($url, Text::of($label), false);
    }

    public function active(): self
    {
        return new self(
            $this->url,
            $this->label,
            true,
        );
    }

    public function render(): Sequence
    {
        return Lines::of(
            \sprintf(
                '<a class="navigation-link %s" href="%s">',
                match ($this->active) {
                    true => 'active',
                    false => '',
                },
                $this->url->toString(),
            ),
            Indent::render($this->label),
            '</a>',
        );
    }
}
