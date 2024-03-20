<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="g54.css" />
    <link rel="stylesheet" href="s54.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>





    <style>
        header {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
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
            color: #fff;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #f7ce68;
        }
        #pdfContent {
            display: none;
        }
        </style>

</head>
<body style="overflow-x: hidden;">

<?php
        // Start the session
        session_start();

        // Database connection
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'adminhr';

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if( isset($_GET['username']) && isset($_GET['userid'])) {
            
            $username = $_GET['username'];
            $userid = $_GET['userid'];
        }
        

            $userId = $userid;
        
            // Database connection
            $dbHost = 'localhost';
            $dbUser = 'root';
            $dbPass = '';
            $dbName = 'adminhr'; // Replace 'your_database_name' with your actual database name
        
            $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            // Prepare and execute a SQL query to fetch the basic salary for the logged-in user
            $sql = "SELECT basic_salary, house_rent FROM userinfo WHERE userid = '$userId'";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                // Fetch the basic salary from the result set
                $row = $result->fetch_assoc();
                $basicSalary = $row['basic_salary'];
                $houserent = $row['house_rent'];

        
        
                // Close the database connection
                $conn->close();
            } else {
                echo "No records found for the user.";
            }


        // Check if the user is logged in and retrieve the user ID
// Database connection
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'adminhr'; // Replace 'your_database_name' with your actual database name

// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query to count the number of "Present" days for the specified user
// SQL query to fetch present days from useratt table
// SQL query to fetch present days from useratt table for a specific userid
$sqlPresentDays = "SELECT COUNT(*) AS presentDays FROM useratt WHERE userid = '$userid' AND overall_att = 'Present'";

// Execute SQL query to fetch present days
$resultPresentDays = $conn->query($sqlPresentDays);

if ($resultPresentDays) {
    // Fetch the result of present days
    $rowPresentDays = $resultPresentDays->fetch_assoc();
    $presentDays = $rowPresentDays['presentDays'];
    
    // SQL query to fetch total no-of-days from hrleave table for Sick leave and Casual leave for a specific userid
    $sqlTotalSickDays = "SELECT SUM(`no-of-days`) AS totalSickDays FROM hrleave WHERE leaveType = 'Sick leave' AND employeeId = '$userid'";

    // Execute SQL query to fetch total sick days
    $resultTotalSickDays = $conn->query($sqlTotalSickDays);

    if ($resultTotalSickDays) {
        // Fetch the result of total sick days
        $rowTotalSickDays = $resultTotalSickDays->fetch_assoc();
        $totalSickDays = min($rowTotalSickDays['totalSickDays'], 4); // Limit to maximum of 4 days

        // SQL query to fetch total no-of-days from hrleave table for Casual leave for a specific userid
        $sqlTotalCasualDays = "SELECT SUM(`no-of-days`) AS totalCasualDays FROM hrleave WHERE leaveType = 'Casual leave' AND employeeId = '$userid'";

        // Execute SQL query to fetch total casual days
        $resultTotalCasualDays = $conn->query($sqlTotalCasualDays);

        if ($resultTotalCasualDays) {
            // Fetch the result of total casual days
            $rowTotalCasualDays = $resultTotalCasualDays->fetch_assoc();
            $totalCasualDays = min($rowTotalCasualDays['totalCasualDays'], 4); // Limit to maximum of 4 days

            // Add total sick days and total casual days to present days
            $presentDays += ($totalSickDays + $totalCasualDays);

            // Close the database connection
            $conn->close();
        } else {
            echo "Error executing the total casual days query: " . $conn->error;
        }
    } else {
        echo "Error executing the total sick days query: " . $conn->error;
    }
} else {
    echo "Error executing the present days query: " . $conn->error;
}



        $paidDays = $presentDays;

        // Check if paidDays is not zero to avoid division by zero error
        if ($paidDays !== 0) {
            // Calculate per-day salary rate
            $perDaySalary = $basicSalary / 30;
        
            // Calculate total amount
            $total = $perDaySalary * $paidDays;

            $total = intval($total);
        
        } else {
            echo "Error: Division by zero.";
        }

        // Calculate the basic salary
        // $bSalary = $perDaySalary;



    ?>

    
    
    <div class="desktop">
    <div class="div">
        <!-- <header style="position: relative;top: 0px;width: 1356px;left: 0px;height: 68px;font-family:'Inter';">
            <nav style="position: relative;width: 1200px">
                <div class="logo"style="position: relative;top: 0px;left: 8px">
                    <i class="fas fa-home"></i> Pay Slip</div>
                <ul>
                    <li><a href="../4 emp home/i4.php"style="position: relative;left: 136px;top:0px">Home</a></li>
                </ul>
            </nav>
        </header> -->


        <!-- <div class="overlap-group"> -->
            <div class="frame-2">
            <div class="frame-3">
            <div class="frame-4">
                <img class="mdi-required" src="https://c.animaapp.com/fjVUgr2k/img/mdi-required-1.svg" />
                <div class="text-wrapper">Employee pay summary</div>
            </div>

            <div class="text-wrapper-2">Pay period</div>
