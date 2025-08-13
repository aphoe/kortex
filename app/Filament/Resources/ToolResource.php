<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroup;
use App\Filament\Resources\ToolResource\Pages;
use App\Models\Tool;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ToolResource extends Resource
{
    protected static ?string $model = Tool::class;

    protected static ?string $slug = 'tools';

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::TOOLS->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->columnSpan('full')
                    ->required(),

                Select::make('tool_type_id')
                    ->relationship('type', 'name')
                    ->columnSpan('full')
                    ->required(),

                TextInput::make('url')
                    ->url(),

                TextInput::make('git_repo_url')
                    ->url(),

                Grid::make()
                    ->columns([
                        'sm' => 1,
                        'md' => 4,
                        'lg' => 6,
                    ])
                    ->schema([
                        Checkbox::make('is_saas')
                            ->label('SaaS'),

                        Checkbox::make('is_self_hosted')
                            ->label('Self-Hosted'),

                        Checkbox::make('is_open_source')
                            ->label('Open Source'),

                        Checkbox::make('has_api')
                            ->label('API'),

                        Checkbox::make('has_free_tier')
                            ->label('Free Tier'),

                        Checkbox::make('has_affiliate')
                            ->label('Affiliate'),
                    ]),


                MarkdownEditor::make('description')
                    ->columnSpan('full'),

                MarkdownEditor::make('features'),

                MarkdownEditor::make('pricing'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Tool $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Tool $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('url')
                    ->label('URL')
                    ->limit(30)
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('has_api')
                    ->label('API')
                    ->formatStateUsing(fn (string $state, ?Tool $record): string => $record->api),

                TextColumn::make('has_free_tier')
                    ->label('Free Tier')
                    ->formatStateUsing(fn (string $state, ?Tool $record): string => $record->free_tier),

                TextColumn::make('has_affiliate')
                    ->label('Affiliate')
                    ->formatStateUsing(fn (string $state, ?Tool $record): string => $record->affiliate),
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
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTools::route('/'),
            'create' => Pages\CreateTool::route('/create'),
            'view' => Pages\ViewTool::route('/{record}'),
            'edit' => Pages\EditTool::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['type']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'type.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->type) {
            $details['type'] = $record->type->name;
        }

        return $details;
    }
}
