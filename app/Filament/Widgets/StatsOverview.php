<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // query jumlah pemasukkan
        $pemasukkan = Transaction::incomes()->get()->sum("amount");
        $pengeluaran = Transaction::expenses()->get()->sum("amount");
        return [
            Stat::make('Total Pemasukkan', $pemasukkan),
            Stat::make('Total Pengeluaran', $pengeluaran),
            Stat::make('Selisih', $pemasukkan - $pengeluaran),
        ];
    }
}
