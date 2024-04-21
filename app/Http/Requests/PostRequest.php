<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

       public function rules(): array
    {
        return [
            'en_title' => 'required|unique:post_translations,title,'.$this->id,'post_id',
            'en_content' => 'required|unique:post_translations,content,'.$this->id,'post_id',
            'ar_title' => 'required|unique:post_translations,title,'.$this->id,'post_id',
            'ar_content' => 'required|unique:post_translations,content,'.$this->id,'post_id',
            'slug' => 'required|unique:posts,slug,'.$this->id,
            'tags' => 'required',
        ];
    }
}
