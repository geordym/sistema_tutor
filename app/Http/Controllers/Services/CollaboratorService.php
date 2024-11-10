<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Collaborator;
use App\Enums\UserType;

class CollaboratorService 
{

    public function createCollaborator($name, $email)
{
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => bcrypt($email),
        'user_type' => UserType::User, 
    ]);

    $collaborator = Collaborator::create([
        'id' => $user->id,
        'name' => $name,
        'user_id' => $user->id, 
    ]);

    return $collaborator;
}


}
