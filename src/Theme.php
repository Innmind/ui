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
            ->mount(Path::of(\dirname(__DIR__).'/themes/'))
            ->maybe()
            ->flatMap(fn($adapter) => $adapter->get(Name::of(\sprintf(
                '%s.css',
                $this->name,
            ))))
            ->keep(Instance::of(File::class))
            ->map(static fn($file) => $file->content());
    }
}
