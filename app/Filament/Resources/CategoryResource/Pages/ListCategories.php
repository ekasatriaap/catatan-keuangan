<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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
            'pengeluaran' => Tab::make()->query(fn ($query) => $query->where('is_expense', '1')),
            'pemasukkan' => Tab::make()->query(fn ($query) => $query->where('is_expense', '0')),
        ];
    }
}
