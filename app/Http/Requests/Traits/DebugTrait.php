<?php

declare(strict_types=1);

namespace App\Http\Requests\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

/**
 *  Trait DebugTrait
 *
 *  This trait overrides the default behavior of Laravel's validation failure handling.
 *  When validation fails, it will throw an HttpResponseException and return a JSON response
 *  with the validation errors. This is particularly useful for handling AJAX requests
 *  where JSON responses are expected.
 *
 *  Usage:
 *  Include this trait in your FormRequest class to enable detailed JSON validation error responses.
 */
trait DebugTrait
{
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw new HttpResponseException($response);
    }
}
