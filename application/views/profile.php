<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .profile-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #007bff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
        margin: 0 auto;
        border: 2px solid #0056b3;
    }

.initials {
    display: none; /* Hide initials by default */
}

.profile-image img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class='card-body text-center'>
            <div class="profile">
                <div class="profile-image" id="profile-image">
                    <span class="initials" id="initials"></span>
                </div>
                <h3 id="username"><?=$this->session->userdata('user_name')?></h3>
                <p id="email_d"><?=$this->session->userdata('email')?></p>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <label for="" class="">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= $this->session->userdata('first_name')?>" id="first_name">
                        <input type="text" name="user_id" class="form-control d-none" value="<?= $this->session->userdata('user_id')?>" id="user_id">
                        <label for=""  class="mt-3">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= $this->session->userdata('last_name')?>" id="last_name">
                        <label for=""  class="mt-3">Email</label>
                        <input type="text" name="email" class="form-control" value="<?= $this->session->userdata('email')?>" id="email">
                        <label for=""  class="mt-3">Password</label>
                        <input type="text" name="password" class="form-control" value="<?= $this->session->userdata('password')?>" id="password">
                    </div>
                </div>
            </form>
            <div class="row justify-content-center mt-3">
                <div class="col-md-2">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="update_profile(<?=$this->session->userdata('user_id')?>)">Submit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
<script>
    $(document).ready(function() {
    const username = $('#username').text();
    const initials = username.split(' ').map(name => name.charAt(0)).join('').toUpperCase();
    
    $('#initials').text(initials).show();
    
    // Example to set a user image URL (or leave it empty to show initials)
    const userImageUrl = ''; // Add image URL here or leave it empty
    
    if (userImageUrl) {
        $('#profile-image').html(`<img src="${userImageUrl}" alt="Profile Image">`);
        $('#initials').hide(); // Hide initials if image exists
    }
    $('.profile').addClass('active')
});

function update_profile(user_id){
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var password = $('#password').val();
    // var user_id = $('#user_id').val();
    var error = 0;
    if(first_name==''){
        alert('Please enter first name');
        error = 1;
    }
    if(last_name==''){
        alert('Please enter last name');
        error = 1;

    }
    if(email==''){
        alert('Please enter email');
        error = 1;
    }
    if(password==''){
        alert('Please enter password');
        error = 1;

    }else{
        if(password.length<5){
            alert('Please enter 6 digit of password');
            error = 1;
        }
    }

    console.log(error);
    if(error==1){
       
    }else{
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
                        url:'http://localhost/tisu/edit_user',
                        data:{
                            first_name:first_name,
                            last_name:last_name,
                            email:email,
                            password:password,
                            user_id:user_id
                        },
                        type: 'POST',
                        success: function(response){
                            response = JSON.parse(response);
                            if(response.status){
                                location.reload();
                            }
                        }
                    });
                }
            }
        });
        
    }
}
// function check_email_exist(email){
//     $.ajax({
//         url:'http://localhost/tisu/check_email_exist',
//         data:{
//             email:email
//         },
//         type: 'POST',
//         success: function(response){
//             response = JSON.parse(response);
//             console.log(response)
//             return response.status
//         }
//     });
// }
</script>