<?php


use App\Models\Company;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        Company::factory()
//            ->has(User::factory()->count(10))
//            ->count(10000)->create();

        $user = User::find(10000);
        $user->update([
            'first_name' => 'omar',
            'last_name' => 'esmaeel',
            'email' => 'omar.esmaeel@company.com',
        ]);
        $user->company->update([
            'name' => 'Company Inc',
        ]);

        $user = User::find(20000);
        $user->update([
            'first_name' => 'Tim',
            'last_name' => 'O\'Reilly',
            'email' => 'tim@oreilly.com',
        ]);
        $user->company->update([
            'name' => 'O\'Reilly Media Inc.',
        ]);
    }

}
