<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'products'              => 'required|array',
            'products.*.product_id' => [
                'required',
                'integer',
                Rule::exists('products', 'id'),
            ],
            'products.*.price'      => 'required|integer',
            'products.*.quantity'   => 'required|integer',
        ];
    }

}
