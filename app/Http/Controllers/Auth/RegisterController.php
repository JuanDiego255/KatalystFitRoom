<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'string', 'max:255'],

            'telephone' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255'],
            'tutor' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $anemia = 0;
        $suffocation = 0;
        $asthmatic = 0;
        $epileptic = 0;
        $diabetic = 0;
        $smoke = 0;

        if (isset($data['anemia'])) {
            $anemia = 1;
        }
        if (isset($data['suffocation'])) {
            $suffocation = 1;
        }
        if (isset($data['asthmatic'])) {
            $asthmatic = 1;
        }
        if (isset($data['epileptic'])) {
            $epileptic = 1;
        }
        if (isset($data['diabetic'])) {
            $diabetic = 1;
        }
        if (isset($data['smoke'])) {
            $smoke = 1;
        }

        return User::create([
            'name' => $data['name'],
            'identification' => $data['identification'],
            'telephone' => $data['telephone'],
            'whatsapp' => $data['whatsapp'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'tutor' => $data['tutor'],
            'blood_type' => 0,
            'address' => $data['address'],
            'injuries' => $data['injuries'],
            'sick' => $data['sick'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'weight' => $data['weight'],
            'weight' => $data['weight'],
            'gender' => $data['gender'],
            'sex' => $data['gender'],
            'anemia' => $anemia,
            'suffocation' => $suffocation,
            'asthmatic' => $asthmatic,
            'epileptic' => $epileptic,
            'diabetic' => $diabetic,
            'smoke' => $smoke,
            'dizziness' => $data['dizziness'],
            'fainting' => $data['fainting'],
            'nausea' => $data['nausea'],
            'sport_Activity' => $data['sport_Activity'],
            'contact_emergency' => $data['contact_emergency'],
            'password' => Hash::make($data['identification']),
        ]);       
    }
}
