<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
interface View
{
    /**
     * @return Sequence<string>
     */
    public function render(): Sequence;
}
