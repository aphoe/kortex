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
                    'backgroundColor' => [
                        'rgba(0, 150, 136, 0.6)',
                        'rgba(121, 85, 72, 0.6)',
                        'rgba(156, 39, 176, 0.6)',
                        'rgba(3, 169, 244, 0.6)',
                        'rgba(255, 193, 7, 0.6)',
                        'rgba(33, 150, 243, 0.6)',
                        'rgba(96, 125, 139, 0.6)',
                        'rgba(255, 152, 0, 0.6)',
                        'rgba(255, 235, 59, 0.6)',
                        'rgba(63, 81, 181, 0.6)',
                        'rgba(139, 195, 74, 0.6)',
                        'rgba(158, 158, 158, 0.6)',
                        'rgba(103, 58, 183, 0.6)',
                        'rgba(205, 220, 57, 0.6)',
                        'rgba(0, 188, 212, 0.6)',
                        'rgba(244, 67, 54, 0.6)',
                        'rgba(233, 30, 99, 0.6)',
                        'rgba(76, 175, 80, 0.6)',
                        'rgba(255, 87, 34, 0.6)',
                    ],
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
