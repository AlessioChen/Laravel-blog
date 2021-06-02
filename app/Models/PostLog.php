<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostLog extends Model
{
    use HasFactory;

    const ACTION_CREATE = 'CREATE';
    const ACTION_UPDATE = 'UPDATE';
    const ACTION_DESTROY = 'DESTROY';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_logs';


    /**
     * set fillable fields
     *
     * @var array
     */
    protected $fillable = ['post_id', 'user_id', 'action'];


    /**
     * Get the user
     *
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
