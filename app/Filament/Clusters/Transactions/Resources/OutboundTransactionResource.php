<?php

namespace App\Filament\Clusters\Transactions\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Actions\ExportAction;
use App\Models\OutboundTransaction;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Section;
use App\Filament\Clusters\Transactions;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Exports\OutboundTransactionExporter;
use App\Filament\Clusters\Transactions\Resources\OutboundTransactionResource\Pages;


class OutboundTransactionResource extends Resource
{
    protected static ?string $model = OutboundTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

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
                    ->money('IDR')
                    ->sortable(),

            ])
            ->filters([
                Filter::make('date')
                    ->form([
                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn(Builder $query, $date) => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['end_date'],
                                fn(Builder $query, $date) => $query->whereDate('date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['start_date']) {
                            $indicators['start_date'] = 'Start Date: ' . Carbon::parse($data['start_date'])->toFormattedDateString();
                        }
                        if ($data['end_date']) {
                            $indicators['end_date'] = 'End Date: ' . Carbon::parse($data['end_date'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),
            ])

            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
                ExportBulkAction::make()
                    ->exporter(OutboundTransactionExporter::class),
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
