<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroup;
use App\Filament\Resources\NoteResource\Pages;
use App\Models\Note;
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
use Parallax\FilamentComments\Tables\Actions\CommentsAction;
use Spatie\Tags\Tag;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $slug = 'notes';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

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

                Select::make('bookmark_type_id')
                    ->relationship('bookmarkType', 'name')
                    ->required(),

                SpatieTagsInput::make('tags')
                    ->suggestions(Tag::pluck('name')->toArray()),

                MarkdownEditor::make('description')
                    ->columnSpan('full')
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Note $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Note $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('bookmarkType.name')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),

                //TextColumn::make('description'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    CommentsAction::make(),
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
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNote::route('/create'),
            'view' => Pages\ViewNote::route('/{record}'),
            'edit' => Pages\EditNote::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['bookmarkType']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'bookmarkType.name'];
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
