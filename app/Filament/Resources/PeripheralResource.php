<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeripheralResource\Pages;
use App\Filament\Resources\PeripheralResource\RelationManagers;
use App\Models\Peripheral;
use App\Models\Provider;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeripheralResource extends Resource
{
    protected static ?string $model = Peripheral::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Details')
                    ->description('All the fields that has red star is required.')
                    ->schema([
                        Forms\Components\Select::make('provider_id')
                            ->label('Provider')
                            ->options(Provider::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('make')->required(),
                        Forms\Components\TextInput::make('model')->required(),
                        Forms\Components\TextInput::make('serial_number'),
                        Forms\Components\TextInput::make('type')->required(),
                        Forms\Components\TextInput::make('status')->required(),
                        Forms\Components\Hidden::make('user_id')->default(auth()->id()),
                        Forms\Components\DateTimePicker::make('purchase_date')->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provider.name'),
                Tables\Columns\TextColumn::make('make'),
                Tables\Columns\TextColumn::make('model'),
//                Tables\Columns\TextColumn::make('serial_number'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('purchase_date')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('provider_id')
                    ->label('Provider')
                    ->multiple()
                    ->relationship('provider', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('User')
                    ->multiple()
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::Modal)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->iconButton(),
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
            'index' => Pages\ListPeripherals::route('/'),
            'create' => Pages\CreatePeripheral::route('/create'),
            'edit' => Pages\EditPeripheral::route('/{record}/edit'),
        ];
    }
}
