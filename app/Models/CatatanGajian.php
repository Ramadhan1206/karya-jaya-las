<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CatatanGajian extends Model
{
    use HasFactory;

    protected $table = 'catatan_gajian';

    protected $fillable = [
        'user_id',
        'catatan_harian_id',
        'tanggal_gaji',
        'periode',
        'jenis_gaji',
        'gaji_pokok',
        'tunjangan',
        'bonus',
        'potongan',
        'total_gaji',
        'total_hadir',
        'total_izin',
        'total_sakit',
        'total_alpha',
        'total_lembur',
        'keterangan',
        'rincian_pekerjaan',
        'status'
    ];

    protected $casts = [
        'tanggal_gaji' => 'date',
        'gaji_pokok' => 'decimal:2',
        'tunjangan' => 'decimal:2',
        'bonus' => 'decimal:2',
        'potongan' => 'decimal:2',
        'total_gaji' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catatanHarian()
    {
        return $this->belongsTo(CatatanHarian::class);
    }

    public function getTanggalFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_gaji)->format('d/m/Y');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'draft' => 'badge-secondary',
            'proses' => 'badge-warning',
            'dibayar' => 'badge-success',
            'batal' => 'badge-danger',
        ];
        return $badges[$this->status] ?? 'badge-secondary';
    }
}