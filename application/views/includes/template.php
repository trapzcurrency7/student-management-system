<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #f8f9fa;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        body{
            background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            object-fit: contain;
            background-position: center center;
        }

    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column p-3" style="opacity: 0.7">
        <h4><?= $this->session->userdata('user_name')?></h4>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link dashboard" href="http://localhost/tisu/dashbaord">Home</a>
            </li>
            <li>
                <a class="nav-link profile" href="http://localhost/tisu/profile">Profile</a>
            </li>
            <li>
                <a class="nav-link attendance" href="http://localhost/tisu/attendance">Attendance</a>
            </li>
            <?php
                if($this->session->userdata('type')!='1'){
                    ?>
                <li>
                    <a class="nav-link student" href="http://localhost/tisu/student">Student</a>
                </li>
                <?php
                    }
                ?>
                <?php
                if($this->session->userdata('type')!='1' and $this->session->userdata('type')!='2'){
                    ?>
                <li>
                    <a class="nav-link teacher" href="http://localhost/tisu/teacher">Teacher</a>
                </li>
                <?php
                    }
                ?>
            <li>
                <a class="nav-link" href="http://localhost/tisu/logout">Logout</a>
            </li>
        </ul>
    </div>
    <div class="content pt-0 pr-0 m-0">
        <?php
    //     $var = 
    // print_r($view);
    // exit;
            $this->load->view($view,$data);
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
