<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;
use Innmind\Url\Url;

/**
 * @psalm-immutable
 */
final class Button implements View
{
    private function __construct(
        private Url $url,
        private View $label,
        private bool $selected,
    ) {
    }

    /**
     * @psalm-pure
     */
    #[\NoDiscard]
    public static function of(Url $url, View $label): self
    {
        return new self($url, $label, false);
    }

    /**
     * @psalm-pure
     */
    #[\NoDiscard]
    public static function text(Url $url, string $label): self
    {
        return new self($url, Text::of($label), false);
    }

    #[\NoDiscard]
    public function selected(): self
    {
        return new self(
            $this->url,
            $this->label,
            true,
        );
    }

    #[\NoDiscard]
    public function selectedWhen(bool $selected): self
    {
        return new self(
            $this->url,
            $this->label,
            $selected,
        );
    }

    #[\Override]
    public function render(): Content
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
