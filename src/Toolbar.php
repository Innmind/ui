<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content;

/**
 * @psalm-immutable
 */
final class Toolbar implements View
{
    private View $label;
    private ?View $leading;
    private ?View $trailing;

    private function __construct(
        View $label,
        ?View $leading,
        ?View $trailing,
    ) {
        $this->label = $label;
        $this->leading = $leading;
        $this->trailing = $trailing;
    }

    /**
     * @psalm-pure
     */
    public static function of(View $label): self
    {
        return new self($label, null, null);
    }

    public function leading(View $view): self
    {
        return new self(
            $this->label,
            $view,
            $this->trailing,
        );
    }

    public function trailing(View $view): self
    {
        return new self(
            $this->label,
            $this->leading,
            $view,
        );
    }

    #[\Override]
    public function render(): Content
    {
        $lines = Lines::of(
            '<header>',
        )->lines();

        if ($this->leading) {
            $lines = $lines->append(
                Lines::of(
                    '<div class="leading">',
                    Indent::render($this->leading),
                    '</div>',
                )->lines(),
            );
        }

        $lines = $lines->append(
            Lines::of(
                '<div class="label">',
                Indent::render($this->label),
                '</div>',
            )->lines(),
        );

        if ($this->trailing) {
            $lines = $lines->append(
                Lines::of(
                    '<div class="trailing">',
                    Indent::render($this->trailing),
                    '</div>',
                )->lines(),
            );
        }

        return Content::ofLines($lines->append(Lines::of('</header>')->lines()));
    }
}
