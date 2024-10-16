<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model Category menggunakan HasFactory trait untuk mendukung pembuatan data menggunakan factory.
// Model ini merepresentasikan tabel 'shop_categories' di dalam database.
class Category extends Model
{
    // Trait HasFactory memungkinkan model ini untuk bekerja dengan Eloquent factories
    use HasFactory;

    // Mendefinisikan tabel yang digunakan oleh model ini
    protected $table = 'shop_categories';

    /**
     * The attributes that are mass assignable.
     * Artinya, atribut-atribut ini bisa diisi secara massal melalui array (misalnya pada proses input data).
     */
    protected $fillable = [
        'parent_id', // ID kategori induk, digunakan untuk membuat struktur kategori yang bersarang.
        'slug',      // URL-friendly identifier untuk kategori, biasanya berupa versi "slugified" dari nama.
        'name',      // Nama kategori
    ];

    /**
     * Fungsi children ini mendefinisikan relasi one-to-many untuk kategori yang memiliki kategori turunan (sub-kategori).
     * Setiap kategori bisa memiliki banyak sub-kategori yang dihubungkan melalui 'parent_id'.
     */
    public function children()
    {
        // Kategori ini bisa memiliki banyak sub-kategori, dimana sub-kategori memiliki 'parent_id' yang merujuk pada kategori ini.
        return $this->hasMany('Modules\Shop\app\Models\Category', 'parent_id');
    }

    /**
     * Fungsi parent mendefinisikan relasi inverse one-to-many, yaitu untuk mengakses kategori induk dari sub-kategori.
     * Setiap sub-kategori hanya memiliki satu kategori induk.
     */
    public function parent()
    {
        // Kategori ini memiliki satu parent (kategori induk) yang dihubungkan melalui 'parent_id'.
        return $this->belongsTo('Modules\Shop\app\Models\Category', 'parent_id');
    }

    /**
     * Fungsi products mendefinisikan relasi many-to-many antara kategori dan produk.
     * Artinya, satu kategori bisa berisi banyak produk, dan satu produk bisa termasuk dalam banyak kategori.
     * Relasi ini dihubungkan melalui tabel pivot 'shop_cathegories_products'.
     */
    public function products()
    {
        // Kategori ini memiliki banyak produk yang dihubungkan melalui tabel pivot 'shop_cathegories_products'.
        // 'product_id' adalah foreign key di tabel pivot untuk produk, dan 'category_id' adalah foreign key untuk kategori.
        return $this->belongsToMany('Modules\Shop\app\Models\Product', 'shop_cathegories_products', 'product_id', 'category_id');
    }

    /*
     * Factory function untuk membuat instance Category menggunakan factory.
     * Fungsi ini biasanya digunakan untuk membuat data dummy dalam pengujian atau seeding database.
     * Saat ini, fungsi ini dikomentari karena mungkin belum digunakan.
     */
    // protected static function newFactory(): CategoryFactory
    // {
    //     // Mengembalikan instance factory untuk model Category.
    //     // return CategoryFactory::new();
    // }
}
