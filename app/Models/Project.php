<?php
// app/Models/Project.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'status',
        'image',
        'client',
        'location',
        'start_date',
        'end_date',
        'budget',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
    ];

    // Scope untuk filter
    public function scopeCategory($query, $category)
    {
        if ($category && $category !== 'Semua Kategori') {
            return $query->where('category', $category);
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if ($status && $status !== 'Semua Status') {
            return $query->where('status', $status);
        }
        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%")
                         ->orWhere('client', 'like', "%{$search}%");
        }
        return $query;
    }
}