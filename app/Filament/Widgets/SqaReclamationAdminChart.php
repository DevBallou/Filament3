<?php

namespace App\Filament\Widgets;

use App\Models\SqaReclamation;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SqaReclamationAdminChart extends ChartWidget
{
    protected static ?string $heading = 'S.Q.A Graphique';

    protected static ?int $sort = 2;

    protected static string $color = 'warning';

    protected function getData(): array
    {
        $data = Trend::model(SqaReclamation::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'réclamation S.Q.A',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
