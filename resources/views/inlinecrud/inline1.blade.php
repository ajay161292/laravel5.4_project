@extends('layout/master')
@section('title', 'Employee List')
@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')

<div class="container">
  <div class="alert alert-success" role="alert" style="display:none;"></div>
  <a href="<?php echo URL::to('employee'); ?>" class="btn btn-info ">Employee AJAX Crud</a>
  <a href="<?php echo URL::to('inlinecrud/inlinecrud1'); ?>" class="btn btn-info ">Inline CRUD-1</a>
  <a href="<?php echo URL::to('inlinecrud/inlinecrud2'); ?>" class="btn btn-info ">Inline CRUD-2</a>
  <h3>Employee List</h3>
  <button class="btn btn-success addemp">Add New Employee</button>
  <table class="table table-striped table-responsive" id="emp_list" >
    <thead>
      <tr>
        <th scope="col">Employee Id</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Birth Date</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody id="showdata">
      
    </tbody>
  </table>
</div>
<!-- Modal -->
<div class="modal fade" id="mymodel" tabindex="-1" role="dialog" aria-labelledby="mymodel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mymodel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="my_form" method="post">
        {{ csrf_field() }}
            <input type="hidden" name="empid" value="0">
            <div class="form-group">
              <label class="col-form-label" for="fname">First Name</label>
              <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
            </div>
            <div class="form-group">
              <label class="col-form-label" for="lname">Last Name</label>
              <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
            </div>
            
            <div class="form-group col-md-4">
              <label for="inputState">Gender</label>
                <select id="gender" name="gender" class="form-control">
                  <option value="M" selected>Male</option>
                  <option value="F">Female</option>
                </select>
            </div>

            <div class="form-group col-md-4">
              <label for="inputState">Status</label>
              <select id="status" name="status" class="form-control">
                <option value="1" selected>Active</option>
                <option value="0">InActive</option>
              </select>
            </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnsaveemp" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletemodel" tabindex="-1" role="dialog" aria-labelledby="deletemodel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are You Sure You want to delete record ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btndelete" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>


<script src = "<?php echo URL::asset("plugins/jquery_validation/lib/jquery-3.1.1.js")?>"></script>
<script src = "<?php echo URL::asset("plugins/jquery_fulltable/jquery.fulltable.js")?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo URL::asset("plugins/jquery_fulltable/jquery.fulltable.css")?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo URL::asset("plugins/bootstrap/css/bootstrap.min.css")?>"/>
<script src = "<?php echo URL::asset("plugins/bootstrap/js/bootstrap.min.js")?>"></script>
<script src = "<?php echo URL::asset("plugins/Datatables/datatables.min.js")?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo URL::asset("plugins/Datatables/datatables.css")?>"/>
<script>
// $(document).ready(function(){
  // var DataTable = $('#emp_list').DataTable();
