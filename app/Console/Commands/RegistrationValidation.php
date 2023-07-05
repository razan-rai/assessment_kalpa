<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegistrationValidation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:registration-validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
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
