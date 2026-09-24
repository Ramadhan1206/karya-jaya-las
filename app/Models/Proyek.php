<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';

    protected $fillable = [
        'nama_proyek', 'slug', 'klien', 'deskripsi', 'lokasi',
        'tanggal_mulai', 'tanggal_selesai', 'kategori',
        'status', 'is_featured', 'views'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_featured' => 'boolean',
    ];

    public function foto()
    {
        return $this->hasMany(FotoProyek::class);
    }

    public function cover()
    {
        return $this->hasOne(FotoProyek::class)->where('is_cover', true);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'selesai' => 'badge-success',
            'berjalan' => 'badge-warning',
            'direncanakan' => 'badge-info',
        ];
        return $badges[$this->status] ?? 'badge-secondary';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'selesai' => 'Selesai',
            'berjalan' => 'Sedang Berjalan',
            'direncanakan' => 'Direncanakan',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($proyek) {
            $proyek->slug = Str::slug($proyek->nama_proyek);
        });
    }
}