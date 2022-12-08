<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function url()
    {
        return Storage::url($this->path);
    }
}
