<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroup;
use App\Enums\ResourceType;
use App\Filament\Resources\ResourceResource\Pages;
use App\Models\Resource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource as ResourcesResource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Tables\Actions\CommentsAction;
use Spatie\Tags\Tag;

class ResourceResource extends ResourcesResource
{
    protected static ?string $model = Resource::class;

    protected static ?string $slug = 'resources';

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::RESOURCES->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('company_id')
                    ->relationship('company', 'name'),

                Select::make('resource_category_id')
                    ->relationship('resourceCategory', 'name'),

                TextInput::make('name')
                    ->columnSpan('full')
                    ->required(),

                TextInput::make('url')
                    ->label('URL')
                    ->url(),

                Select::make('type')
                    ->options(
                        ResourceType::labelArray()
                    )
                    ->required(),

                Checkbox::make('is_open_source'),

                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                        '1:1',
                    ])
                    ->required(),

                SpatieTagsInput::make('tags')
                    ->suggestions(Tag::pluck('name')->toArray()),

                MarkdownEditor::make('description')
                    ->columnSpan('full'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Resource $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Resource $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                fn (Model $record): string => route('filament.user.resources.resources.view', ['record' => $record]),
            )
            ->columns([
                ImageColumn::make('image')
                    ->height(60)
                    ->default(asset('images/models/defaults/resource.png'))
                    ->extraImgAttributes(fn (Resource $record): array => [
                        'alt' => "{$record->name} logo",
                        'loading' => 'lazy',
                    ]),

                TextColumn::make('company.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('resourceCategory.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                //TextColumn::make('description'),

                TextColumn::make('url')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state, ?Resource $record): string => $record->type_string),

                TextColumn::make('is_open_source')
                    ->formatStateUsing(fn (string $state, ?Resource $record): string => $record->open_source),
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
            'index' => Pages\ListResources::route('/'),
            'create' => Pages\CreateResource::route('/create'),
            'view' => Pages\ViewResource::route('/{record}'),
            'edit' => Pages\EditResource::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['company', 'resourceCategory']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'company.name', 'resourceCategory.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->company) {
            $details['Company'] = $record->company->name;
        }

        if ($record->resourceCategory) {
            $details['ResourceCategory'] = $record->resourceCategory->name;
        }

        return $details;
    }
}
