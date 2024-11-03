<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		/* File: styles.css */
body {
    background-color: #f8f9fa;
}

.card {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-title {
    margin-bottom: 20px;
}

	</style>
</head>
<body>
    <div class="container mt-5 login_form">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>
                        <form id="login-form" action="http://localhost/tisu/validation" method="POST">
                            <div class="mb-3">
                                <label for="username_login" class="form-label">Email</label>
                                <input type="text" class="form-control" id="username_login" name="username_login" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_login" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password_login" name="password_login" required>
                            </div>
                            <a id="login_validation" class="btn btn-primary w-100">Login</a>
                            <button hidden type="submit" class="btn btn-primary w-100 login">Login</button>
                            <button type="" class="btn btn-primary w-100 mt-2 reg_form">Register New User?</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="container registrationForm mt-5">
        <div class="row justify-content-center">
            <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Registration Form</h2>
                        <form class="mt-4" id="registrationForm" method="POST">
                            <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="f_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="f_name" name="f_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="l_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="l_name" name="l_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Register</button>
                                <button type="" class="btn btn-primary sign_in">Sign In?</button>

                                <div id="response" class="mt-3"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="user_type" class="form-label">User</label>
                                    <select name="user_type" id="user_type" class="form-select">
                                        <option value="0">Select</option>
                                        <option value="1">Student</option>
                                        <option value="2">Teacher</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="scripts.js"></script> -->
</body>
</html>
<script>
$('.registrationForm').hide();
$('.login_form').show();
	// File: scripts.js
$(document).ready(function() {
   
    $('.reg_form').on('click',function(){
        $('.registrationForm').show();
        $('.login_form').hide();
    })
    $('.sign_in').on('click',function(){
        $('.registrationForm').hide();
        $('.login_form').show();
    })
    $('#login_validation').on('click',function(){
        var form_data = $('#login-form').serializeArray();
        var isValid = true; // Flag to track validation

        // Reset previous error messages
        $('.error-message').remove();

        // Validate each field
        form_data.forEach(function(item) {
            if (!item.value) {
                isValid = false;
                $('#' + item.name).after('<div class="error-message text-danger">This field is required.</div>');
            } else if (item.name === 'email' && !validateEmail(item.value)) {
                isValid = false;
                $('#' + item.name).after('<div class="error-message text-danger">Invalid email format.</div>');
            }
            // Add more validation rules as needed
        });

        // If all fields are valid, submit the form
        if (isValid) {
            console.log('Form is valid, proceeding with submission...');
            $('.login').click();
          
        }
        console.log(form_data);
    });
    $('#registrationForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var isValid = true; // Flag to track validation
        $('.error-message').remove(); // Remove previous error messages

        // Validate username

        // Validate email
        var email = $('#email').val().trim();
        if (email === '') {
            isValid = false;
            $('#email').after('<div class="error-message text-danger">Email is required.</div>');
        } else if (!validateEmail(email)) {
            isValid = false;
            $('#email').after('<div class="error-message text-danger">Invalid email format.</div>');
        }

        // Validate user type
        var userType = $('#user_type').val();
        if (userType === '0') {
            isValid = false;
            $('#user_type').after('<div class="error-message text-danger">Please select a user type.</div>');
        }

        // Validate password
        var password = $('#password').val();
        if (password === '') {
            isValid = false;
            $('#password').after('<div class="error-message text-danger">Password is required.</div>');
        } else if (password.length < 6) {
            isValid = false;
            $('#password').after('<div class="error-message text-danger">Password must be at least 6 characters long.</div>');
        }

        // Validate confirm password
        var confirmPassword = $('#confirm_password').val();
        if (confirmPassword !== password) {
            isValid = false;
            $('#confirm_password').after('<div class="error-message text-danger">Passwords do not match.</div>');
        }

        // If all fields are valid, submit the form
        if (isValid) {
            // You can proceed to submit the form or perform an AJAX call here
            console.log('Form is valid, proceeding with submission...');
            register_new_user();
            // Uncomment below to submit form normally
            // this.submit();
        }
    });
    
});
    function validateEmail(email) {
        var re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return re.test(String(email).toLowerCase());
    }
    function register_new_user(){
        var form_data  = $('#registrationForm').serializeArray();
        var data = {};
        var email = $('#email').val().trim();
        $.each(form_data,function(i,row){
            
            data[row.name] = row.value;
        })

        $.ajax({
            url:'http://localhost/tisu/check_email_exist',
            data:{
                email:email
            },
            type: 'POST',
            success: function(response){
                response = JSON.parse(response);
                if(response.status==false){
                    alert('Email already exists');
                }else{
                    $.ajax({
                        url:'http://localhost/tisu/registration',
                        type:'POST',
                        data:{
                            data
                        },
                        success:function(response){
                            response  = JSON.parse(response);
                            if(response.status){
                                alert('Successfully Registered');
                                location.reload();
                            }else{
                                alert('Something went wrong');
                            }
                        }
                    })
                }
            }
        });
    }   
</script>

  