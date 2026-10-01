<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Creates the single admin account. Every user in the users table can log in
 * to /admin, so never register other users.
 *
 * Set ADMIN_EMAIL / ADMIN_PASSWORD in .env before seeding. When ADMIN_PASSWORD
 * is empty a random one is generated and printed once.
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@michportfolio.test');

        if (User::where('email', $email)->exists()) {
            $this->command?->info("Admin {$email} already exists — skipped.");

            return;
        }

        $password = env('ADMIN_PASSWORD') ?: Str::password(16, symbols: false);

        User::create([
            'name' => env('ADMIN_NAME', 'Michael D E'),
            'email' => $email,
            'password' => $password,
        ]);

        $this->command?->warn("Admin created: {$email}");
        if (! env('ADMIN_PASSWORD')) {
            $this->command?->warn("Generated password: {$password}  (change it at /admin/account)");
        }
    }
}
