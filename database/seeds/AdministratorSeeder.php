<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "daffaquraisy";
        $administrator->nama_petugas = "Daffa Quraisy";
        $administrator->level = "ADMIN";
        $administrator->password = Hash::make('12345678');

        $administrator->save();

        $this->command->info("User Admin berhasil di insert");
    }
}
