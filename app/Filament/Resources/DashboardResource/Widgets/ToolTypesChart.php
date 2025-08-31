<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\ToolType;
use Filament\Widgets\ChartWidget;

class ToolTypesChart extends ChartWidget
{
    protected static ?string $heading = 'Tool types';

    protected static ?string $pollingInterval = null;

    protected static string $color = 'info';

    protected function getData(): array
    {
        $countsArray = ToolType::withCount('tools')
            ->get()
            ->pluck('tools_count', 'name')
            ->toArray();

        $label = [];
        $data = [];

        foreach ($countsArray as $key => $value) {
            $label[] = $key;
            $data[] = $value;
        }

        //dd($label, $data);

        return [
            'datasets' => [
                [
                    'label' => 'Tool types',
                    'data' => $data,
                ],
            ],
            'labels' => $label,
        ];
    }

    public function getDescription(): ?string
    {
        return 'Show the count of tools for each tool type';
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