<div class="frame-6">
    <input type="month" class="text-wrapper-2" placeholder="" required onchange="calculateLossOfPayDays(this)" style="position:relative;left:0px;top:0px;font-size:10px;height:25px;"/>
</div>

                <div class="text-wrapper-3">Employee name</div>
                <div class="frame-5">
                    <input type="text" class="text-wrapper-3" placeholder="" required style="position:relative;left:0px;top:0px" value="<?php echo htmlspecialchars($username); ?>"/>
                </div>
                

            
                <div class="text-wrapper-4">Loss of pay days</div>
                    <div class="frame-7">
                    <input type="number" id="lossOfPayDays" class="text-wrapper-4" required style="position:relative;left:0px;top:0px"/>
                </div>


            <div class="text-wrapper-5">Pay Date</div>
                <div class="frame-8">
                    <input type="date" class="text-wrapper-4" placeholder="" required style="position:relative;left:0px;top:0px;font-size:12px;height:25px;"/>
                </div>

            <div class="text-wrapper-6">Employee ID</div>
                <div class="frame-9">
                    <input type="text" class="text-wrapper-6" placeholder="" required style="position:relative;left:0px;top:0px" value="<?php echo htmlspecialchars($userid); ?>"/>
                </div>

            <div class="text-wrapper-7">Paid days</div>
                <div class="frame-10">
                    <input type="number" class="text-wrapper-7" placeholder="" required style="position:relative;left:0px;top:0px" value="<?php echo htmlspecialchars($presentDays); ?>"/>
                </div>
            </div>


            <div class="frame-11">
            <div class="text-wrapper-8">Deductions</div>
            <div class="text-wrapper-9">Amount</div>
            <div class="text-wrapper-10">Income Tax</div>
            <div class="input-wrapper">
                <input type="number" id="incomeTaxInput" class="numeric-input" placeholder="" required style="position:relative;left:576px;top:90px;height:25px;width:117px;" />
        </div>
            <div class="text-wrapper-11">Provident Fund</div>
            <div class="input-wrapper">
                <input type="number" id="providentFundInput" class="numeric-input" placeholder="" required style="position:relative;left:576px;top:100px;height:25px;width:117px;" />
        </div>
            <div class="frame-12">
                <div class="frame-13">
                <div class="frame-14">
                    <img class="mdi-required-2" src="https://c.animaapp.com/fjVUgr2k/img/mdi-required-1.svg" />
                    <div class="text-wrapper">Income Details</div>
                </div>


                <div class="text-wrapper-12">Earnings</div>
                
                <div class="text-wrapper-13">Amount</div>


                <div class="text-wrapper-14">Basic Salary</div>
                    <div class="input-wrapper">
                    <input type="number" id="basicInput" class="numeric-input" placeholder="" required style="position:relative;left:194px;top:90px;height:25px;width:117px;" value="<?php echo htmlspecialchars($total); ?>" />
                </div>


                <div class="text-wrapper-15">House Rent Allowance</div>
                    <div class="input-wrapper">
                        <input type="number" id="hraInput" class="numeric-input" placeholder="" required style="position:relative;left:194px;top:100px;height:25px;width:117px;"value="<?php echo $houserent; ?>" />
                </div>



                <div class="text-wrapper-16">Gross Earnings</div>
                <div class="input-wrapper">
                    <input type="number" id="grossEarningsInput" readonly="" required class="numeric-input" placeholder="" style="position:relative;left:194px;top:128px;height:25px;width:117px;" />
            </div>
            </div>


            <div class="text-wrapper-17">Total Deduction</div>

            <div class="input-wrapper">
                <input type="number" id="totalDeductionInput" readonly="" required class="numeric-input" placeholder="" style="position:relative;left:576px;top:181px;height:25px;width:117px;" />
        </div>
            </div>

            <div class="frame-17">
            <div class="text-wrapper-18">Total Net Payable</div>
            <p class="p">(Gross Earnings - Total Deduction)</p>
            <img class="rupee-indian-2" src="https://c.animaapp.com/fjVUgr2k/img/rupee-indian-1@2x.png" />
            <div class="input-wrapper">
                <input type="number" id="totalPayableInput"  class="numeric-input" placeholder="" readonly="" required style="position:relative;left:360px;top:26px;height:30px;width:125px;background-color:#eaecfd;outline:none;border:none;font-size:20px;" />
        </div> 
            </div>
            <div id="pdfContent">
                Employee pay summary
                Pay period: <span id="payPeriodValue"></span>
                Employee name: <span id="employeeNameValue"></span>
                Loss of pay days: <span id="lossOfPayDaysValue"></span>
                Pay Date: <span id="payDateValue"></span>
                Employee ID: <span id="employeeIDValue"></span>
                Paid days: <span id="paidDaysValue"></span>
                Deductions:
                    - Income Tax: <span id="incomeTaxValue"></span>
                    - Provident Fund: <span id="providentFundValue"></span>
                Income Details:
                    - Basic: <span id="basicValue"></span>
                    - House Rent Allowance: <span id="hraValue"></span>
                Gross Earnings: <span id="grossEarningsValue"></span>
                Total Deduction: <span id="totalDeductionValue"></span>
                Total Net Payable: <span id="totalNetPayableValue"></span>
            </div>
            <div class="div-wrapper">
                <div class="text-wrapper-19" style="cursor:pointer;" onclick="generatePDF()">Generate</div>


            <div class="frame-18">
            <div class="text-wrapper-20">Payslip For the Month</div>
            <div class="text-wrapper-21" id="currentMonthYear"></div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <script>
        // JavaScript for calculating Gross Earnings
        document.addEventListener('input', function (event) {
            if (event.target.id === 'basicInput' || event.target.id === 'hraInput') {
                calculateGrossEarnings();
            }
        });

        function calculateGrossEarnings() {
            // Get values from input fields
            var basicValue = parseFloat(document.getElementById('basicInput').value) || 0;
            var hraValue = parseFloat(document.getElementById('hraInput').value) || 0;

            // Calculate Gross Earnings
            var grossEarnings = basicValue + hraValue;

            // Update the Gross Earnings input field
            document.getElementById('grossEarningsInput').value = grossEarnings;
        }
    </script>
    <script>
        // JavaScript for calculating Gross Earnings and Total Deduction
        document.addEventListener('input', function (event) {
            if (
                event.target.id === 'basicInput' ||
                event.target.id === 'hraInput' ||
                event.target.id === 'incomeTaxInput' ||
                event.target.id === 'providentFundInput'
            ) {
                calculateGrossEarnings();
                calculateTotalDeduction();
            }
        });

        function calculateGrossEarnings() {
            // Get values from input fields
            var basicValue = parseFloat(document.getElementById('basicInput').value) || 0;
            var hraValue = parseFloat(document.getElementById('hraInput').value) || 0;

            // Calculate Gross Earnings
            var grossEarnings = basicValue + hraValue;

            // Update the Gross Earnings input field
            document.getElementById('grossEarningsInput').value = grossEarnings;
        }

        function calculateTotalDeduction() {
            // Get values from input fields
            var incomeTaxValue = parseFloat(document.getElementById('incomeTaxInput').value) || 0;
            var providentFundValue = parseFloat(document.getElementById('providentFundInput').value) || 0;

            // Calculate Total Deduction
            var totalDeduction = incomeTaxValue + providentFundValue;

            // Update the Total Deduction input field
            document.getElementById('totalDeductionInput').value = totalDeduction;
        }
    </script>

    <script>
        // JavaScript for calculating Gross Earnings, Total Deduction, and Total Payable
        document.addEventListener('input', function (event) {
            if (
                event.target.id === 'basicInput' ||
                event.target.id === 'hraInput' ||
                event.target.id === 'incomeTaxInput' ||
                event.target.id === 'providentFundInput'
            ) {
                calculateGrossEarnings();
                calculateTotalDeduction();
                calculateTotalPayable();
            }
        });

        function calculateGrossEarnings() {
            // Get values from input fields
            var basicValue = parseFloat(document.getElementById('basicInput').value) || 0;
            var hraValue = parseFloat(document.getElementById('hraInput').value) || 0;

            // Calculate Gross Earnings
            var grossEarnings = basicValue + hraValue;

            // Update the Gross Earnings input field
            document.getElementById('grossEarningsInput').value = grossEarnings;
        }

        function calculateTotalDeduction() {
            // Get values from input fields
            var incomeTaxValue = parseFloat(document.getElementById('incomeTaxInput').value) || 0;
            var providentFundValue = parseFloat(document.getElementById('providentFundInput').value) || 0;

            // Calculate Total Deduction
            var totalDeduction = incomeTaxValue + providentFundValue;

            // Update the Total Deduction input field
            document.getElementById('totalDeductionInput').value = totalDeduction;
        }

        function calculateTotalPayable() {
            // Get values from input fields
            var grossEarnings = parseFloat(document.getElementById('grossEarningsInput').value) || 0;
            var totalDeduction = parseFloat(document.getElementById('totalDeductionInput').value) || 0;

            // Calculate Total Payable
            var totalPayable = grossEarnings - totalDeduction;

            // Update the Total Payable input field
            document.getElementById('totalPayableInput').value = totalPayable;
        }
    </script>
    <script>
        function generatePDF() {
            // Specify the content you want to capture (entire web page)
            var contentToCapture = document.body;
        
            // Use html2pdf to generate the PDF
            html2pdf(contentToCapture, {
                margin: 0, // Set margins to zero
                filename: 'pay_slip.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak: { mode: 'avoid-all' },
                onbeforestart: function (element, pdf) {
                    // Adjust the scale to fit the content on the A4 sheet
                    var scaleFactor = pdf.internal.pageSize.width / element.width;
                    pdf.internal.scaleFactor = scaleFactor;
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Retrieve username and userid from session storage
            var generatedUsername = sessionStorage.getItem('generatedUsername');
            var generatedUserId = sessionStorage.getItem('generatedUserId');
        
            // Now you can use generatedUsername and generatedUserId as needed
            console.log('Generated Username:', generatedUsername);
            console.log('Generated UserID:', generatedUserId);
        
            // Clear session storage after use (optional)
            sessionStorage.removeItem('generatedUsername');
            sessionStorage.removeItem('generatedUserId');
        });
        </script>

        <script>
            function updateMonthAndYear() {
              // Create an array of month names
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
        
              // Get the current date
            const currentDate = new Date();
        
              // Get the month and year
            const currentMonth = monthNames[currentDate.getMonth()];
            const currentYear = currentDate.getFullYear();
        
              // Update the content of the div
            const textWrapper = document.getElementById("currentMonthYear");
            textWrapper.textContent = `${currentMonth} ${currentYear}`;
            }
        
            // Call the function initially to set the initial content
            updateMonthAndYear();
        
            // Set up an interval to update the content every minute (adjust as needed)
            setInterval(updateMonthAndYear, 60000); // Update every minute
        </script>



<script>
    function calculateLossOfPayDays(monthInput) {
        console.log('calculateLossOfPayDays function called');
        // Get the selected month from the input field
        var selectedMonth = new Date(monthInput.value);
        // Get the year and month separately
        var year = selectedMonth.getFullYear();
        var month = selectedMonth.getMonth() + 1; // JavaScript months are 0-based
        
        // Get the number of days in the selected month
        var daysInMonth = new Date(year, month, 0).getDate();

        // Get the number of present days (replace this with your actual present days calculation)
        var presentDays = <?php echo $presentDays; ?>; // Assuming $presentDays is available

        // Calculate the loss of pay days
        var lossOfPayDays = daysInMonth - presentDays;

        // Update the loss of pay days input field
        document.getElementById('lossOfPayDays').value = lossOfPayDays;
    }
</script>
        
    
    
</body>
</html>
