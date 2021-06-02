<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory, FilterTrait;

    protected $table = 'posts';

    /**
     * set fillable fields for filtering
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'user_id', 'id'];

    /**
     * set string fields for filtering
     * @var array
     */
    protected $likeFilterFields = ['title', 'description'];


    /**
     * set boolean fields for filtering
     * @var array
     */
    protected $boolFilterFields = [];

    /**
     * set boolean integer for filtering
     * @var array
     */
    protected $integerFilterFields = ['user_id'];




    //*******RELATIONS***************************** */
    /**
     *
     * Get Owner
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
