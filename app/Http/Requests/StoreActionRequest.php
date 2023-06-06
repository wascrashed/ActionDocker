<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionRequest extends FormRequest
{ 
    public function authorize()
    {
        return true;
    }
 
    public function rules()
    {
        return [
            'userId' => 'required|integer',
            'actionKey' => 'required|string',
            'date' => 'required|integer',
            'info' => 'required|array'
        ];
    }
}
