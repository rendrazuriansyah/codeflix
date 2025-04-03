<?php

namespace App\Jobs;

use App\Events\MembershipHasExpired;
use App\Models\Membership;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckMembershipStatus implements ShouldQueue
{
    // Menggunakan trait Batchable untuk membantu dalam pemrosesan batch job
    // Dispatchable digunakan agar job ini dapat di-dispatch ke queue
    // InteractsWithQueue memungkinkan job ini untuk berinteraksi dengan queue
    // Queueable memberikan kemampuan job ini untuk antri dalam queue
    // SerializesModels memungkinkan model untuk di-serialize dalam job
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // timeout and tries digunakan jika job gagal dijalankan
    // seperti misalnya ada error di database atau jaringan
    // maka job akan di retry beberapa kali sebelum dianggap gagal
    public $timeout = 120; // dalam detik
    public $tries = 3; // jumlah retry yang diijinkan

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * This job will check all active memberships and set them to inactive if
     * the end date is less than or equal to today's date. It will also fire
     * the MembershipHasExpired event which can be used to send notifications
     * to the user.
     */
    public function handle(): void
    {
        // Get all active memberships where the end date is less than or equal
        // to today's date
        Membership::where('active', true)
            ->where('end_date', '<=', now()->toDateString())
            ->chunk(100, function ($memberships) {
                // Loop through each membership and set it to inactive
                foreach ($memberships as $membership) {
                    $membership->update(['active' => false]);

                    // Fire the MembershipHasExpired event
                    event(new MembershipHasExpired($membership));
                }
            });
    }
}
