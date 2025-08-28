<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sentry_users')) {
            $users = DB::table('sentry_users')->get();
            foreach ($users as $user) {
                DB::table('users')->insert([
                    'id' => $user->id,
                    'email' => $user->email,
                    'first_name' => $user->first_name ?? null,
                    'last_name' => $user->last_name ?? null,
                    'name' => trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: null,
                    'password' => $user->password,
                    'is_superuser' => strpos($user->permissions ?? '', 'superuser') !== false,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]);
            }
        }

        Schema::dropIfExists('sentry_users_groups');
        Schema::dropIfExists('sentry_groups');
        Schema::dropIfExists('sentry_throttle');
        Schema::dropIfExists('sentry_users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Irreversible migration
    }
};
