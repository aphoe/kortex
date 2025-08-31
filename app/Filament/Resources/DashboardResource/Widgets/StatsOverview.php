<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Bookmark;
use App\Models\Certification;
use App\Models\Company;
use App\Models\Course;
use App\Models\Resource;
use App\Models\Tool;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected ?string $heading = 'Site Stats';

    protected ?string $description = 'An overview of some stats.';

    protected function getStats(): array
    {
        return [
            Stat::make('Resources', Number::abbreviate(Resource::count(), maxPrecision: 3))
                ->description('Total resources')
                ->descriptionIcon('heroicon-s-cpu-chip'),
            Stat::make('Tools', Number::abbreviate(Tool::count(), maxPrecision: 3))
                ->description('Total tools')
                ->descriptionIcon('heroicon-s-wrench-screwdriver'),
            Stat::make('Certifications', Number::abbreviate(Certification::count(), maxPrecision: 3))
                ->description('Total certifications')
                ->descriptionIcon('heroicon-s-sparkles'),
            Stat::make('Courses', Number::abbreviate(Course::count(), maxPrecision: 3))
                ->description('Total courses')
                ->descriptionIcon('heroicon-s-book-open'),
            Stat::make('Bookmarks', Number::abbreviate(Bookmark::count(), maxPrecision: 3))
                ->description('Total saved bookmarks')
                ->descriptionIcon('heroicon-s-bookmark'),
            Stat::make('Companies', Number::abbreviate(Company::count(), maxPrecision: 3))
                ->description('Total companies')
                ->descriptionIcon('heroicon-s-building-office'),
        ];
    }
}
