<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\RoleUserEnum;
use App\Http\Controllers\Controller;
use App\JsonApi\V1\Users\UserRequest;
use LaravelJsonApi\Laravel\Http\Controllers\Actions;
use App\Models\User;

class Users extends Controller
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


    public function saved(User $user, UserRequest $request): void
    {
        $user->role = RoleUserEnum::USERJUNIOR->value;
        $user->save();

    }

}
