<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class ProductCreateRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'shipping_fee' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Invalid product price',
            'stock.required' => 'Product stock is required',
            'stock.numeric' => 'Invalid product stock',
            'shipping_fee.required' => 'Product shipping fee is required',
            'shipping_fee.numeric' => 'Invalud product shipping fee'
        ];
    }
}
