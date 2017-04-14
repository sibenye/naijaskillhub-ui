<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioAudioAddRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'audio' => 'required|mimes:mpga,mp3,wav|max:4048',
                'caption' => 'max:80'
        ];
    }
}
