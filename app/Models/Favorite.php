<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

   
    protected $fillable = [
        'user_id',
        'imdb_id',
        'title',
        'year',
        'poster',
        'type',
    ];

 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}