// })
$(function(){
    showallEmployee();

 //    $(".addemp").click(function(){
	//     $("#mymodel").modal('show');
	//     $("#mymodel").find(".modal-title").text('Add New Employee');
	//     $("#my_form").attr("action","<?php echo url("employee/addEmployee")?>");
 //  	});
  
	// $("#btnsaveemp").click(function(){
	//     var url = $("#my_form").attr('action');
	//     var data = $("#my_form").serialize();
	//     //validate form
	//     var fname = $('input[name=fname]');
	//     var lname = $('input[name=lname]');
	//     var result = '';
	//     if(fname.val() == ""){
	//       fname.parent().parent().addClass('has-error');
	//     }
	//     else{
	//       fname.parent().parent().removeClass('has-error'); 
	//       result += '1';
	//     }
	//     if(lname.val() == ""){
	//       lname.parent().parent().addClass('has-error');
	//     }
	//     else{
	//       lname.parent().parent().removeClass('has-error'); 
	//       result += '2';
	//     }

	//     if(result == '12'){
	//       alert('ok');
	    
	//       $.ajax({
	//         type: 'ajax',
	//         method: 'post',
	//         data: data,
	//         async: false,
	//         dataType: 'json',
	//         url: url,
	//         success: function(response){
	//           // console.log(response);return false;
	//           if(response.success){
	//             $("#mymodel").modal('hide');
	//             $("#my_form")[0].reset();
	//             if(response.type == 'add'){
	//               var type = 'Added';
	//             }else if(response.type == 'update'){
	//               var type = 'Updated';
	//             }
	//             $(".alert-success").html('Employee' + type + 'Successfully').fadeIn().delay(4000).fadeOut();
	//             showallEmployee();
	//           }
	//           else{
	//             alert('Error');
	//           }
	//         },
	//         error: function(){
	//           alert('Could not add data');
	//         }
	//       })
	//     }
	// })
	$("#emp_list").FullTable({
		"alwaysCreating":true,
		"selectable":true,
		// "fields": {
		// 	"gender":{
		// 		"options":[
		// 			{
		// 				"title":"Male",
		// 				"value":"xy"
		// 			},
		// 			{
		// 				"title":"Female",
		// 				"value":"xx"
		// 			}
		// 		],
		// 		"mandatory":true,
		// 		"placeholder":"Select one",
		// 		"errors":{
		// 			"mandatory":"Gender name is mandatory"
		// 		}
		// 	},
		// 	"firstname":{
		// 		"mandatory":true,
		// 		"errors":{
		// 			"mandatory":"First name is mandatory"
		// 		}
		// 	},
		// 	"lastname":{
		// 		"mandatory":true,
		// 		"errors":{
		// 			"mandatory":"Last name is mandatory"
		// 		}
		// 	},
		// 	"age":{
		// 		"type":"integer",
		// 		"mandatory":false,
		// 		"validator":function(age) {
		// 			if (age >= 0) {
		// 				return true;
		// 			} else {
		// 				return false;
		// 			}
		// 		},
		// 		"errors":{
		// 			"type":"Age must be an integer number",
		// 			"mandatory":"Age is mandatory",
		// 			"validator":"Age cannot be negative"
		// 		}
		// 	},
		// 	"height":{
		// 		"type":"decimal",
		// 		"mandatory":false,
		// 		"validator":function(height) {
		// 			if ((height > 0.3) && (height <= 2.8)) {
		// 				return true;
		// 			} else {
		// 				return false;
		// 			}
		// 		},
		// 		"errors":{
		// 			"type":"Height must be a number",
		// 			"mandatory":"Height is mandatory",
		// 			"validator":"Height cannot be neither biggest than 2.8 nor lowest than 0.3"
		// 		}
		// 	},
		// 	"description":{
		// 		"mandatory":false
		// 	}
		// }
	});
	$("#emp_list-add-row").click(function() {
		$("#emp_list").FullTable("addRow");
	});
	$("#emp_list-get-value").click(function() {
		console.log($("#emp_list").FullTable("getData"));
	});
	$("#emp_list").FullTable("on", "error", function(errors) {
		for (var error in errors) {
			error = errors[error];
			console.log(error);
		}
	});
	$("#emp_list").FullTable("draw");



	$("#showdata").on('click','fulltable-edit', function(){
	    var emp_id =$(this).attr('data');
	    // alert(emp_id);
	    console.log($(this).prev());
	    var id = $(this).parent().parent()[0].cells[0].innerText;
	    var fname = $(this).parent().parent()[0].cells[1].innerText;
	    var lname = $(this).parent().parent()[0].cells[2].innerText;
	    var bod = $(this).parent().parent()[0].cells[3].innerText;
	    var status = $(this).parent().parent()[0].cells[4].innerText;

	    var input = '<td>'+id+'</td><td><input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value='+fname+'></td><td><input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value='+lname+'></td><td><input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value='+bod+'></td><td><input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value='+status+'></td>';

	    var actin_btn = '<td><a href="javascript:void(0);" class="btn btn-info item_edit" data="'+id+'">Update</a> | '+'<a href="javascript:void(0);" class="btn btn-danger item_delete" data="'+id+'">Cancel</a></td></tr>';
	    
	    var row = '<tr>'+input;
	    var final_row = row;

   		$(this).parent().parent()[0].replaceWith(final_row);
	})

	$("#showdata").on('click','fulltable-remove', function(){
	    var emp_id = $(this).attr('data');
	    alert(emp_id);
	    $("#deletemodel").modal('show');
	    $("#btndelete").click(function(){
	      $.ajax({
	        type: 'ajax',
	        method: 'get',
	        data: {id:emp_id},
	        async: false,
	        url: "<?php echo url("inlinecrud/deleteEmployee")?>",
	        dataType: 'json',
	        success: function(data){
	          // console.log(data);return false;
	          $('#deletemodel').modal('hide');
	          $('.alert-success').html('Employee is deleted successfully').fadeIn().delay(4000).fadeOut('slow');
	          showallEmployee();
	        },
	        error: function(){
	          alert('Record Could not be deleted');
	        }
	      })
	    })
	})

	function showallEmployee(){
	    $.ajax({
	      type: 'get',
	      url: "<?php echo url("inlinecrud/getallemplist")?>",
	      async: false,
	      dataType: 'json',
	      success: function(data){
	        // console.log(data);return false;
	        var html ='';
	        var i;
	        for(i = 0; i < data.length; i++){
	           html += '<tr>'+
	                        '<td>'+data[i].emp_no+'</td>'+
	                        '<td>'+data[i].first_name+'</td>'+
	                        '<td>'+data[i].last_name+'</td>'+
	                        '<td>'+data[i].birth_date+'</td>'+
	                        '<td>'+data[i].status+'</td>'+
	                        // '<td>'+
	                        //   '<a href="javascript:void(0);" class="btn btn-info item_edit" data="'+data[i].emp_no+'">Edit</a>'+
	                        //   '<a href="javascript:void(0);" class="btn btn-danger item_delete" data="'+data[i].emp_no+'">Delete</a>'
	                        // '</td>'+
	                    '</tr>';
	        }
	        $("#showdata").html(html);
	      },
	      error: function(){
	        alert('Could not get data from database');
	      }
	    })
	}

	

})
</script>

@endsection