<div class="row justify-content-center">
    <div class="card" style="background: none; border:none">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Registration Form</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="http://localhost/tisu/<?=$type==1?'student':'teacher'?>" class="btn btn-sm btn-warning">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <div class="col-md-4">
                    <div class="mb-3 d-none">
                        <label for="user_type" class="form-label">User</label>
                        <select name="user_type" id="user_type" class="form-select" aria-readonly="true">
                            <option value="0">Select</option>
                            <option value="1" <?= $type==1?'selected':'' ?>>Student</option>
                            <option value="2" <?= $type==2?'selected':'' ?>>Teacher</option>
                        </select>
                    </div>
                    <div class="mb-3 d-none">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="123456" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                </div>
            </form>
            <div class="row text-center text-danger mt-5">
                <p><b>*The following user will have default password:123456</b></p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
<script>
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
        console.log(isValid)
        // Validate user type
        var userType = $('#user_type').val();
        if (userType === '0') {
            isValid = false;
            $('#user_type').after('<div class="error-message text-danger">Please select a user type.</div>');
        }

        // Validate password
        var password = $('#password').val();
        console.log(password)

        if (password == '') {
            isValid = false;
            $('#password').after('<div class="error-message text-danger">Password is required.</div>');
        } else if (password.length < 5) {
            isValid = false;
            $('#password').after('<div class="error-message text-danger">Password must be at least 6 characters long.</div>');
        }

        // Validate confirm password
        // If all fields are valid, submit the form
        if (isValid) {
            // You can proceed to submit the form or perform an AJAX call here
            console.log('Form is valid, proceeding with submission...');
            register_new_user();
            // Uncomment below to submit form normally
            // this.submit();
        }
    });
    function validateEmail(email) {
        var re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return re.test(String(email).toLowerCase());
    }
    function register_new_user(){
        var form_data  = $('#registrationForm').serializeArray();
        var email = $('#email').val().trim();
        var data = {};
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
                    });
                }
            }
        });
    } 
</script>