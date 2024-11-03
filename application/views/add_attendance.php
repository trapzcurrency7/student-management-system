<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Add Attendance</h4> 
                </div>
                <div class="col-md-6 text-end">
                    <a class="btn btn-sm btn-warning" href="http://localhost/tisu/attendance">Back</a> 
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="attendance_data">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Date</label>
                        <input type="date" class="form-control" name="date" id="date">
                    </div>
                    <div class="col-md-6">
                        <label for="">Select attendance</label>
                        <select name="attendance_type" class="form-control" id="attendance_type">
                            <option value="0">Select</option>
                            <option value="Present" >Present</option>
                            <option value="Absent">Absent</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="row mt-5 justify-content-center">
                <div class="col-md-2">
                    <a href="javascript:void(0)" class="btn btn-primary save_attendance">Submit</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
     $('.attendance').addClass('active')
     $(document).ready(function(){
        $('.save_attendance').on('click', function(){
            save_attendance();
        });
     })

     function save_attendance(){
        var form_data = $('#attendance_data').serializeArray();
        var data = {};
        var error = [];
        $.each(form_data,function(key,value){
            data[value.name] = value.value;
            if(value.name =='date' && value.value==''){
                error.push('Please enter date');
            }
            if(value.name=='attendance_type' && value.value=='0'){
                error.push('Please select attendance');
            }
        })
        if(error.length>0){
            alert(error)
        }else{

            $.ajax({
                url:'http://localhost/tisu/save_attendance',
                data:{
                    data
                },
                type: 'POST',
                success: function(response){
                    response = JSON.parse(response);
                    if(response.status){
                        window.location.href = 'http://localhost/tisu/attendance';
                    }
                }
            });
        }

     }
</script>