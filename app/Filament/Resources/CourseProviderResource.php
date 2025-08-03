<?php

namespace App\Filament\Resources;

use App\Enums\CourseProviderType;
use App\Enums\NavigationGroup;
use App\Filament\Resources\CourseProviderResource\Pages;
use App\Models\CourseProvider;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseProviderResource extends Resource
{
    protected static ?string $model = CourseProvider::class;

    protected static ?string $slug = 'course-providers';

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $label = 'Providers';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::COURSES->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->columnSpan('full')
                    ->required(),

                TextInput::make('url')
                    ->columnSpan('full')
                    ->label('URL')
                    ->url(),

                Select::make('type')
                    ->options(
                        CourseProviderType::labelArray()
                    )
                    ->required(),

                TextInput::make('email'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?CourseProvider $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?CourseProvider $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state, ?CourseProvider $record): string => $record->type_string),

                TextColumn::make('url')
                    ->label('URL')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseProviders::route('/'),
            'create' => Pages\CreateCourseProvider::route('/create'),
            'view' => Pages\ViewCourseProvider::route('/{record}'),
            'edit' => Pages\EditCourseProvider::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}
