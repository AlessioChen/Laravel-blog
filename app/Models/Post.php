<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];




    //*******RELATIONS***************************** */
    /**
     *
     * Get Owner
     */
    //TODO add relation with user
    public function owner()
    {
    }
}
