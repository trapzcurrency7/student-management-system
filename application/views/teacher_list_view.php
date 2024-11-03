<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Teachers</h4> 
                </div>
                <div class="col-md-6 text-end">
                    <a class="btn btn-sm btn-warning" href="http://localhost/tisu/register/2">Add Teacher</a> 
                </div>
            </div>

        </div>
        <div class="card-body">
            <table class="table" id="attendance">
                <thead>
                    <tr>
                        <th>Srno</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    foreach($data as $row){
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$row['first_name'].' '.$row['last_name']?></td>
                            <td><?=$row['email']?></td>
                            <td><a href="javascript:void(0)" class="btn btn-sm btn-danger text-white delete_attendance" onclick="delete_user(<?=$row['user_id']?>)">Delete</a> </td>
                        </tr>
                        <?php
                    $i++;

                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>

    $(document).ready(function(){
        student_attendance();
    })
    $('.teacher').addClass('active')
    function student_attendance(){
        let table = new DataTable('#attendance');

    }
    function delete_user(user_id){
        $.ajax({
            url:'http://localhost/tisu/delete_user',
            data:{
                user_id:user_id
            },
            type: 'POST',
            success: function(response){
                response = JSON.parse(response);
                if(response.status){
                    location.reload();
                }
            }
        })
    }
</script>