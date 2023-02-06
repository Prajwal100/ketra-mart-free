<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaFile extends Model
{
    use SoftDeletes;
    protected $table = 'media_files';
    use HasFactory;

    public static function findMediaByName($name)
    {
        return MediaFile::where("file_name", $name)->firstOrFail();
    }
}
