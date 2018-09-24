<?php 
namespace espacios\Http\Controllers;
use Illuminate\Http\Request;
use espacios\User;
use Datatables;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            return view('home');
	}

        function loadUsers(Request $request) {
            if ($request->ajax()) {
                $users = User::select(['id','name','email','job_title','location','created_at']);

                return Datatables::of($users)->make(true);
            }
        }

}
