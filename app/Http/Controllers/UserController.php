<?php

namespace espacios\Http\Controllers;

use Illuminate\Http\Request;
use espacios\User;
use Datatables;
use Validator;

class UserController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | User Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated.
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        return view('users/list');
    }

    /**
     * Retrieve all users
     * @param Request $request
     * @return Json Data
     */
    function loadUsers(Request $request) {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'job_title', 'location', 'created_at']);

            return Datatables::of($users)
                            ->addColumn('action', function ($user) {
                                return '<a href="'.url('user/edit/'.$user->id).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>'
                                        . '<a href="#!" data-user-id=' . $user->id . ' class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash"></i> Remove</a>';
                            })
                            ->editColumn('created_at', function ($user) {
                                return $user->created_at->format('M d, Y');
                            })
                            ->make(true);
        }
    }

    /**
     * Form to create users
     *
     * @return user register view
     */
    function addUser() {
        return View('users/register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'job_title' => 'required|max:80',
                    'location' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function createUser(Request $request) {
        $data= $request->all();

        $validator = $this->validator($data);
        if ($validator->fails()) {
            $this->throwValidationException(
                    $request, $validator
            );
        }

        User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'job_title' => $data['job_title'],
                    'location' => $data['location'],
                    'password' => bcrypt($data['password']),
        ]);

        return redirect('home');
    }

    /**
     * Form to edit users
     *
     * @return user edit view
     */
    function editUser($user_id) {
        
        $userExists= User::find($user_id);

        $data['user']=$userExists;
        
        return View('users/edit', $data);
    }

    /**
     * Save a user personal data.
     *
     * @param  array  $data
     * @return User saved
     */
    public function saveUser(Request $request) {
//        $data= $request->all();
//
//        $validator = $this->validator($data);
//        if ($validator->fails()) {
//            $this->throwValidationException(
//                    $request, $validator
//            );
//        }
//
//        User::create([
//                    'name' => $data['name'],
//                    'email' => $data['email'],
//                    'job_title' => $data['job_title'],
//                    'location' => $data['location'],
//                    'password' => bcrypt($data['password']),
//        ]);

        return redirect('home');
    }

}