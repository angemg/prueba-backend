<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\RoleChangeRequests as ModelsRoleChangeRequests;
use LaravelJsonApi\Laravel\Http\Controllers\Actions;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\RoleNotification;

class RoleChangeRequests extends Controller
{

    use Actions\FetchMany;
    use Actions\FetchOne;
    use Actions\Store;
    use Actions\Update;
    use Actions\Destroy;
    use Actions\FetchRelated;
    use Actions\FetchRelationship;
    use Actions\UpdateRelationship;
    use Actions\AttachRelationship;
    use Actions\DetachRelationship;


    public function requestChangeRole(Request $request)
    {
        $dataUser = $request->user();
        $dataAdmin = User::where('role','Admin')->first();

        ModelsRoleChangeRequests::create([
            'user_id'    => $dataUser->id,
            'status'     => 'pending'
        ]);

        $messages["solicitud"] = "Se ha creado una solicitud";
        $messages["solicitante"] = $dataUser->name;
        $dataAdmin->notify(new RoleNotification($messages));
        return response()->json([
            'message' => 'Role Change Created Successfully',
        ]);
    }

    public function answerRequest(Request $request, ModelsRoleChangeRequests $modelsRoleChangeRequests)
    {
        $status = $request->status;
        $user = $modelsRoleChangeRequests->user;
        $modelsRoleChangeRequests->status = $status;
        $modelsRoleChangeRequests->save();    
        $dataAdmin = User::where('role','Admin')->first();

        if ($status == 'approved'){
            $user->role = 'UserVip';
            $user->save();
            $messages["solicitud"] = "Se aprobó la solicitud";
            $messages["solicitante"] = $status;
            $user->notify(new RoleNotification($messages));
            return response()->json([
                'message' => 'Se aprobó la solicitud',
            ]);
        }elseif ($status == 'rejected'){
            $messages["solicitud"] = "Se denegó la solicitud";
            $messages["solicitante"] = $status;
            $user->notify(new RoleNotification($messages));
            return response()->json([
                'message' => 'Se denegó la solicitud',
            ]);
        }
    }
}
