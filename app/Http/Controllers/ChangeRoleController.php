<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\RoleNotification;


class ChangeRoleController extends Controller
{
    
    public function RequestChangeRole(Request $request)
    {
        $dataUser = $request->user();
        $dataAdmin = User::where('role','Admin')->first();
       
        if ($dataUser->role == 'UserJunior')
        {
            $messages["solicitud"] = "Estoy solicitando cambio de Rol";
            $messages["solicitante"] = $dataUser->name;
            $dataAdmin->notify(new RoleNotification($messages));
            return response()->json(["message" => "Notificacion enviada"]);
        }else{
            return response()->json(["message" => "El usuario logeado no tiene Rol UserJunior"]);
        }
    }

    public function ChangeRole(Request $request, User $user)
    {
      
        if ($user->role == 'UserJunior')
        {
            
            $user->role = 'UserVip';
        }
        dd($user->role);
    }

}
