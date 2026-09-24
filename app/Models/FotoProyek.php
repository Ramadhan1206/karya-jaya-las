<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProyek extends Model
{
    use HasFactory;

    protected $table = 'foto_proyek';

    protected $fillable = [
        'proyek_id',
        'foto_url',
        'judul',
        'keterangan',
        'is_cover',
        'urutan'
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    public function proyek()
    {
        return $this->belongsTo(Proyek::class);
    }
}