<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
