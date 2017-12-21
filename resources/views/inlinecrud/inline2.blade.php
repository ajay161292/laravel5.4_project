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
  <table class="table table-hover" id="emp_list" >
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
          {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
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
<link rel="stylesheet" type="text/css" href="<?php echo URL::asset("plugins/bootstrap/css/bootstrap.min.css")?>"/>
<script src = "<?php echo URL::asset("plugins/bootstrap/js/bootstrap.min.js")?>"></script>

<script>
$(function(){
    showallEmployee();
    $(document).find('.btn_update').hide();
	$(document).find('.btn_cancel').hide();
 //    $(".addemp").click(function(){
	//     $("#mymodel").modal('show');
	//     $("#mymodel").find(".modal-title").text('Add New Employee');
	//     $("#my_form").attr("action","<?php echo url("employee/addEmployee")?>");
 //  	});
  
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
	           html += '<tr row_id ="'+data[i].emp_no+'">'+
	                        '<td><div class="row_data" edit_type="click" col_name="emp_no">'+data[i].emp_no+'</div></td>'+
	                        '<td><div class="row_data" edit_type="click" col_name="fname">'+data[i].first_name+'</td>'+
	                        '<td><div class="row_data" edit_type="click" col_name="lname">'+data[i].last_name+'</td>'+
	                        '<td><div class="row_data" edit_type="click" col_name="bdate">'+data[i].birth_date+'</td>'+
	                        '<td><div class="row_data" edit_type="click" col_name="status">'+data[i].status+'</td>'+
	                        '<td>'+
	                          '<a href="javascript:void(0);" class="item_edit" data="'+data[i].emp_no+'">Edit</a>  '+
	                          '<a href="javascript:void(0);" class="item_delete" data="'+data[i].emp_no+'">Delete</a> '+
	                          '<a href="javascript:void(0);" class="btn_update" data="'+data[i].emp_no+'">Update</a> '+
	                          '<a href="javascript:void(0);" class="btn_cancel">Cancel</a>'
	                        '</td>'+
	                    '</tr>';
	        }
	        $("#showdata").html(html);
	      },
	      error: function(){
	        alert('Could not get data from database');
	      }
	    })
	}
	
	$(document).on('click','.row_data', function(event){
		event.preventDefault();
		
		if($(this).attr('edit_type') == 'button'){
			return false;
		}
		$(this).closest('div').attr('contenteditable','true');
		$(this).addClass('bg-warning').css('padding','5px');
		$(this).focus();
	});

	$(document).on('focusout','.row_data',function(event){
		event.preventDefault();
		if($(this).attr('edit_type') == 'button'){
			return false;
		}
		var row_id = $(this).closest('tr').attr('row_id');
		// console.log(row_id);
		var row_div = $(this)
					.removeAttr('contenteditable')
					.removeClass('bg-warning')
					.css('padding','')
		var col_name = row_div.attr('col_name');
		var col_val = row_div.html();
		var arr = {};
		arr[col_name] = col_val;
		$.extend(arr,{empid:row_id});
		$.extend(arr,{"_token":"{{ csrf_token() }}"});
		// console.log(arr);return false;
		$.ajax({
	        type: 'ajax',
	        method: 'post',
	        data: arr,
	        async: false,
	        url: "<?php echo url("inlinecrud/updateEmployee")?>",
	        dataType: 'json',
	        success: function(response){
	          // console.log(response);return false;
	          if(response.success){
	            if(response.type == 'add'){
	              var type = 'Added';
	            }else if(response.type == 'update'){
	              var type = 'Updated';
	            }
	            $(".alert-success").html('Employee' + type + 'Successfully').fadeIn().delay(4000).fadeOut();
	            showallEmployee();
	          }
	          else{
	            alert('Error');
	          }
	        },
	        error: function(){
	          alert('Could not add data');
	        }
	      })
		//use the "arr" object for your ajax call
		// $('.post_msg').html('<pre class="bg-success">'+JSON.stringify(arr,null,2)+'</pre>');
	})

	$(document).on('click','.item_edit', function(event){
	    event.preventDefault();
	    // var emp_id =$(this).attr('data');
		var tbl_row	= $(this).closest('tr');
		console.log(tbl_row);
		var row_id = $(this).closest('tr').attr('row_id');
	    
	    tbl_row.find('.item_edit').hide();
	    tbl_row.find('.item_delete').hide();
	    tbl_row.find('.btn_update').show();
		tbl_row.find('.btn_cancel').show();
		
		//make the whole row editable
		tbl_row.find('.row_data')
			.attr('contenteditable','true')
			.attr('edit_type','button')
			.addClass('bg-warning')
			.css('padding','5px');
		
		tbl_row.find('.row_data').each(function(key,val){
			$(this).attr('original_entry',$(this).html());
		});

	});

	$(document).on('click','.btn_cancel', function(event){
		event.preventDefault();
		var tbl_row	= $(this).closest('tr');
		// console.log(tbl_row);
		var row_id = tbl_row.attr('row_id');
		tbl_row.find('.item_edit').show();
	    tbl_row.find('.item_delete').show();
	    tbl_row.find('.btn_update').hide();
		tbl_row.find('.btn_cancel').hide();

		//make the whole row editable
		tbl_row.find('.row_data')
			.attr('edit_type','click')
			.removeAttr('contenteditable')
			.removeClass('bg-warning')
			.css('padding');

		tbl_row.find('.row_data').each(function(key,val){
			$(this).html( $(this).attr('original_entry') );
		});
	});

	$(document).on('click','.btn_update',function(event){
		event.preventDefault();
		var tbl_row	= $(this).closest('tr');
		var row_id = tbl_row.attr('row_id');
		tbl_row.find('.item_edit').show();
	    tbl_row.find('.item_delete').show();
	    tbl_row.find('.btn_update').hide();
		tbl_row.find('.btn_cancel').hide();
	    
	    //make the whole row editable
		tbl_row.find('.row_data')
			.attr('edit_type','click')
			.removeAttr('contenteditable')
			.removeClass('bg-warning')
			.css('padding','');
		
		var arr = {};
		tbl_row.find('.row_data').each(function(key,value){
			var col_name = $(this).attr('col_name');
			var col_val = $(this).html();
			arr[col_name] = col_val;
		});
	    $.extend(arr,{empid:row_id});
	    $.extend(arr,{"_token":"{{ csrf_token() }}"});
	    // console.log(arr);return false;
	    $.ajax({
	        type: 'ajax',
	        method: 'post',
	        data: arr,
	        async: false,
	        dataType: 'json',
	        url: "<?php echo url("inlinecrud/updateEmployee"); ?>",
	        success: function(response){
	          // console.log(response);return false;
	          if(response.success){
	            if(response.type == 'add'){
	              var type = 'Added';
	            }else if(response.type == 'update'){
	              var type = 'Updated';
	            }
	            $(".alert-success").html('Employee' + type + 'Successfully').fadeIn().delay(4000).fadeOut();
	            showallEmployee();
	          }
	          else{
	            alert('Error');
	          }
	        },
	        error: function(){
	          alert('Could not add data');
	        }
	    })
		
	})
	  
	$("#showdata").on('click','.item_delete', function(){
	    var emp_id = $(this).attr('data');
	    // alert(emp_id);
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
})

</script>
@endsection