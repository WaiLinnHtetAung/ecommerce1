<?php

namespace App\Http\Controllers;

use App\Events\UserNotification;
use App\Http\Requests\AuthRegisterRequest;
use App\Mail\EmailVerificatioMail;
use App\Models\User;
use App\Models\UserVerify;
use App\Models\VerificationCode;
use App\Notifications\InvoicePaid;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function user()
    {
        return response()->json(['data' => Auth::user()]);
    }

    public function register(AuthRegisterRequest $request)
    {
        // try {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'mobile_no' => $request->input('mobile_no'),
            'email_verification_code' => rand(123456, 999999)
        ];

        // $stillUser = User::where('email', $request->email)->first();
        // if ($stillUser) {
        //     return Mail::to($request->email)->send(new EmailVerificatioMail($stillUser));
        // };
        $user = User::create($data);
        Mail::to($request->email)->send(new EmailVerificatioMail($user));
        // event(new UserNotification($user));
        return response()->json([
            "data" => $user->all(),
            "message" => "User Created Successfully",
            "status" => "success",
            "status_code" => 200
        ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         "message" => $th,
        //         "status" => "error",
        //         "status_code" => 500
        //     ], 500);
        // }
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return response()->json(['message' => 'Opps! You do not have acccess']);
    }
    public function loginUser(Request $request)
    {
        // try {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "message" => "Invalid credentials",
                'status' => "error",
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('jwt', $token, 60 * 24); //1 day
            return response()->json([
                'data' => $user,
                'message' => 'user authorized',
                'status' => 'success',
                'status_code' => 200
            ])->withCookie($cookie);
        }
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         "message" => $th,
        //         "status" => "error",
        //         "status_code" => 500
        //     ], 500);
        // }
    }
    public function logoutUser(Request $request)
    {
        $cookie = Cookie::forget('jwt');
        if (Auth::check()) {
            Auth::guard('web')->logout();
        }
        return response()->json([
            'message' => 'success'
        ], 200)->withCookie($cookie);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required | exists:users,mobile_no'
        ]);
        // try {
            $verificationCode = $this->generateOtp($request->mobile_no);
            if ($verificationCode) {
                $message = "Your OTP To Login Is - " . $verificationCode['otp'];
                Notification::route('smspoh', $request->mobile_no)
                    ->notify(new InvoicePaid($message));
                return response()->json([
                    'user_id' => $verificationCode->user_id,
                    // 'message' => $message,
                    'status' => 'success',
                    'status_code' => 200,
                ], 200);
            }
            return response()->json([
                'message' => 'Something went wrong try again',
                'status' => 'error',
                'status_code' => 422
            ], 422);
        // } catch (\Throwable $th) {
        //     return response()->json(['message' => 'Something went wrong','error'=>$th]);
        // }
    }
    public function generateOtp($mobile_no)
    {
        $user = User::where('mobile_no', $mobile_no)->first();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        $now = Carbon::now();
        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
            return $verificationCode;
        }
        $data = VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
        return $data;
    }
    public function verificationOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'user_id' => 'required | exists:users,id'
        ]);
        $verificationCode = VerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
        $now = Carbon::now();
        if (!$verificationCode) {
            return response()->json([
                'message' => 'Your OTP Code is incorrect',
                'status' => 'error',
                'status_code' => 422
            ], 422);
        } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
            return response()->json([
                'message' => 'Your OTP Code is expired',
                'status' => 'error',
                'status_code' => 422
            ], 422);
        }
        $user = User::whereId($request->user_id)->first();
        if ($user) {
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);
            Auth::login($user);
            return response()->json([
                'data' => $user,
                'message' => 'Success',
                'status' => 'success',
                'status_code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'Your OTP Code is incorrect',
            'status' => 'error',
            'status_code' => 422,
        ], 422);
    }

    public function verify($id,$verificationn_code)
    {
        $user = User::where('email_verification_code', $verificationn_code)->first();
        Auth::login($user);
        if (!$user) {
            return view('vue.layout')->with('error', 'Invalid Url');
        } else {
            if ($user) {
                return view('vue.layout', ['user' => $user]);
            }
        }
    }
    public function markNotification(Request $request){
        auth()->user()
        ->unreadNotifications
        ->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })
        ->markAsRead();

    return response()->noContent();
    }
}
