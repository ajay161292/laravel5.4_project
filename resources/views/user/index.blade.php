@extends('layout/master')
@section('title', 'Employee List')
@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')

<div class="container" style ="width: 300px">
  <form class="form-signin" id="loginform" method="post" >
    {{ csrf_field() }}
    <h2 class="form-signin-heading">Please sign in</h2>
    
    <div class="form-group row">
      <label for="email" class="sr-only">Email address</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required="" autofocus="">
    </div>
    
    <div class="form-group row">
      <label for="password" class="sr-only">Password</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
    </div>
    <div class="checkbox row">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <div class="form-group row">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </div>
  </form>
</div>


<script src = "<?php echo URL::asset("plugins/jquery_validation/lib/jquery-3.1.1.js")?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo URL::asset("plugins/bootstrap/css/bootstrap.min.css")?>"/>
<script src = "<?php echo URL::asset("plugins/bootstrap/js/bootstrap.min.js")?>"></script>
<script src = "<?php echo URL::asset("plugins/bootstrap-validator/js/bootstrapValidator.min.js")?>"></script>

<script>
$(document).ready(function() {
    $("#loginform").bootstrapValidator({
       fields: {
              email: {
                  validators: {
                      notEmpty: {
                        // enabled is true, by default
                        message: 'The full name is required and cannot be empty'
                    }
                  }
              }
        },
        submitHandler: function(validator, form, submitButton) {
            var formdata = $(form).serialize();
            // console.log(formdata);return false;
            $.ajax({
                type: 'POST',
                url: '<?php echo url("user/login") ?>',
                data: formdata,
                success: function(response) {
                  // console.log(response.success);return false;
                  if(response.success){
                    alert(1);
                    window.location.href = '<?php echo url('employee') ?>';
                    // $(".alert-success").html('Login Successfully').fadeIn().delay(4000).fadeOut();
                  }
                  else{
                    alert('Error');
                  }
                  // $("#user_fact_form").data('bootstrapValidator').resetForm();
                }
            });
            return false;
        },
    })
    // .on('success.form.bv', function(e) {
    //       // Prevent form submission
    //       e.preventDefault();
    //       // Get the form instance
    //       var $form = $(e.target);
          
    //       var formdata = $form.serialize();
    //       console.log(formdata);return false;
    //       // Get the BootstrapValidator instance
    //       var bv = $form.data('bootstrapValidator');
    //       // Use Ajax to submit form data
    //       $.post($form.attr('action'), $form.serialize(), function(result) {
    //           // ... Process the result ...
    //       }, 'json');
    //   });
});
</script>

@endsection