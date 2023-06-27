<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $this->merge([
           "user_id"=>Auth::user()->id
        ]);
    }

    public function rules(): array
    {
        return [
            "user_id"=>["bail","required"],
            "title"=>["required","string","max:250"],
            "category_id"=>["required","exists:categories,id"],
            "description"=>["required","string","max:1000"],
            "price"=>["required","numeric"],
            "image"=>["required","image"]
        ];
    }
}
