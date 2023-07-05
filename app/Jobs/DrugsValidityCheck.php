<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DrugsValidityCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $expired_validation = Drug::where('status', '==', 1)
        ->whereYear('verifiyed_on', now()->subYear()->year)
        ->get();
        // update database with expiration validation
        foreach ($expired_validation as $drug) {
            $drug = Drug::where('id', '=', $drug->id)->first();

            $data['unverifiyed_on'] = now()->format('Y-m-d H:i:s');
            $data['status'] = 0; //unverified after one year of varified year
            $drug->update($data);
        }
    }
}
