<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\model;
use Illuminate\Http\Request;

class InlineCrudController extends Controller
{
	
	public function __construct($arg = "")
	{
		# code...
	}
	public function index(){
		
	}
	
	public function InlineCrud1(){
		$employeedata = DB::select('select * from employees1 limit 10');
		// return json_encode($employeedata);
		return view('inlinecrud/inline1');
	}
	
	public function getallEmpList(){
		$employeedata = DB::select('select * from employees1 ');
		return json_encode($employeedata);
	}

	public function InlineCrud2(){
		return view('inlinecrud/inline2');
	}

	public function updateEmployee(Request $request){
		$data = [];
		$empid = $request->input('empid');
		$fname = $request->input('fname');
		$lname = $request->input('lname');
		$gender = $request->input('gender');
		$bdate = $request->input('bdate');
		$status = $request->input('status');
		// $data['first_name'] = $fname;
		// $data['last_name'] = $lname;
		// $data['status'] = $status;
		// print_r($data);
		$result = DB::table('employees1')
            ->where('emp_no', $empid)
            ->update(['first_name' => $fname,'last_name' => $lname,'status' => $status]);
		$message['success'] = false;
		$message['type'] = 'update';

		if($result){
			$message['success'] = true;
		}
		echo json_encode($message);
	}

	public function deleteEmployee(Request $request){
		$empid = $request->id;
		// echo $empid;
		$result = DB::table('employees1')->where('emp_no', '=',$empid )->delete();
		$message['success'] = false;
		if($result){
			$message['success'] = true;
		}
		return response()->json($message);
	}


}

?>