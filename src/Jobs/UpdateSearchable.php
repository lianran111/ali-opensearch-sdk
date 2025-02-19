<?php

namespace Lingxi\AliOpenSearch\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateSearchable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The models to be update searchable.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $models;

    /**
     * Create a new job instance.
     *
     * @param \Illuminate\Database\Eloquent\Collection $models
     * @return void
     */
    public function __construct($models)
    {
        $this->models = $models;
    }

    /**
     * Handle the job.
     *
     * @return void
     */
    public function handle()
    {
        if (count($this->models) === 0) {
            return;
        }

        $this->models->first()->searchableUsing()->update($this->models);
    }
}
