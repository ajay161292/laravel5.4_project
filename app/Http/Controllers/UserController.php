<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
	
	public function __construct($arg="")
	{
		# code...
	}

	public function index(){
		return view('user/index');
	}

	public function login(Request $request){
		$email = $request->input('email');
		$password = $request->input('password');
		
		$user = DB::table('user')->where('username', $email)->first();
		// var_dump($user);
		$message['success'] = false;
		if($user){
			// Via a request instance...
			$request->session()->put('username', $user->username);
			// Via the global helper...
			// session(['key' => 'value']);
			$message['success'] = true;
		}
		// echo json_encode($message);
		return response()->json($message);
	}

	public function logout(Request $request){
		//Retrieving All Session Data
		$data = $request->session()->all();

		if ($request->session()->has('users')) {
		    //
		}
		if ($request->session()->exists('users')) {
		    //
		}


	}
}
?>