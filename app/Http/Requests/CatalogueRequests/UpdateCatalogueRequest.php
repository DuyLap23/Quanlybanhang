<?php
namespace App\Http\Requests\CatalogueRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCatalogueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->segment(4);
       
        return [
            'name' => ['required','max:20', Rule::unique('catelogues')->ignore($id)],
            'cover' => ['image', Rule::requiredIf(empty(request()->image_url))],
        ];
      
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không quá 20 ký tự ',
            'cover.required' => 'Ảnh không được để trống',
        ];
    }
   
}
