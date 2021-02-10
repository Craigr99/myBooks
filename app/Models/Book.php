<?php
# @Date:   2021-01-18T10:09:10+00:00
# @Last modified time: 2021-01-23T13:18:39+00:00

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $incrementing = false;
    public $keyType = 'string';

    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_book')->withPivot('user_id', 'book_id', 'status');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'author_book');
    }

    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'book_category');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'book_id');
    }
}
