<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

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

    public function render(): Sequence
    {
        $lines = Lines::of(
            '<header>',
        );

        if ($this->leading) {
            $lines = $lines->append(
                Lines::of(
                    '<div class="leading">',
                    Indent::render($this->leading),
                    '</div>',
                ),
            );
        }

        $lines = $lines->append(
            Lines::of(
                '<div class="label">',
                Indent::render($this->label),
                '</div>',
            ),
        );

        if ($this->trailing) {
            $lines = $lines->append(
                Lines::of(
                    '<div class="trailing">',
                    Indent::render($this->trailing),
                    '</div>',
                ),
            );
        }

        return $lines->append(Lines::of('</header>'));
    }
}
