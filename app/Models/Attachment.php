<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'file_name',
        'file_path',
        'file_size',
        'mime_type',
        'description',
    ];
    use HasFactory;
}
