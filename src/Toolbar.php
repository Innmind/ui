<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
final class Toobar implements View
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

    public function render(): Sequence
    {
        $lines = Sequence::lazyStartingWith(
            '<header>',
        );

        if ($this->leading) {
            $lines = $lines
                ->add('<div class="leading">')
                ->append(
                    $this
                        ->leading
                        ->render()
                        ->map(static fn($line) => '    '.$line),
                )
                ->add('</div>');
        }

        $lines = $lines
            ->add('<div class="label">')
            ->append(
                $this
                    ->label
                    ->render()
                    ->map(static fn($line) => '    '.$line),
            )
            ->add('</div>');

        if ($this->trailing) {
            $lines = $lines
                ->add('<div class="trailing">')
                ->append(
                    $this
                        ->trailing
                        ->render()
                        ->map(static fn($line) => '    '.$line),
                )
                ->add('</div>');
        }

        return $lines->add('</header>');
    }
}
