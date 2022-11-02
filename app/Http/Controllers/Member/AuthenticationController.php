<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterMemberRequest;
use App\Services\MemberService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    private $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function register(RegisterMemberRequest $request)
    {
        $member = $this->memberService->register($request);
        return response()->json(['data' => $member]);
    }
}
