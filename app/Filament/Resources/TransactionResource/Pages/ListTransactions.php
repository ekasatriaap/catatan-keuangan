<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'pengeluaran' => Tab::make()->query(fn ($query) => $query->whereHas("category", fn ($query) => $query->where('is_expense', '1'))),
            'pemasukkan' => Tab::make()->query(fn ($query) => $query->whereHas("category", fn ($query) => $query->where('is_expense', '0'))),
        ];
    }
}
