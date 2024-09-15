<?php

namespace App\Filament\Clusters\Transactions\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\InboundTransaction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use App\Filament\Clusters\Transactions;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Clusters\Transactions\Resources\InboundTransactionResource\Pages;

class InboundTransactionResource extends Resource
{
    protected static ?string $model = InboundTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static ?string $cluster = Transactions::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Section::make([
                            Select::make('order_id')
                                ->relationship('order', 'name')
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $order = Order::find($state);
                                    if ($order) {
                                        $set('total', $order->total);
                                        $set('telephone', $order->telephone);
                                        $set('address', $order->address);
                                        $set('marital_address', $order->marital_address);
                                    }

                                    $exitingsordersCount = InboundTransaction::where('order_id', $state)->count();

                                    if ($exitingsordersCount >= 2) {
                                        $set('order_id', null);
                                    }
                                })
                                ->required()
                                ->disabled(fn($state, $get) => InboundTransaction::where('order_id', $state)->count() >= 2),


                            TextInput::make('telephone')
                                ->disabled(),

                            TextInput::make('address')
                                ->disabled(),

                            TextInput::make('marital_address')
                                ->disabled(),

                            TextInput::make('total')
                                ->disabled(),

                        ]),

                        Section::make([
                            DatePicker::make('date')
                                ->required(),

                            TextInput::make('amount')
                                ->required()
                                ->numeric(),

                            Select::make('status')
                                ->options([
                                    'DP' => 'Dp',
                                    'Lunas' => 'Lunas',
                                ])
                                ->required(),
                        ]),
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

                TextColumn::make('order.name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Lunas' => 'success',
                        'DP' => 'warning',
                    })

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'DP' => 'DP',
                        'Lunas' => 'Lunas',
                    ]),
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
            'index' => Pages\ListInboundTransactions::route('/'),
            'create' => Pages\CreateInboundTransaction::route('/create'),
            'edit' => Pages\EditInboundTransaction::route('/{record}/edit'),
        ];
    }
}
