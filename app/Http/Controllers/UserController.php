<?php

namespace App\Http\Controllers;

use App\Classes\SmsRu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function UserGet()
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user
        ], 200);
    }
    public function Registration(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstname' => ['required', 'regex:/[А-Яа-яЁё-]/u'],
            'lastname' => ['required', 'regex:/[А-Яа-яЁё-]/u'],
            'patronymic' => ['nullable', 'regex:/[А-Яа-яЁё-]/u'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required', 'regex:/^(?:\+7|8|7)?[- ]?(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{2}[- ]?\d{2}$/', 'unique:users'],
            'email' => ['required', 'email:frc', 'unique:users'],
            'password' => ['required', 'min:12', 'max:40', 'confirmed'],
            'approval' => ['required'],
        ],[
            'firstname.required' => 'Обязательное поле',
            'firstname.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'lastname.required' => 'Обязательное поле',
            'lastname.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'patronymic.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'birthdate.required' => 'Обязательное поле',
            'birthdate.date' => 'Поле должно содержать дату рождения',
            'phone.required' => 'Обязательное поле',
            'phone.regex' => 'Поле должно содержать номер телефона',
            'phone.unique' => 'Пользователь с введенным номером телефона уже зарегистрирован',
            'email.required' => 'Обязательное поле',
            'email.email' => 'Поле должно содержать адрес электронной почты',
            'email.unique' => 'Пользователь с введенным адресом электронной почты уже зарегистрирован',
            'password.required' => 'Обязательное поле',
            'password.min' => 'Минимальная длина пароля 12',
            'password.max' => 'Максимальная длина пароля 40',
            'password.confirmed' => 'Пароли не совпадают',
            'approval.required' => 'Поставьте галочку для согласия обработки персональных данных',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->patronymic = $request->patronymic;
        $user->birthdate = $request->birthdate;
        $user->phone = preg_replace('/\D/', '', $request->phone);
        $user->email = $request->email;
        $user->password = md5($request->password);
        $user->save();

        Auth::login($user);
        return response()->json('/catalog');
    }

    public function SendMessage(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/^(?:\+7|8|7)?[- ]?(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{2}[- ]?\d{2}$/'],
        ],[
            'phone.required' => 'Обязательное поле',
            'phone.regex' => 'Поле должно содержать номер телефона',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $phone = $request->phone;
        $code = mt_rand(100000, 999999);

        $smsRu = new SmsRu();
        $answer = $smsRu->sendSms($phone, 'Ваш код подтверждения: ' . $code);
//        $smsRu->call($phone);

        if ($answer === 'ERROR') {
            return response()->json([
                'message' => "Не удалось отправить код подтверждения. Попробуйте еще раз или авторизуйтесь по паролю. "
            ]);
        } elseif ($answer === 'OK') {
            return response()->json([
                'code' => $code,
                'message' => 'Сообщение с кодом подтверждения отправлено на указанный номер телефона'
            ]);
        }
    }

    public function LoginPhone(Request $request)
    {
        $phone = preg_replace('/\D/', '', $request->phone);

        $user = User::query()
            ->where('phone', $phone)
            ->first();

        if ($user === null) {
            $user = new User();
            $user->phone = $phone;
            $user->save();
            Auth::login($user);
            return response()->json('/catalog');
        } else {
            Auth::login($user);
            return response()->json('/catalog');
        }
    }

    public function LoginPassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ],[
            'email.required' => 'Обязательное поле',
            'password.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = User::query()
            ->where('email', $request->email)
            ->where('password', md5($request->password))
            ->first();

        if ($user) {
            Auth::login($user);
            return response()->json('/catalog');
        } else {
            return response()->json('Неверный логин или пароль', 403);
        }
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('LoginPasswordPage');
    }

    public function UserEdit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstname' => ['regex:/[А-Яа-яЁё-]/u'],
            'lastname' => ['regex:/[А-Яа-яЁё-]/u'],
            'patronymic' => ['nullable', 'regex:/[А-Яа-яЁё-]/u'],
            'phone' => ['required', 'regex:/^(?:\+7|8|7)?[- ]?(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{2}[- ]?\d{2}$/'],
            'email' => ['email:frc'],
        ],[
            'firstname.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'lastname.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'patronymic.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'phone.required' => 'Обязательное поле',
            'phone.regex' => 'Поле должно содержать номер телефона',
            'email.email' => 'Поле должно содержать адрес электронной почты',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = User::query()
            ->where('id', Auth::id())
            ->first();

        if ($user->email !== $request->email) {
            $validate = Validator::make($request->all(), [
                'email' => ['unique:users'],
            ],[
                'email.unique' => 'Пользователь с введенным адресом электронной почты уже зарегистрирован',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }
        }

        if ($user->phone !== $request->phone && preg_replace('/\D/', '', $request->phone) !== $user->phone) {
            $validate = Validator::make($request->all(), [
                'phone' => ['unique:users'],
            ],[
                'phone.unique' => 'Пользователь с введенным номером телефона уже зарегистрирован',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->patronymic = $request->patronymic;
        $user->birthdate = $request->birthdate;
        $user->phone = preg_replace('/\D/', '', $request->phone);
        $user->email = $request->email;
        $user->update();

        return response()->json('OK', 200);
    }
}
