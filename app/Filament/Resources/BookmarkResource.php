<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Filament\Resources\BookmarkResource\Pages;
use App\Models\Bookmark;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\Tag;

class BookmarkResource extends Resource
{
    protected static ?string $model = Bookmark::class;

    protected static ?string $slug = 'bookmarks';

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::BOOKMARKS->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->columnSpan('full')
                    ->required(),

                TextInput::make('url')
                    ->label('URL')
                    ->columnSpan('full')
                    ->required()
                    ->url(),

                Select::make('bookmark_type_id')
                    ->relationship('bookmarkType', 'name')
                    ->required(),

                SpatieTagsInput::make('tags')
                    ->suggestions(Tag::pluck('name')->toArray()),

                MarkdownEditor::make('description')
                    ->columnSpan("full"),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Bookmark $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Bookmark $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('bookmarkType.name')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('url')
                    ->label('URL')
                    ->limit(30)
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL copied')
                    ->copyMessageDuration(1500),

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
            ->defaultSort('title')
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookmarks::route('/'),
            'create' => Pages\CreateBookmark::route('/create'),
            'view' => Pages\ViewBookmark::route('/{record}'),
            'edit' => Pages\EditBookmark::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['bookmarkType']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'bookmarkType.name', 'url', 'description'];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return BookmarkResource::getUrl('view', ['record' => $record]);
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->bookmarkType) {
            $details['BookmarkType'] = $record->bookmarkType->name;
        }

        return $details;
    }
}
