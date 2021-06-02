<?php

namespace App\Http\Requests;

use App\traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class postShowRequest extends FormRequest
{
    use ValidationTrait;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
