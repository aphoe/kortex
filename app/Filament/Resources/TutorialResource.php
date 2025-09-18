<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Filament\Resources\TutorialResource\Pages;
use App\Models\Tutorial;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
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
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Tables\Actions\CommentsAction;
use Spatie\Tags\Tag;

class TutorialResource extends Resource
{
    protected static ?string $model = Tutorial::class;

    protected static ?string $slug = 'tutorials';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::COURSES->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('url')
                    ->label('URL')
                    ->columnSpanFull()
                    ->url(),

                SpatieTagsInput::make('tags')
                    ->columnSpanFull()
                    ->suggestions(Tag::pluck('name')->toArray()),

                MarkdownEditor::make('notes')
                    ->columnSpan('full')
                    ->required(),

                MarkdownEditor::make('actionable_steps')
                    ->columnSpan('full'),

                MarkdownEditor::make('todo')
                    ->columnSpan('full'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Tutorial $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Tutorial $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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

                TextColumn::make('url')
                    ->label('URL')
                    ->limit(30)
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('filament_comments_count')
                    ->label('Comments')
                    ->counts('filamentComments'),
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
                ]),
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
            'index' => Pages\ListTutorials::route('/'),
            'create' => Pages\CreateTutorial::route('/create'),
            'view' => Pages\ViewTutorial::route('/{record}'),
            'edit' => Pages\EditTutorial::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'url', 'notes', 'actionable_steps', 'todo'];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return BookmarkResource::getUrl('view', ['record' => $record]);
    }
}
