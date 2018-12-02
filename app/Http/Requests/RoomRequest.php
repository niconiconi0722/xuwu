<?php

namespace App\Http\Requests;

use Rule;
use App\Models\Room;

class RoomRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|unique:rooms,name|string|max:30',
                    'description' => 'nullable|string|max:80',
                    'max_users' => 'required|integer|min:1|max:20',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $room = $this->route('room');
                $min_max_users = $room->user_count;

                return [
                    'name' => "required|unique:rooms,name,{$room->id}|string|max:30",
                    'description' => 'nullable|string|max:80',
                    'max_users' => "required|integer|min:$min_max_users|max:20",
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => '请输入房间名称',
            'name.unique' => '房间名称已被使用',
            'name.max' => '房间名称不能超过30个字',
            'description.max' => '房间描述不能超过80个字',
            'max_users.required' => '请填写最大人数',
            'max_users.min' => '房间最大人数过小',
            'max_users.max' => '房间最大人数至多为20人',
        ];
    }
}
