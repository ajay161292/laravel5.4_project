<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\model;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
	public function index(){
		$employeelist = DB::select('select * from employees where status = ?', [1]);
 		return view('employee/employee_list', ['employeelist' => $employeelist]);
	}

	public function getallEmployee(){
		
		$employeedata = DB::select('select * from employees limit 0,5');
		// print_r($employeedata);exit;
		return json_encode($employeedata);
	}

	public function addEmployee(Request $request){
		$first_name = $request->input('fname');
		$last_name = $request->input('lname');
		$gender = $request->input('gender');
		$status = $request->input('status');

		$result = DB::table('employees')->insert(['first_name'=>$first_name,'last_name'=>$last_name,'gender'=>$gender,'status'=>$status]);

		$message['success'] = false;
		$message['type'] = 'add';
		if($result){
			$message['success'] = true;
		}
		echo json_encode($message);
	}
	public function editEmployee(Request $request){
		$empid = $request->id;
		$employeedata = DB::table('employees')->where('emp_no', $empid)->first();
		if($employeedata){
			echo json_encode($employeedata);
		}
	}

	public function updateEmployee(Request $request){
		$empid = $request->input('empid');
		$fname = $request->input('fname');
		$lname = $request->input('lname');
		$gender = $request->input('gender');
		$status = $request->input('status');

		$result = DB::table('employees')
            ->where('emp_no', $empid)
            ->update(['first_name' => $fname,'last_name' => $lname,'gender' => $gender,'status' => $status]);
		$message['success'] = false;
		$message['type'] = 'update';
	
		if($result){
			$message['success'] = true;
		}
		echo json_encode($message);
	}

	public function deleteEmployee(Request $request){
		$empid = $request->id;
		// echo $empid;exit;
		$result = DB::table('employees')->where('emp_no', '=',$empid )->delete();
		$message['success'] = false;
		if($result){
			$message['success'] = true;
		}
		return response()->json($message);
	}

}

