<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{

    public function rules()
    {
        return [
            "title"=>["required","string","max:250"],
            "category_id"=>["required","exists:categories,id"],
            "description"=>["required","string","max:1000"],
            "price"=>["required","numeric"],
            "image"=>["nullable","image"]
        ];
    }
}
