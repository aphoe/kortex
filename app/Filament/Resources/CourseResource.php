<?php

namespace App\Filament\Resources;

use App\Enums\Level;
use App\Enums\NavigationGroup;
use App\Enums\PricingTierType;
use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use App\Models\CourseProvider;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
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

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $slug = 'courses';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getNavigationGroup(): ?string
    {
        return NavigationGroup::COURSES->label();
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
                    ->url(),

                Select::make('course_provider_id')
                    ->relationship('courseProvider', 'name'),

                MarkdownEditor::make('description')
                    ->columnSpan('full'),

                Select::make('level')
                    ->options(
                        Level::labelArray()
                    )
                    ->required(),

                Select::make('pricing_tier_type')
                    ->options(
                        PricingTierType::labelArray()
                    )
                    ->required(),

                TextInput::make('duration')
                    ->label('Duration (in days)')
                    ->rule(['numeric', 'min:1']),

                DatePicker::make('launch_date'),

                Checkbox::make('has_certificate'),

                SpatieTagsInput::make('tags')
                    ->suggestions(Tag::pluck('name')->toArray()),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Course $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Course $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                fn (Model $record): string => route('filament.user.resources.courses.view', ['record' => $record]),
            )
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('courseProvider.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('level')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state, ?Course $record): string => $record->level_string),

                TextColumn::make('has_certificate')
                    ->label('Cert.')
                    ->formatStateUsing(fn (string $state, ?Course $record): string => $record->has_certificate ? 'Yes' : 'No'),

                TextColumn::make('pricing_tier_type')
                    ->label('Pricing Tier')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state, ?Course $record): string => $record->pricing_tier_type_string),

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
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('title');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['courseProvider']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'courseProvider.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->courseProvider) {
            $details['CourseProvider'] = $record->courseProvider->name;
        }

        return $details;
    }
}
