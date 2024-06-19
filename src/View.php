<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\Filesystem\File\Content\Line;
use Innmind\Immutable\Sequence;

/**
 * @psalm-immutable
 */
interface View
{
    /**
     * @return Sequence<Line>
     */
    public function render(): Sequence;
}
