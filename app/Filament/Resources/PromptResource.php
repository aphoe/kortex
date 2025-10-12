<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Filament\Resources\PromptResource\Pages;
use App\Models\Prompt;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Tables\Actions\CommentsAction;
use Spatie\Tags\Tag;

class PromptResource extends Resource
{
    protected static ?string $model = Prompt::class;

    protected static ?string $slug = 'prompts';

    protected static ?string $navigationIcon = 'heroicon-o-command-line';

    protected static ?string $navigationLabel  = 'Prompts';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::PROMPTS->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),

                Select::make('prompt_service_id')
                    ->relationship('promptService', 'name')
                    ->required(),

                Textarea::make('prompt')
                    ->autosize()
                    ->columnSpanFull()
                    ->required(),

                FileUpload::make('before')
                    ->image()
                    ->imageEditor(),

                FileUpload::make('after')
                    ->image()
                    ->imageEditor(),

                MarkdownEditor::make('description')
                    ->columnSpanFull(),

                SpatieTagsInput::make('tags')
                    ->columnSpanFull()
                    ->suggestions(Tag::pluck('name')->toArray()),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Prompt $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Prompt $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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

                ImageColumn::make('before')
                    ->height(60)
                    ->simpleLightbox()
                    ->default(asset('images/models/defaults/prompt.png'))
                    ->extraImgAttributes(fn (\App\Models\Prompt $record): array => [
                        'alt' => "{$record->title}: before",
                        'loading' => 'lazy',
                    ]),

                ImageColumn::make('after')
                    ->height(60)
                    ->simpleLightbox()
                    ->default(asset('images/models/defaults/prompt.png'))
                    ->extraImgAttributes(fn (\App\Models\Prompt $record): array => [
                        'alt' => "{$record->title}: after",
                        'loading' => 'lazy',
                    ]),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('promptService.name')
                    ->label('Service')
                    ->searchable()
                    ->sortable(),

                //TextColumn::make('prompt'),

                //TextColumn::make('description'),

                //TextColumn::make('before'),
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
                    //DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('title')
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrompts::route('/'),
            'create' => Pages\CreatePrompt::route('/create'),
            'view' => Pages\ViewPrompt::route('/{record}'),
            'edit' => Pages\EditPrompt::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['promptService']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'promptService.name', 'prompt'];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return CourseResource::getUrl('view', ['record' => $record]);
    }

    public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    {
        return $record->title;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->promptService) {
            $details['PromptService'] = $record->promptService->name;
        }

        return $details;
    }
}
