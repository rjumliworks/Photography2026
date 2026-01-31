<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch($this->option){
            case 'folder':
                return [
                    'name' => 'required|string|max:255',
                    'description' => 'required|string|max:255'
                ];
            break;
            case 'tags':
                return [
                    'tags'   => 'required|array|min:1',   
                    'tags.*' => 'integer|exists:list_tags,id'
                ];
            break;
            case 'viewer':
                return [
                    'name'   => 'required',   
                    'email' => 'sometimes|required|email|max:150|unique:viewers,email_hash,'.$this->id,
                ];
            break;

        }
    }
}
