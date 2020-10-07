<?php

namespace Styde\Enlighten;

use Illuminate\Support\Collection;

class Module
{
    use ReadsDynamicAttributes, GetsStatsFromGroups;

    public static function all()
    {
        return ModuleCollection::make(config('enlighten.modules'))
            ->map(function ($item) {
                return new static($item['name'], $item['pattern']);
            });
    }

    public function __construct(string $name, $pattern = [])
    {
        $this->setAttributes([
            'name' => $name,
            'pattern' => $pattern,
        ]);
    }

    public function addGroups(Collection $groups): void
    {
        $this->attributes['groups'] = $groups;
    }

    public function getPassed(): bool
    {
        return $this->status === 'passed';
    }
}
