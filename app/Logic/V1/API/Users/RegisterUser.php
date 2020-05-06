<?php
namespace App\Logic\V1\API\Users;

use App\Models\User;
use Str;
use App\Structs\UsersStruct;
use Hash;
use App\Enums\UserSourceType;

class RegisterUser {

    private $userModel;

    public function __construct() {
        $this->userModel = new User;
    }

    public function registerUser(UsersStruct $userStruct) {
        if (Str::of($userStruct->email)->trim()->isEmpty()) {
            return "Email should not be empty";
        }

        if (Str::of($userStruct->password)->trim()->isEmpty()) {
            return "Password should not be empty";
        }
        $userStruct->password = Hash::make($userStruct->password);
        
        // optional values
        if (Str::of($userStruct->username)->trim()->isEmpty()) {
            $userStruct->username = $userStruct->email;
        }

        if (Str::of($userStruct->name)->trim()->isEmpty()) {
            $userStruct->name = $userStruct->email;
        }

        if (!isset($userStruct->source) || Str::of($userStruct->source)->trim()->isEmpty()) {
            $userStruct->source = UserSourceType::OTHERS();
        }
        
        // save values
        return $this->userModel::create((array)$userStruct);
    }

}