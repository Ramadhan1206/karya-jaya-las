<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'proyek',
        'pekerjaan',
        'catatan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor: Durasi kerja
     */
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

    /**
     * Accessor: Status badge class
     */
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

    /**
     * Accessor: Status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'hadir' => 'Hadir',
            'izin' => 'Izin',
            'sakit' => 'Sakit',
            'alpha' => 'Alpha',
        ];
        return $labels[$this->status] ?? $this->status;
    }
}