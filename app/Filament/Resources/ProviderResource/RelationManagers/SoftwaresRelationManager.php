<?php

namespace App\Filament\Resources\ProviderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoftwaresRelationManager extends RelationManager
{
    protected static string $relationship = 'softwares';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('type')->required(),
                Forms\Components\TextInput::make('status')->required(),
                Forms\Components\TextInput::make('licenses'),
                Forms\Components\Hidden::make('user_id')->default(auth()->id()),
                Forms\Components\DateTimePicker::make('purchase_date')->required(),
                Forms\Components\DateTimePicker::make('expiry_date')->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('purchase_date')->date(),
                Tables\Columns\TextColumn::make('expiry_date')->date(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->placeholder('All Status')
                    ->trueLabel('Active')
                    ->falseLabel('Expired')
                    ->queries(
                        true: fn (Builder $query) => $query->where('status', '=', 'Active'),
                        false: fn (Builder $query) => $query->where('status', '=', 'Expired'),
                        blank: fn (Builder $query) => $query,
                    )
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
