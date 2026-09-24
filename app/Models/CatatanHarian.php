<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CatatanHarian extends Model
{
    use HasFactory;

    protected $table = 'catatan_harian';

    protected $fillable = [
        'user_id',
        'nama_lengkap',  // ← TAMBAHKAN INI
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'proyek',
        'pekerjaan',
        'catatan',
        'status',
        'durasi_kerja'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDurasiAttribute()
    {
        if ($this->jam_masuk && $this->jam_pulang) {
            $masuk = Carbon::parse($this->jam_masuk);
            $pulang = Carbon::parse($this->jam_pulang);
            $diff = $pulang->diff($masuk);
            return $diff->format('%h jam %i menit');
        }
        return '-';
    }

    public function getTanggalFormattedAttribute()
    {
        return Carbon::parse($this->tanggal)->format('d/m/Y');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'hadir' => 'status-hadir',
            'izin' => 'status-izin',
            'sakit' => 'status-sakit',
            'alpha' => 'status-alpha',
        ];
        return $badges[$this->status] ?? 'status-alpha';
    }
} 