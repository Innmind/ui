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
    private bool $selected;

    private function __construct(Url $url, View $label, bool $selected)
    {
        $this->url = $url;
        $this->label = $label;
        $this->selected = $selected;
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

    public function selected(): self
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
                '<a class="button %s" href="%s">',
                match ($this->selected) {
                    true => 'selected',
                    false => '',
                },
                $this->url->toString(),
            ),
            Indent::render($this->label),
            '</a>',
        );
    }
}
