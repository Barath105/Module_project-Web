<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>
    <link rel="stylesheet" href="s23.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome.min.css">
    <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">
</head>
<style>
        header {
            background:linear-gradient(45deg, #a3acf8, #c9cef5);
            color: black;
            padding: 20px 0;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        nav .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        nav ul {
            list-style: none;
            display: flex;
        }
        
        nav ul li {
            margin-right: 20px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: black;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #f7ce68;
        }
        img {
            max-width: 100%;
            width: 100px;
            height: auto;
            position: absolute;
            top: -10px;
            left: 40px;
        }
        .logo-1 {
    position: relative;
    
}

.logo-1 img {
    position: absolute; 
    top: 0; 
    left: 28%; 
    max-width: 100%; 
    width:600px;
    height: auto;
    opacity: 0.2;
    
}



        
    </style>
    <body>
    <header style="position: relative;top:0%;width: 100%;left: 0%;height: 75px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: 2px;left:122px">
                <i class=""></i> History</div>
            <ul>
                <li><a href="../4 emp home/i4.php"style="position: relative;left: 136px;top:0px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">



    <div class="button-group">
    <a href="../15 leave/i15.php">
        <button id="applyBtn" style="width: 106px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" fdprocessedid="edr5qqp">Apply</button>
    </a>
    <a href="../22 leave pending/i22.php">
        <button id="pendingBtn" style="width: 106px;" fdprocessedid="3ngugx">Pending</button>
        </a>
        <button id="historyBtn" style="width: 106px;" fdprocessedid="7nfh6h">History</button>
    </div>

     <div class="logo-1">
    <img src="logo.png">
    </div>
    <?php
        session_start();
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'adminhr';

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = $_SESSION["userid"];
        $sql = "SELECT * FROM hrleave WHERE employeeId = '$id' AND status='Approved' OR status = 'Rejected' ";
        $result = $conn->query($sql);
        $serialNumber =  1; 

        ?>

        
    <table id="data-table">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Title</th>
                    <th>Leave Type</th>
                    <th>Req_date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>No.of days</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        $title = $row['title'];
                        $leaveType = $row['leaveType'];
                        $req_date = $row['req_date'];
                        $startDate = $row['startDate'];
                        $endDate = $row['endDate'];
                        $days=$row['no-of-days'];
                        $reason = $row['reason'];
                        $status = $row['status'];

                        echo '<tr>';
                        echo '<td>' . $serialNumber . '</td>';
                        echo '<td>' . $title . '</td>';
                        echo '<td>' . $leaveType . '</td>';
                        echo '<td>' . $req_date . '</td>';
                        echo '<td>' . $startDate . '</td>';
                        echo '<td>' . $endDate . '</td>';
                        echo '<td>' . $days . '</td>';
                        echo '<td>' . $reason . '</td>';
                        echo '<td style="color: ' . ($status == 'Approved' ? 'green' : ($status == 'Rejected' ? 'red' : '')) . ';">' . $status . '</td>';
                        echo '</tr>';
                        $serialNumber++;
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align: center;'>No data found</td></tr>";

                }
                $conn->close();
                ?>
            </tbody>
        </table>



        <script>
            document.getElementById("applyBtn").addEventListener("click", function () {
            updateButtonColors(this);
            
        });
        
        document.getElementById("pendingBtn").addEventListener("click", function () {
            updateButtonColors(this);
            
        });
        
        document.getElementById("historyBtn").addEventListener("click", function () {
            updateButtonColors(this);
            
        });

        window.addEventListener("load", function () {
            var applyBtn = document.getElementById("historyBtn");
            applyBtn.style.backgroundColor = "skyblue";
        });
        
        function updateButtonColors(clickedButton) {
            const buttons = document.querySelectorAll(".button-group button");
        
            buttons.forEach(function (button) {
                if (button === clickedButton) {
                    button.style.backgroundColor = "skyblue"; 
                } else {
                    button.style.backgroundColor = "";
                }
            });
        }
            </script>
    </body>
</html>