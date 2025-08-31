<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Tool;
use Filament\Widgets\ChartWidget;

class ToolsChart extends ChartWidget
{
    protected static ?string $heading = 'Tools Components';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $counts = Tool::selectRaw('
            COUNT(CASE WHEN is_saas = 1 THEN 1 END) as saas_count,
            COUNT(CASE WHEN is_self_hosted = 1 THEN 1 END) as self_hosted_count,
            COUNT(CASE WHEN is_open_source = 1 THEN 1 END) as open_source_count,
            COUNT(CASE WHEN has_api = 1 THEN 1 END) as api_count,
            COUNT(CASE WHEN has_free_tier = 1 THEN 1 END) as free_tier_count,
            COUNT(CASE WHEN has_affiliate = 1 THEN 1 END) as affiliate_count
        ')->first();

        return [
            'datasets' => [
                [
                    'label' => 'Tools features',
                    'data' => [
                        $counts->saas_count,
                        $counts->self_hosted_count,
                        $counts->open_source_count,
                        $counts->api_count,
                        $counts->free_tier_count,
                        $counts->affiliate_count,
                    ],
                ],
            ],
            'labels' => [
                'SaaS',
                'Self-hosted',
                'Open-source',
                'API',
                'Free-tier',
                'Affiliate',
            ]
        ];
    }

    public function getDescription(): ?string
    {
        return 'Show count of tools with listed features';
    }

    protected function getType(): string
    {
        return 'line';
    }
}
