<?php

use Illuminate\Support\Str;

use Illuminate\Database\Seeder;
use Flowcms\Flowcms\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereEmail(config('cms_settings.site_credential.elements.0.value'))->first();
        if ($user) {
            return;
        }
        User::create([
            'name' => 'Administrator',
            'email' => config('cms_settings.site_credential.elements.0.value'),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
