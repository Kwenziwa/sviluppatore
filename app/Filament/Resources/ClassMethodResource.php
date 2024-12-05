<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ClassMethod;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClassMethodResource\Pages;
use App\Filament\Resources\ClassMethodResource\RelationManagers;

class ClassMethodResource extends Resource
{
    protected static ?string $model = ClassMethod::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Class Methods Data';

    // Disable Create button
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('class_name')->sortable(),
                TextColumn::make('method_name')->sortable(),
                TextColumn::make('status')
                    ->sortable()
                    ->label('Status')
                    ->formatStateUsing(fn(string $state) => ucfirst($state)) // Capitalizes the status
                    ->color(function (ClassMethod $record) {
                        return match ($record->status) {
                            'started' => 'warning',
                            'completed' => 'success',
                            'failed' => 'danger',
                            default => 'gray',
                        };
                    })
                    ->icon(function (ClassMethod $record) {
                        return match ($record->status) {
                            'started' => 'heroicon-o-play',
                            'completed' => 'heroicon-o-check',
                            'failed' => 'heroicon-s-exclamation-circle',
                            default => 'heroicon-o-minus',
                        };
                    }),
                TextColumn::make('priority')->sortable(),
                TextColumn::make('created_at')->sortable(),
                TextColumn::make('updated_at')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->poll('10s');
        ;
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
            'index' => Pages\ListClassMethods::route('/'),
            'create' => Pages\CreateClassMethod::route('/create'),
            'edit' => Pages\EditClassMethod::route('/{record}/edit'),
        ];
    }
}
