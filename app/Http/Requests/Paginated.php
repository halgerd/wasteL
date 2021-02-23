<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Paginated extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => 'integer',
            'limit' => 'integer|max:50'
        ];
    }
}
