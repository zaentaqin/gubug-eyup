<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Catalog;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\CatalogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CatalogResource\RelationManagers;

class CatalogResource extends Resource
{
    protected static ?string $model = Catalog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('name')
                        ->required(),

                    Select::make('category')
                        ->options([
                            'Decoration' => 'Dekorasi',
                            'Additional Item' => 'Item Tambahan',
                        ])
                        ->required(),

                    MarkdownEditor::make('description')
                        ->required(),

                    TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('Rp'),

                    FileUpload::make('image')
                        ->image()
                        ->directory('catalogs')
                        ->multiple()
                        ->maxSize(1024)
                        ->maxFiles(5)
                        ->required(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('category')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'Decoration' => 'primary',
                        'Additional Item' => 'success',
                        default => 'default',
                    }),

                ImageColumn::make('image')
                    ->square()
                    ->limit(2)
                    ->limitedRemainingText(),

                TextColumn::make('description')
                    ->limit(50),

                TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'Decoration' => 'Dekorasi',
                        'Additional Item' => 'Item Tambahan',
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
            'index' => Pages\ListCatalogs::route('/'),
            'create' => Pages\CreateCatalog::route('/create'),
            'edit' => Pages\EditCatalog::route('/{record}/edit'),
        ];
    }
}
