<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'user_book')->withPivot('user_id', 'book_id', 'shelf');
    }

    //return all books from the reading shelf for this user
    public function reading()
    {
        return $this->belongsToMany('App\Models\Book', 'user_book')->wherePivot('shelf', 'Reading');
    }

    //return all books from the read later shelf for this user
    public function readLater()
    {
        return $this->belongsToMany('App\Models\Book', 'user_book')->wherePivot('shelf', 'Read Later');
    }

    //return all books from the finished reading shelf for this user
    public function finishedReading()
    {
        return $this->belongsToMany('App\Models\Book', 'user_book')->wherePivot('shelf', 'Finished Reading');
    }

    public function usersBooks()
    {
        return $this->belongsToMany(
            Book::class,
            'user_book',
            'user_id',
            'book_id'
        );
    }

    public function hasBook(Book $book)
    {
        return $this->usersBooks()->where('book_id', $book->id)->exists();
    }

    public function removeBook(Book $book)
    {
        return $this->usersBooks()->detach($book);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }
        return $this->hasRole($roles);
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
