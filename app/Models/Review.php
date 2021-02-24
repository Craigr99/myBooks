<?php
# @Date:   2021-01-23T13:11:45+00:00
# @Last modified time: 2021-01-23T13:19:24+00:00

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function book()
    {
        return $this->belongsTo('App\Models\Book', 'book_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
