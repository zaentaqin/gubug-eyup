<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Catalog;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DisableDate;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\OrderResource\Pages;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Wizard::make([
                        Wizard\Step::make('Order Details')
                            ->schema([
                                TextInput::make('name')
                                    ->required(),

                                TextInput::make('telephone')
                                    ->required(),

                                TextInput::make('address')
                                    ->required(),

                                TextInput::make('marital_address')
                                    ->required(),

                                DatePicker::make('date')
                                    ->native(false)
                                    ->disabledDates(function () {
                                        $disabledDates = DisableDate::pluck('date')->toArray();
                                        return $disabledDates;
                                    })
                                    ->required(),
                            ]),

                        Wizard\Step::make('Order Items')
                            ->schema([
                                Repeater::make('items')
                                    ->label('')
                                    ->relationship()
                                    ->schema([
                                        Section::make()
                                            ->columns(4)
                                            ->icon('heroicon-m-shopping-bag')
                                            ->schema([
                                                Select::make('catalog_id')
                                                    ->relationship('catalog', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->required()
                                                    ->distinct()
                                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                                    ->afterStateUpdated(function ($state, $set, $get) {
                                                        $catalog = Catalog::find($state);
                                                        $unit_price = $catalog ? $catalog->price : 0;
                                                        $set('unit_price', $unit_price);
                                                        $quantity = $get('quantity') ?? 1;
                                                        $set('total_price', $unit_price * $quantity);
                                                    }),

                                                TextInput::make('quantity')
                                                    ->numeric()
                                                    ->required()
                                                    ->default(1)
                                                    ->reactive()
                                                    ->afterStateUpdated(function ($state, $set, $get) {
                                                        $unit_price = $get('unit_price');
                                                        $set('total_price', $unit_price * $state);
                                                    }),

                                                TextInput::make('unit_price')
                                                    ->numeric()
                                                    ->required()
                                                    ->disabled()
                                                    ->dehydrated(),

                                                TextInput::make('total_price')
                                                    ->numeric()
                                                    ->required()
                                                    ->disabled(),
                                            ]),
                                    ]),

                                Group::make()->schema([
                                    Section::make('Total Price')->schema([
                                        Placeholder::make('total')
                                            ->content(function (Get $get, Set $set) {
                                                $total = 0;
                                                $repeaters = $get('items') ?? [];

                                                foreach ($repeaters as $key => $repeater) {
                                                    $total += (int) $get("items.{$key}.total_price");
                                                }
                                                $set('total', $total);
                                                return Number::currency($total, 'IDR');
                                            }),

                                        Hidden::make('total')
                                            ->default(0),

                                        TextInput::make('discount')
                                            ->prefix('Rp')
                                            ->numeric()
                                            ->required()
                                            ->default(0)
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, $set, $get) {
                                                $total = (int) $get('total');
                                                $discount = (int) $state;
                                                $grandTotal = $total - $discount;
                                                $set('grand_total', $grandTotal);
                                            }),

                                        Placeholder::make('grand_total')
                                            ->content(function (Get $get, Set $set) {
                                                $total = (int) $get('total');
                                                $discount = (int) $get('discount');
                                                $grandTotal = $total - $discount;
                                                $set('grand_total', $grandTotal);
                                                return Number::currency($grandTotal, 'IDR');
                                            }),

                                        Hidden::make('grand_total')
                                            ->default(0),
                                    ]),
                                ]),
                            ]),
                    ]),
                ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->dateTime('d-m-Y'),

                TextColumn::make('name')
                    ->sortable(),

                TextColumn::make('address')
                    ->sortable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('marital_address')
                    ->limit(30),

                TextColumn::make('total')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('discount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('grand_total')
                    ->money('IDR')
                    ->sortable(),



                // TextColumn::make('invoice.status')
                //     ->badge()
                //     ->color(fn(string $state): string => match ($state) {
                //         'DP' => 'primary',
                //         'Lunas' => 'success',
                //         default => 'default',
                //     })
                //     ->sortable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Action::make('Invoice')
                        ->url(fn($record) => route('invoice', $record))
                        ->icon('heroicon-m-paper-clip')
                        ->openUrlInNewTab(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}