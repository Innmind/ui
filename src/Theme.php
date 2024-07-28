<?php
declare(strict_types = 1);

namespace Innmind\UI;

use Innmind\OperatingSystem\Filesystem;
use Innmind\Filesystem\{
    File,
    File\Content,
    Name,
};
use Innmind\Url\Path;
use Innmind\Immutable\{
    Maybe,
    Predicate\Instance,
};

enum Theme
{
    case default;

    /**
     * @return Maybe<Content>
     */
    public function load(Filesystem $filesystem): Maybe
    {
        return $filesystem
            ->mount(Path::of(__DIR__.'/../themes/'))
            ->get(Name::of(\sprintf(
                '%s.css',
                $this->name,
            )))
            ->keep(Instance::of(File::class))
            ->map(static fn($file) => $file->content());
    }
}
