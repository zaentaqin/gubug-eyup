<?php

namespace App\Filament\Clusters\Transactions\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\OutboundTransaction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use App\Filament\Clusters\Transactions;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource\Pages;


class OutboundTransactionResource extends Resource
{
    protected static ?string $model = OutboundTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $cluster = Transactions::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    DatePicker::make('date')
                        ->required(),

                    TextInput::make('title')
                        ->required(),

                    Textarea::make('description')
                        ->required()
                        ->columnSpanFull(),

                    TextInput::make('amount')
                        ->required()
                        ->numeric(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->dateTime('d-m-Y')
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListOutboundTransactions::route('/'),
            'create' => Pages\CreateOutboundTransaction::route('/create'),
            'edit' => Pages\EditOutboundTransaction::route('/{record}/edit'),
        ];
    }
}
