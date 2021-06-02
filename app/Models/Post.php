<?php

namespace App\Models;

use App\Jobs\StorePostJob;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use function Illuminate\Events\queueable;

class Post extends Model
{
    use HasFactory, FilterTrait, SoftDeletes;


    /**
     * The table associated with the model.
     *
     * @var string
     */
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


    /******************LOG**************************************** */
    /**
     *
     * Call when some action happen.
     */
    public static function booted()
    {

        static::created(queueable(function ($post) {
            StorePostJob::dispatchAfterResponse(
                $post->user_id,
                $post->id,
                PostLog::ACTION_CREATE
            );
        }));

        static::updated(queueable(function ($post) {
            StorePostJob::dispatchAfterResponse(
                $post->user_id,
                $post->id,
                PostLog::ACTION_UPDATE
            );
        }));

        static::deleted(queueable(function ($post) {
            StorePostJob::dispatchAfterResponse(
                $post->user_id,
                $post->id,
                PostLog::ACTION_DESTROY
            );
        }));
    }



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
