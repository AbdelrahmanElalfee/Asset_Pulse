<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Provider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HardwaresRelationManager extends RelationManager
{
    protected static string $relationship = 'hardwares';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('provider_id')
                    ->label('Provider')
                    ->options(Provider::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('make')->required(),
                Forms\Components\TextInput::make('model')->required(),
                Forms\Components\TextInput::make('serial_number')->required(),
                Forms\Components\TextInput::make('operating_system'),
                Forms\Components\TextInput::make('operating_system_version'),
                Forms\Components\TextInput::make('type')->required(),
                Forms\Components\TextInput::make('cpu'),
                Forms\Components\TextInput::make('ram'),
                Forms\Components\TextInput::make('status')->required(),
                Forms\Components\DateTimePicker::make('purchase_date')->required(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('model')
            ->columns([
                Tables\Columns\TextColumn::make('provider.name'),
                Tables\Columns\TextColumn::make('make'),
                Tables\Columns\TextColumn::make('model'),
                Tables\Columns\TextColumn::make('purchase_date')->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('provider_id')
                    ->label('Provider')
                    ->multiple()
                    ->relationship('provider', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
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
}
