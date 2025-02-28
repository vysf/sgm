<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGalery extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'url' => 'array'
    ];

    // protected static function booted()
    // {
    //     static::saving(function ($gallery) {
    //         // Cek apakah gambar galeri berubah
    //         // dd($gallery);
    //         if ($gallery->isDirty('url')) {
    //             // Jika gambar lama ada, hapus gambar lama
    //             if ($gallery->getOriginal('url') && $gallery->getOriginal('url') !== $gallery->url) {
    //                 $oldImage = $gallery->getOriginal('url');
    //                 if (Storage::exists('public/product_galeries/' . $oldImage)) {
    //                     Storage::delete('public/product_galeries/' . $oldImage);
    //                 }
    //             }
    //         }
    //     });

    //     static::deleted(function ($gallery) {
    //         // Menghapus file gambar galeri saat galeri dihapus
    //         if (Storage::exists('public/product_galeries/' . $gallery->url)) {
    //             Storage::delete('public/product_galeries/' . $gallery->url);
    //         }
    //     });
    // }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
