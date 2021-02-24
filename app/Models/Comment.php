<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    // fields can be filled
    protected $fillable = ['body', 'user_id', 'review_id'];

    public function review()
    {
        return $this->belongsTo('App\Models\Review');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
