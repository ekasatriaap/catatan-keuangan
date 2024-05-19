<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Category;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->relationship("category", "name")
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('note')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('category.image')
                    ->label("Icon")
                    ->alignCenter(true)
                    ->width("50px"),
                Tables\Columns\TextColumn::make('category.name')
                    ->label("Transaksi")
                    ->description(fn (Transaction $record): string => $record->name)
                    ->width("200px")
                    ->searchable(),
                Tables\Columns\IconColumn::make('category.is_expense')
                    ->label("Tipe")
                    ->trueIcon("heroicon-o-arrow-up-circle")
                    ->trueColor("danger")
                    ->falseIcon("heroicon-o-arrow-down-circle")
                    ->falseColor("success")
                    ->alignCenter(true)
                    ->width("50px")
                    ->boolean(),
                Tables\Columns\TextColumn::make('date')
                    ->label("Tanggal")
                    ->date()
                    ->alignCenter(true)
                    ->width("150px")
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label("Jumlah")
                    ->numeric()
                    ->money("IDR", locale: "id")
                    ->alignCenter(true)
                    ->width("150px")
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
