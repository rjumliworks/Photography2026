<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch($this->option){
            case 'password':
                return [
                    'id' => 'required|exists:folders,id',
                    'password' => 'required|string|min:6|confirmed'
                ];
            break;
            default:
                return [];
        }
    }
}
