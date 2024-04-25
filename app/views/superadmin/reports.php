<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/reports.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <title>Reports</title>
</head>
<body>
  <?php require APPROOT . '/views/superadmin/nav.php';?>
  <!-- number of times user login per day for the past month
  total login time for each day -->
  <div class="selection-bar" style="justify-content:space-evenly;">
    <div class="selection" id="userOverviewBtn">
      <div class="topic">
        <h3>User Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Line chart of last month user registration</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Number of currently registered users</span>
    </div>
    <div class="selection" id="loginOverviewBtn">
      <div class="topic">
        <h3>Login/Logout Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Number of times user login per day for the past month</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Total login time for each day</span>
    </div>
  </div>

  <div class="report">
    <h2>Click the report you want</h2>
    <!-- <?php var_dump($data['totalLoggedInTime']);?> -->
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
  // Function to generate User Overview report content
  function generateUserOverviewReport() {
    const reportContent = `
    <div class="report-item">
      <h4>Last Month User Registration</h4>
      <canvas id="userChart1" style="width:100%; height:500px"></canvas>
    </div>
    <div class="report-item">
      <h4>Current registered Users</h4>
      <div class="sub-item">
        <div class="table-container">
            <table>
                <tr>
                    <th>User</th>
                    <th>Users in the system</th> 
                </tr>
                <tr>
                    <td>Customers</td>
                    <td><?php echo json_encode($data['countCustomers']);?></td>
                </tr>
                <tr>
                    <td>Publishers</td>
                    <td><?php echo json_encode($data['countPublishers']);?></td>
                </tr>
                <tr>
                    <td>Charity</td>
                    <td><?php echo json_encode($data['countCharity']);?></td>
                </tr>
            </table>
        </div>
        <div class="chart-container">
            <canvas id="userChart2"></canvas>
        </div>
      </div>
    </div>
    `;
    document.querySelector(".report").innerHTML = reportContent;
    
    document.getElementById("userOverviewBtn").style.backgroundColor = "#71CFB6";
    document.getElementById("loginOverviewBtn").style.backgroundColor = "white";
    // document.getElementById("bookOverviewBtn").style.backgroundColor = "white";
    
    const xValues = <?php echo json_encode($data['Userlabels']); ?>;
    const yValues = <?php echo json_encode($data['Userdata']); ?>;
    const customers = <?php echo json_encode($data['countCustomers']);?>;
    const publishers = <?php echo json_encode($data['countPublishers']);?>;
    const charity = <?php echo json_encode($data['countCharity']);?>;
 
    new Chart("userChart1", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          label:'Number of Users',
          borderColor: "black",
          data: yValues,
          fill: false,
        }]
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      } 
    });

    new Chart("userChart2", {
      type: "bar",
      data: {
        labels: ['Customers','Publishers', 'Charity Organizations'],
        datasets: [{
          backgroundColor:['#A1E998','#C9F383','#F9F871'],
          borderColor: "rgba(0,0,255,0.1)",
          fill:false,
          data: [customers,publishers,charity],
          fill: false
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
      }
    });
  }

  function generateLoginLogoutOverview(){
    const reportContent = `
    <div class="report-item">
      <h4>Number of times user login per day for the past month</h4>
      <canvas id="loginlogoutChart1" style="width:100%; height:500px"></canvas>
    </div>
    <div class="report-item">
      <h4>Current registered Users</h4>
      <div class="sub-item">
        <div class="table-container">
            <table>
                <tr>
                    <th>Login Date</th>
                    <th>Total Logged in Time</th> 
                </tr>
                <?php foreach($data['totalLoggedInTime'] as $loggingRecord): ?>
                <tr>
                    <td><?php echo json_encode($loggingRecord->login_date);?></td>
                    <td><?php echo json_encode($loggingRecord->total_logged_in_minutes);?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
      </div>
    </div>
    `;
    document.querySelector(".report").innerHTML = reportContent;
    
    document.getElementById("userOverviewBtn").style.backgroundColor = "white";
    document.getElementById("loginOverviewBtn").style.backgroundColor = "#71CFB6";
    // document.getElementById("bookOverviewBtn").style.backgroundColor = "white";
    
    const x1Values = <?php echo json_encode($data['loginlabels']); ?>;
    const y1Values = <?php echo json_encode($data['logindata']); ?>;
    const y2Values = <?php echo json_encode($data['logoutdata']); ?>;
    const customers = <?php echo json_encode($data['countCustomers']);?>;
    const publishers = <?php echo json_encode($data['countPublishers']);?>;
    const charity = <?php echo json_encode($data['countCharity']);?>;
 
    new Chart("loginlogoutChart1", {
      type: "line",
      data: {
        labels: x1Values,
        datasets: [{
          label:'Number of logins',
          borderColor: "black",
          data: y1Values,
          fill:false
        },
        {
          label:'Number of logouts',
          borderColor: "red",
          data: y2Values,
          fill:false
        }
      
      ]
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      } 
    });

    new Chart("userChart2", {
      type: "bar",
      data: {
        labels: ['Customers','Publishers', 'Charity Organizations'],
        datasets: [{
          backgroundColor:['#A1E998','#C9F383','#F9F871'],
          borderColor: "rgba(0,0,255,0.1)",
          fill:false,
          data: [customers,publishers,charity]
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
      }
    });
  }

  document.querySelector("#userOverviewBtn").addEventListener("click", generateUserOverviewReport);
  document.querySelector("#loginOverviewBtn").addEventListener("click", generateLoginLogoutOverview);
});


  </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const generateReportButtons = document.querySelectorAll(".topic span");

    generateReportButtons.forEach(button => {
      button.addEventListener("click", function() {
        // Select the report div to be converted to PDF
        const reportDiv = document.querySelector(".report");

        // Set the options for PDF generation
        const options = {
          filename: 'report.pdf',
          image: { type: 'jpeg', quality: 0.98 },
          html2canvas: { scale: 3 },
          jsPDF: { unit: 'in', format: 'A3', orientation: 'portrait' }
        };

        // Use html2pdf.js to generate PDF from report div
        html2pdf().from(reportDiv).set(options).save();
      });
    });
  });

  </script>

</body>
</html>