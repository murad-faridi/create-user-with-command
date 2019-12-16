<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->askValid(
            'User Name?', 
            'Full_Name', 
            ['required','min:3']
        );
        $email = $this->askValid(
            'User Email?', 
            'Email', 
            ['required','email']
        );
        $type = $this->choice('User Type?', ['Admin', 'Customer'], 'Customer');
        $password = $this->secret('User Password?');
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($password),
        ]);
        $role = DB::table('roles')->where('name', $type)->first();
        $roleUser = array('user_id'=> $user->id,
            'role_id' => $role->id);
        DB::table('role_user')->insert($roleUser);
    }

    protected function askValid($question, $field, $rules)
    {
        $value = $this->ask($question);

        if($message = $this->validateInput($rules, $field, $value)) {
            $this->error($message);

            return $this->askValid($question, $field, $rules);
        }

        return $value;
    }


    protected function validateInput($rules, $fieldName, $value)
    {
        $validator = Validator::make([
        $fieldName => $value
        ], [
        $fieldName => $rules
        ]);

        return $validator->fails()
            ? $validator->errors()->first($fieldName)
            : null;
    }
}
