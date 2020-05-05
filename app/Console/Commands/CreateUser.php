<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Logic\V1\API\Users\RegisterUser;
use App\Structs\UsersStruct;
use App\Enums\UserSourceType;
use Validator;
use App\Rules\PasswordValidation;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_user {email} {password} {--username=} {--name=} {--is-active=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user for ecommerce';

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
        //
        $userStruct = new UsersStruct;
        $userStruct->email = $this->argument('email');
        $userStruct->password = $this->argument('password');
        $userStruct->username = $this->option('username');
        $userStruct->name = $this->option('name');
        $userStruct->is_active = $this->option('is-active') === "true"? true: false;
        $userStruct->source = UserSourceType::CMD();

        $input = [
            'email' => $userStruct->email,
            'password' => $userStruct->password,
            'username' => $userStruct->username
        ];

        $validation = Validator::make($input, [
            'email' => 'required|email|unique:users',
            'password' => new PasswordValidation
        ]);

        if ($validation->fails()) {
            dd($validation->errors());
        }

        $logicRegister = new RegisterUser();
        $registerCMD = $logicRegister->registerUser($userStruct);
        dd($registerCMD);
    }
}
