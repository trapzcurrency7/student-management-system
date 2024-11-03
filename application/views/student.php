<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-1 p-0">
        <div class="row">
            <div class="card"style="background: none; border:none">
                <div class="card-header">
                <b>Welcome, <?=$this->session->userdata('user_name')?></b>
            </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Present</h5>
                                    <p class="card-text">Total (<?=$present?>)</p>
                                    <a href="http://localhost/tisu/attendance" class="btn btn-primary">Go to attendance</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Absent</h5>
                                    <p class="card-text">Total (<?=$absent?>).</p>
                                    <a href="http://localhost/tisu/attendance" class="btn btn-primary">Go to attendance</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">All attendance</h5>
                                    <p class="card-text">Total (<?=$all?>).</p>
                                    <a href="http://localhost/tisu/attendance" class="btn btn-primary">Go to attendance</a>
                                </div>
                            </div>
                        </div>
                        <?php
                            if($this->session->userdata('type')!='1'){
                                ?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">All Student</h5>
                                            <p class="card-text">Total (<?=$student_count?>).</p>
                                            <a href="http://localhost/tisu/student" class="btn btn-primary">Go to Student</a>
                                        </div>
                                    </div>
                                </div>
                            
                            <?php
                            }
                            if($this->session->userdata('type')!='1' && $this->session->userdata('type')!='2'){
                                ?>
                                <div class="col-md-3 mt-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">All Teacher</h5>
                                            <p class="card-text">Total (<?=$teacher_count?>).</p>
                                            <a href="http://localhost/tisu/teacher" class="btn btn-primary">Go to Student</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
     $('.dashboard').addClass('active')
</script>
