<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class MakeUserAnAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = User::count();
        if($count <= 0) {
            $this->error('There are no users registered! Please register a user.');

            return parent::FAILURE;
        }

        $email_address_string = $this->ask('Enter the email address of the user you want to make an admin:');

        if(Validator::make(['email' => $email_address_string], [
            'email' => 'exists:App\Models\User,email',
        ])->fails()) {
            $this->error($email_address_string . ' is not a user.');

            return parent::FAILURE;
        }

        $user = User::firstWhere('email', '=', $email_address_string);

        $role_name = 'Administrator';

        $roles = $user->roles();

        // If user is already Admin, we can return true.
        if (!$roles->withRole($role_name)->get()->isEmpty()) {
            $this->error($email_address_string . ' is already an admin.');

            return parent::FAILURE;
        }
        $role = Role::firstWhere(['name' => $role_name]);
        if(is_null($role)) {
            $role = new Role(['name' => $role_name]);
            $role->created_by = $user->id;
            $role->save();
        }

        $user->roles()->attach($role->id, ['created_by' => $user->id]);
        $new_role = $user->roles()->firstWhere('name', '=', $role_name);
        if(is_null($new_role)) {
            $this->error('There was an error making ' . $email_address_string . ' an admin.');

            return parent::FAILURE;
        }
        $this->info($email_address_string . ' is now an admin!');

        return parent::SUCCESS;
    }
}
