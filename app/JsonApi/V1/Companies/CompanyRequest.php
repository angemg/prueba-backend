<?php

namespace App\JsonApi\V1\Companies;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class CompanyRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone'         => ['required', 'string'],
            'document_type' => ['required', 'string'],
            'estado'        => ['required', 'string'],
            'user'          => JsonApiRule::toOne(),
            'activities'    => JsonApiRule::toMany(),
        ];
    }

}
