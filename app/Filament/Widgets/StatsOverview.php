<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        // filter
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();
        // query jumlah pemasukkan
        $pemasukkan = Transaction::incomes()->whereBetween("date_transaction", [$startDate, $endDate])->sum("amount");
        $pengeluaran = Transaction::expenses()->whereBetween("date_transaction", [$startDate, $endDate])->sum("amount");
        $tabungan = Transaction::tabungan()->whereBetween("date_transaction", [$startDate, $endDate])->sum("amount");
        return [
            Stat::make('Total Pemasukkan', $pemasukkan),
            Stat::make('Total Pengeluaran', $pengeluaran),
            Stat::make("Tabungan", $tabungan),
            Stat::make('Selisih', $pemasukkan - $pengeluaran),
        ];
    }
}
