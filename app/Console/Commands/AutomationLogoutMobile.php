<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutomationLogoutMobile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:automation-logout-mobile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'automation logout at 12:00 every day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now(); // Mendapatkan tanggal dan waktu saat ini

        $userLogins = User::get();
        
        foreach ($userLogins as $userLogin) {
            $loginDate = Carbon::parse($userLogin->login_at)->startOfDay(); // Mengambil tanggal login pengguna dari kolom 'login_at' dan mengabaikan waktu
            // Sesuaikan dengan nama kolom yang sesuai
        
            if ($loginDate->lte($now)) {
                // Tanggal login sudah lewat atau sama dengan tanggal saat ini
                // Lakukan update kolom 'flag_login' menjadi 0
                $userLogin->update(['flag_login' => 0]);
            }
        }        

    }
}
