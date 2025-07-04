<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'alamat',
        'longitude',
        'latitude',
        'public_id',
        'url_file',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
