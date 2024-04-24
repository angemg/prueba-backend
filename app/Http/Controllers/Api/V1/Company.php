<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Company as ModelsCompany;
use LaravelJsonApi\Laravel\Http\Controllers\Actions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Company extends Controller
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

    public function registerCompany(Request $request)
    {
        $user = Auth::user();

        $registerCompany = $request->validate([
            'phone'             =>'required|string',
            'document_type'     =>'required|string',
            'estado'            =>'required',
            'user_id'           =>'required',
        ]);

        ModelsCompany::create([
            'phone'             => $registerCompany['phone'],
            'document_type'     => $registerCompany['document_type'],
            'estado'            => $registerCompany['estado'],
            'user_id'           => $user->id,
        ]);

        return response()->json([
            'message' => 'Company Created Successfully',
        ]);
    }
}
