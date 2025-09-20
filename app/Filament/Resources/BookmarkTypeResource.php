<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Filament\Resources\BookmarkTypeResource\Pages;
use App\Models\BookmarkType;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
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
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class BookmarkTypeResource extends Resource
{
    protected static ?string $model = BookmarkType::class;

    protected static ?string $slug = 'bookmark-types';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel  = 'Types';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::BOOKMARKS->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->columnSpan('full')
                    ->required(),

                MarkdownEditor::make('description')
                    ->columnSpan("full"),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?BookmarkType $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?BookmarkType $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->sortable()
                    ->rowIndex(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('bookmarks_count')
                    ->label('Bookmarks')
                    ->counts('bookmarks'),

                TextColumn::make('notes_count')
                    ->label('Notes')
                    ->counts('notes'),

                //TextColumn::make('description'),
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
                    //DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name')
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookmarkTypes::route('/'),
            'create' => Pages\CreateBookmarkType::route('/create'),
            'view' => Pages\ViewBookmarkType::route('/{record}'),
            'edit' => Pages\EditBookmarkType::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return BookmarkTypeResource::getUrl('view', ['record' => $record]);
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->name;
    }
}
