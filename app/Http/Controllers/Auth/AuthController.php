<?php namespace app\Http\Controllers\Auth;

use Validator;
use App\User;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        $validate = [
            'first_name' => 'required|max:20|min:3',
            'last_name' => 'required|max:20|min:3',
            'email' => 'required|email|max:255|unique:users',
            //'role' => 'required',
            'password' => 'required|min:6',
        ];
        if (!env('APP_DEBUG', false)) {
            $validate['g-recaptcha-response'] = 'required|recaptcha';
        }
        return Validator::make($data, $validate);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        $role = isset($data['role']) ? $data['role'] : 'person';

        if ($role == 'admin' && !Auth::user()->isAdmin()) {
            $role = 'person';
        }

        $user = User::create([
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'role'     => $role
        ]);

        Person::create([
            'user_id'    => $user->id,
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
        ]);

        //Confirmation email settings

        $title = trans('user.emails.verification_account.subject');

        $name = $data['first_name'].' '.$data['last_name'];

        \Mail::queue('emails.accountVerification', ['data' => $data, 'title' => $title, 'name' => $name], function ($message) use ($data) {
            $message->to($data['email'])->subject(trans('user.emails.verification_account.subject'));
        });

        \Session::put('message', trans('user.signUp_message', ['_name' => $name ]));

        \Session::save();

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * Rewrite
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $email = null;
        if (\Session::has('email')) {
            $email = \Session::get('email');
        }
        $user_roles = trans('globals.roles');
        unset($user_roles['admin']);
        return view('auth.register', compact('user_roles', 'email'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        if ($request->input('newuser')) {
            \Session::flash('email', $request->input('email'));
            return redirect('/auth/register');
        } else {
            $validate = [
                'email' => 'required|email',
                'password' => 'required',
            ];

            if (!env('APP_DEBUG', false)) {
                $validate['g-recaptcha-response'] = 'required|recaptcha';
            }

            $this->validate($request, $validate);

            $credentials = $this->getCredentials($request);

            if (Auth::attempt($credentials, $request->has('remember'))) {
                return redirect()->intended($this->redirectPath());
            }

            return redirect($this->loginPath())
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => $this->getFailedLoginMessage(),
                ]);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        \Session::flush();

        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
