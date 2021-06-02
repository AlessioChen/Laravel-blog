<?php

namespace App\Jobs;

use App\Models\PostLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StorePostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id;
    protected $post_id;
    protected $action;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $post_id, $action)
    {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // $post_log = new PostLog();

        // $post_log->post_id = $this->post_id;
        // $post_log->user_id = $this->user_id;
        // $post_log->action = $this->action;
        // $post_log->save();

        PostLog::create([
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'action' => $this->action
        ]);
    }
}
