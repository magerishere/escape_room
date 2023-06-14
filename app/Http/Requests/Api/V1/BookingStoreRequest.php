<?php

namespace App\Http\Requests\Api\V1;

use App\Models\EscapeRoomTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'escape_room_time_id' => ['required', Rule::exists(EscapeRoomTime::class, 'id')],
        ];
    }
}
