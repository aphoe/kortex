<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\CertificationLevel;
use App\Enums\NavigationGroup;
use App\Filament\Resources\CertificationResource\Pages;
use App\Models\Certification;
use Filament\Forms\Components\Checkbox;
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
use Illuminate\Support\Str;
use Parallax\FilamentComments\Tables\Actions\CommentsAction;
use Spatie\Tags\Tag;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;

    protected static ?string $slug = 'certifications';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::CERTIFICATIONS->label();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->columnSpan('full')
                    ->required(),

                TextInput::make('url')
                    ->label('URL')
                    ->columnSpan('full')
                    ->url(),

                Select::make('certification_provider_id')
                    ->relationship('provider', 'name')
                    //->searchable()
                    ->required(),

                Select::make('certification_type_id')
                    ->relationship('type', 'name')
                    //->searchable()
                    ->required(),

                Select::make('currency_id')
                    ->relationship('currency', 'name')
                    //->searchable()
                    ->required(),

                TextInput::make('fee')
                    ->minValue(0)
                    ->numeric(),

                MarkdownEditor::make('description')
                    ->columnSpan('full'),

                Select::make('level')
                    ->options(
                        CertificationLevel::labelArray()
                    )
                    ->required(),

                TextInput::make('validity')
                    ->label('Validity (in years)')
                    ->integer(),

                TextInput::make('accreditation_body'),

                TextInput::make('expiry_years')
                    ->integer(),

                SpatieTagsInput::make('tags')
                    ->columnSpan('full')
                    ->suggestions(Tag::pluck('name')->toArray()),

                MarkdownEditor::make('prerequisite')
                    ->columnSpan('full'),

                Checkbox::make('requires_recertification_exam'),

                TextInput::make('renewal_fee')
                    ->minValue(0)
                    ->numeric(),

                MarkdownEditor::make('renewal_rules')
                    ->columnSpan('full'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Certification $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Certification $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
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

                /*TextColumn::make('provider.name')
                    ->label('Provider')
                    ->searchable()
                    ->sortable(),*/

                TextColumn::make('type.name')
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

                /*TextColumn::make('validity')
                    ->suffix(fn(Certification $record): string => ' ' . Str::plural('year', $record->validity)),*/

                TextColumn::make('fee')
                    ->money(fn(Certification $record): string => $record->currency->code)
                    ->label('Fee')
                    ->sortable(),

                TextColumn::make('level')
                    ->formatStateUsing(fn (Certification $record): string => $record->level_string)
                    ->label('Level')
                    ->sortable(),

                //TextColumn::make('renewal_rules'),

                //TextColumn::make('accreditation_body'),

                TextColumn::make('requires_recertification_exam')
                    ->label('Recert.')
                    ->formatStateUsing(fn (Certification $record): string => $record->requires_recertification),

                TextColumn::make('filament_comments_count')
                    ->label('Comments')
                    ->counts('filamentComments'),

                //TextColumn::make('renewal_fee'),

                //TextColumn::make('prerequisite'),

                //TextColumn::make('expiry_years'),
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
            ->defaultSort('name')
            ->paginated(FilamentManager::PAGINATION_OPTIONS);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCertifications::route('/'),
            'create' => Pages\CreateCertification::route('/create'),
            'view' => Pages\ViewCertification::route('/{record}'),
            'edit' => Pages\EditCertification::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['provider', 'type']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'provider.name', 'type.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->provider) {
            $details['provider'] = $record->provider->name;
        }

        if ($record->type) {
            $details['type'] = $record->type->name;
        }

        return $details;
    }
}
