<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
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
}
