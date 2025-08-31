<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Classes\WidgetSetting;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;

class TagsChart extends ChartWidget
{
    protected static ?string $heading = 'Tags';

    protected static ?string $pollingInterval = null;

    protected static string $color = 'info';

    /**
     * @return string|null
     */
    public function getMaxHeight(): ?string
    {
        return WidgetSetting::MAX_HEIGHT;
    }

    protected function getData(): array
    {
        $countItems = Tag::select('tags.*', DB::raw('COUNT(taggables.tag_id) as models_count'))
            ->leftJoin('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->get()
            ->sortByDesc('models_count')
            ->take(30)
            ->pluck('models_count', 'name')
            ->toArray();

        $counts = [];
        foreach ($countItems as $key => $value) {
            $counts[ucwords($key)] = $value;
        }

        ksort($counts, SORT_FLAG_CASE);

        $label = [];
        $data = [];

        foreach ($counts as $key => $value) {
            $label[] = $key;
            $data[] = $value;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tags',
                    'data' => $data,
                    'backgroundColor' => (new WidgetSetting())->colors(false, 0.6),
                    'borderColor' => (new WidgetSetting())->colors(false, 0.8),
                ],
            ],
            'labels' => $label,
        ];
    }

    public function getDescription(): ?string
    {
        return 'Show count for each tags';
    }

    public function getColumnSpan(): int | string | array
    {
        return 'full';
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
