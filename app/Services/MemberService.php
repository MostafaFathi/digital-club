<?php

namespace App\Services;


use App\Models\Member;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class MemberService
{
    public function register($data)
    {
        $member = new Member();
        $member->first_name = $data->first_name;
        $member->last_name = $data->last_name;
        $member->email = $data->email;
        $member->postal_address = $data->postal_address;
        $member->profession = $data->profession;
        $member->password = Hash::make($data->password);
        $member->save();
        event(new Registered($member));
        return $member;
    }
}
