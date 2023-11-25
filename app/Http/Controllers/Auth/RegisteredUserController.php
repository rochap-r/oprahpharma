<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GenConfig;
use App\Models\Role;
use App\Models\TypeUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required'],
            'sname' => ['required'],
            'lname' => ['required' ],
            'phone' => ['required' ],
            'email' => ['required', 'email', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],[
            'name.required'=>'le nom est obligatoire veuillez le saisir.',
            'sname.required'=>'le postnom est obligatoire veuillez le saisir.',
            'lname.required'=>'le prenom est obligatoire veuillez le saisir.',
            'phone.required'=>'le numero téléphone est obligatoire veuillez le saisir.',
            'email.required'=>'l\'adresse est obligatoire veuillez la saisir.',
            'email.unique'=>'Cette adresse est déjà prit éssayez une autre.',
            'email.email'=>'Cette adresse est invalide réessayez correctement.',
            'password.required'=>'Le Mot de passe est obligatoire.',
        ]);

        $status=TypeUser::where('name','membre simple')->first();
        if (!$status){
            TypeUser::create(['name'=>'membre simple']);
            $status=TypeUser::where('name','membre simple')->first();

        }

        $user = User::create([
            'name' => $request->name,
            'sname' => $request->sname,
            'lname' => $request->lname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'role_id'=>Role::where('name','user')->first()->id,
            'type_user_id'=>$status->id,
            'password' => Hash::make($request->password),
        ]);


        $data = [
            'name' => $user->name.' '.$user->fname,
            'email' => $user->email,
            'password'=>$request->password,
        ];
        $admin_email=GenConfig::find(1)->email;
        $appName=env('APP_NAME');

        Mail::send('emails.new-member-create', $data, function ($message) use ($admin_email, $appName) {
            $message->to($admin_email, $appName)
                //->cc(GenConfig::find(1)->email)
                ->from(env('MAIL_USERNAME'), env('APP_NAME'))
                ->subject('Adhésion d\'un nouveau membre');
        });
        $user_name=$user->name.' '.$user->fname;
        $user_email=$user->email;

        Mail::send('emails.new-member_email-template', $data, function ($message) use ($user_email, $user_name) {
            $message->to($user_email, $user_name)
                ->from(env('MAIL_USERNAME'), env('APP_NAME'))
                ->subject('Adhésion à la fondation Rank');
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
