<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class WidgetIncomeChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Pemasukkan';
    protected static string $color = "success";

    protected function getData(): array
    {
        // filter
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();
        $data = Trend::query(Transaction::incomes())
            ->between(
                start: $startDate ?? Carbon::now()->subDays(30),
                end: $endDate ?? Carbon::now()
            )
            ->dateColumn('date_transaction')
            ->perDay()
            ->sum("amount");
        return [
            'datasets' => [
                [
                    'label' => 'Pemasukkan',
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
