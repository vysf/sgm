<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\ProductGalery;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
// use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use Filament\Forms\Components\Textarea; // Tambahkan namespace ini
use Illuminate\Database\Eloquent\Factories\Relationship;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Nama Produk')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('keyword')
                            // ->required()
                            ->label('Kata Kunci')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('video')
                            ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Salin kode dari YouTube setelah ?v=. Contoh youtube.com/watch?v=tsHREnBojoU, cukup ambil "tsHREnBojoU" saja.')
                            ->columnSpan(2),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->autosize()
                            ->label('Deskripsi')
                            ->columnSpan([
                                'default' => 2,
                                'md' => 1,
                                'lg' => 1,
                                'xl' => 1,
                            ])
                            ->hint(fn ($state, $component) => strlen($state) . '/' . $component->getMaxLength())
                            ->maxlength(250)
                            ->reactive(),
                        Forms\Components\FileUpload::make('image') // gunakan string 'image'
                            ->required()
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->directory('products')
                            ->label('Thumbnail')
                            ->columnSpan([
                                'default' => 2,
                                'md' => 1,
                                'lg' => 1,
                                'xl' => 1,
                            ]),
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->label('Konten Produk')
                            ->columnSpan(2),   
                    ]),
                Forms\Components\Section::make('Image Galeries')
                    ->schema([
                        Forms\Components\FileUpload::make('galeries') // Ganti menjadi image_galeries
                            ->label('Galeri')
                            ->multiple() // Tambahkan multiple untuk mendukung upload banyak file
                            ->directory('product_galeries') // Tentukan direktori penyimpanan gambar
                            ->image() // Pastikan hanya gambar yang bisa di-upload
                            ->reorderable()
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->label('Tambah gambar') // Label untuk input gambar
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Thumbnail')
                    ->circular(),
                Tables\Columns\ImageColumn::make('galeries')
                    ->label('Galeri')
                    ->stacked()
                    ->circular()
                    ->limit(3)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->tooltip('Klik untuk salin')
                    ->copyable()
                    ->copyMessage('Url disalin')
                    ->copyMessageDuration(1500)
                    ->copyableState(fn (Product $record): string => url('/product/' . $record->slug)),
                Tables\Columns\TextColumn::make('content')
                    ->label('Konten Produk')
                    ->limit(20)
                    ->html()
                    ->tooltip(fn($record) => strip_tags($record->content)),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(20)
                    ->tooltip(fn($record) => $record->description),
            ])
            ->searchPlaceholder('Cari produk...')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
