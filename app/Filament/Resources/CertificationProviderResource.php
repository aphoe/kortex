<?php

namespace App\Filament\Resources;

use App\Classes\FilamentManager;
use App\Enums\NavigationGroup;
use App\Filament\Resources\CertificationProviderResource\Pages;
use App\Models\CertificationProvider;
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

class CertificationProviderResource extends Resource
{
    protected static ?string $model = CertificationProvider::class;

    protected static ?string $slug = 'certification-providers';

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Providers';

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
                    ->columnSpan('full')
                    ->label('URL')
                    ->url(),

                MarkdownEditor::make('description')
                    ->columnSpan('full'),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?CertificationProvider $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?CertificationProvider $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('url')
                    ->label('URL')
                    ->limit(30)
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL copied')
                    ->copyMessageDuration(1500),

                TextColumn::make('certifications_count')
                    ->label('Certifications')
                    ->counts('certifications'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListCertificationProviders::route('/'),
            'create' => Pages\CreateCertificationProvider::route('/create'),
            'view' => Pages\ViewCertificationProvider::route('/{record}'),
            'edit' => Pages\EditCertificationProvider::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
