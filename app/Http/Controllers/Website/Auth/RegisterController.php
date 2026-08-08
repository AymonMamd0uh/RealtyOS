<?php

namespace App\Http\Controllers\Website\Auth;

use App\Actions\Auth\RegisterCompanyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCompanyRequest;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function create()
    {
        $plan = Plan::find(request('plan'));

        return view('website.auth.register', compact('plan'));
    }

    public function store(
        RegisterCompanyRequest $request,
        RegisterCompanyAction $registerCompanyAction
    ) {
        $user = DB::transaction(function () use ($request, $registerCompanyAction) {
            return $registerCompanyAction->execute(
                $request->validated()
            );
        });

        // إرسال رسالة التحقق باستخدام Laravel Notification
        $user->sendEmailVerificationNotification();

        $request->session()->regenerate();

        return redirect()->route('verification.notice');
    }
}