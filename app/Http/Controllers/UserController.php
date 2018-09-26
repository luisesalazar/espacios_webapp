<?php

namespace espacios\Http\Controllers;

use Illuminate\Http\Request;
use espacios\User;
use Datatables;
use Validator;
use Auth;

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
    * Display a listing of the resource.
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
            $users = User::select(['id', 'name', 'email', 'job_title', 'location', 'created_at'])->where('id','!=', Auth::id());

            return Datatables::of($users)
                            ->addColumn('action', function ($user) {
                                return '<a href="' . url('user/edit/' . $user->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>'
                                        . '<a href="#!" data-route="' . url('user/destroy/' . $user->id) . '" data-token="'.  csrf_token() .'" data-user-id=' . $user->id . ' data-question="Do you want to remove '.$user->name.'?" class="btn btn-xs btn-danger pull-right btn-remove"><i class="fa fa-trash"></i> Remove</a>';
                            })
                            ->editColumn('created_at', function ($user) {
                                return $user->created_at->format('M d, Y');
                            })
                            ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $data= $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'job_title' => 'required|max:80',
            'location' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user= User::find($id);

        if($user==null){
            abort(404);
        }

        $data['user']=$user;

        return View('users/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {
        $user= User::find($id);

        if($user==null){
            abort(404);
        }

        $data= $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'job_title' => 'required|max:80',
            'location' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                    $request, $validator
            );
        }

        $user->name= $data['name'];
        $user->location= $data['location'];
        $user->job_title= $data['job_title'];

        $user->save();

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {
        if ($request->ajax()) {
            $response= ["status"=>0, "msg"=> "An error has occurred"];
            
            $user= User::find($id);

            if($user==null){
                $response["msg"]="User does not exist.";
            }

            if($user->delete()){
                $response= ["status"=>1, "msg"=> "User deleted succesfully!"];
            }

            return response()->json($response)
                 ->setCallback($request->input('callback'));
        }
    }

}