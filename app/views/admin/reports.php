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
  <?php require APPROOT . '/views/admin/nav.php';?>

  <div class="selection-bar">
    <div class="selection">
      <div class="topic" id="userOverviewBtn">
        <h3>User Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Line chart of last month user registration</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Number of currently registered users</span>
    </div>
    <div class="selection">
      <div class="topic" id="orderOverviewBtn">
        <h3>Order Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Line chart of last month orders</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Number of delivered, pending, processing orders</span>
    </div>
    <div class="selection">
      <div class="topic" id="bookOverviewBtn">
        <h3>Books Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Line chart of last month books</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Number of current books in the system and book categories</span>
    </div>
  </div>

  <div class="report">
    
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
  // Function to generate User Overview report content
  function generateUserOverviewReport() {
    const reportContent = `
    <div class="report-item">
      <h4>Last Month User Registration</h4>
      <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
    </div>
    <div class="report-item">
      <h4>Current registered Users</h4>
      <table>
        <tr>
          <th>User</th>
          <th>Users in the system</th> 
        </tr>
        <tr>
          <td>Cutomers</td>
          <td>15</td>
        </tr>
        <tr>
          <td>Publishers</td>
          <td>15</td>
        </tr>
        <tr>
          <td>Charity</td>
          <td>15</td>
        </tr>
      </table>
    </div>
    `;
    document.querySelector(".report").innerHTML = reportContent;
    // document.getElementById("userOverviewBtn").style.backgroundColor = "yellow";

    const xValues = [50,60,70,80,90,100,110,120,130,140,150];
    const yValues = [7,8,8,9,9,9,10,11,14,14,15];

    new Chart("myChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        }]
      },
      
    });
  }

  // Function to generate Order Overview report content
  function generateOrderOverviewReport() {
    const reportContent = `
      <div class="report-item">
        <p>Hi</p>
      </div>
      <div class="report-item">
        <p>Order Overview report content goes here<p>
      </div>
    `;
    document.querySelector(".report").innerHTML = reportContent;

  }

  // Function to generate Book Overview report content
  function generateBookOverviewReport() {
    const reportContent = `
      <div class="report-item">
        <p>Book Overview report content goes here<p>
      </div>
      <div class="report-item">
        <p>Book Overview report content goes here<p>
      </div>
    `;
    document.querySelector(".report").innerHTML = reportContent;
  }

  // Add event listeners to the "Generate Report" buttons of each overview section
  document.querySelector("#userOverviewBtn").addEventListener("click", generateUserOverviewReport);
  document.querySelector("#orderOverviewBtn").addEventListener("click", generateOrderOverviewReport);
  document.querySelector("#bookOverviewBtn").addEventListener("click", generateBookOverviewReport);
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
          html2canvas: { scale: 10 },
          jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        // Use html2pdf.js to generate PDF from report div
        html2pdf().from(reportDiv).set(options).save();
      });
    });
  });

  </script>

</body>
</html>
