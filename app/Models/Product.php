<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'galeries' => 'json'
    ];

    public function scopeFilter(Builder $query, array $filters) {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%')
        );

    }

    protected static function booted()
    {
        static::saving(function (Product $product) {
            // Mengatur slug berdasarkan nama produk
            $product->slug = Str::slug($product->name);
        });

        static::updating(function (Product $product) {
            // handling update thumnail (image)
            // Cek apakah thumbnail berubah
            if ($product->isDirty('image') && $product->getOriginal('image') !== $product->image) {
                // Hapus gambar lama jika ada perubahan
                $oldImage = $product->getOriginal('image');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // handling update galeries
            // Pastikan kedua nilai adalah array, jika tidak, gunakan array kosong
            $originalGaleries = is_array($product->getOriginal('galeries')) ? $product->getOriginal('galeries') : [];
            $currentGaleries = is_array($product->galeries) ? $product->galeries : [];
            
            // Handling update galeries
            $originalGaleries = (array) $product->getOriginal('galeries');
            $currentGaleries = (array) $product->galeries;

            // Menghapus gambar yang tidak lagi ada di galeri
            foreach (array_diff($originalGaleries, $currentGaleries) as $image) {
                Storage::disk('public')->delete($image);
            }
        });

        static::deleted(function (Product $product) {
            // Menghapus file gambar thumbnail produk saat produk dihapus
            if (Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($$product->image);
            }

            foreach ($product->galeries as $image) {
                Storage::disk('public')->delete($image);
            }
           
        });
    }
}
