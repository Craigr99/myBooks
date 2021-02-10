<?php
# @Date:   2021-01-18T10:09:10+00:00
# @Last modified time: 2021-01-23T13:18:21+00:00

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

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'user_book')->withPivot('user_id', 'book_id', 'shelf');
    }

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog');
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

    public function hasGoogleBook($book)
    {
        return $this->usersBooks()->where('book_id', $book['id'])->exists();
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

    public function isFollowing(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }

    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    // Toggle follow / unfollow
    public function toggleFollow(User $user)
    {
        if ($this->isFollowing($user)) {
            return $this->unfollow($user);
        }
        return $this->follow($user);
    }

    // get number of Users that follow a user
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'following_user_id',
            'user_id')->withTimestamps()->count();
    }

    // The users that a user follows
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }
}
