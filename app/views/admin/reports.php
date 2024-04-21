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
    <div class="selection" id="userOverviewBtn">
      <div class="topic">
        <h3>User Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Line chart of last month user registration</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Number of currently registered users</span>
    </div>
    <div class="selection" id="orderOverviewBtn">
      <div class="topic">
        <h3>Order Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Line chart of last month orders</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Number of delivered, pending, processing orders</span>
    </div>
    <div class="selection" id="bookOverviewBtn">
      <div class="topic">
        <h3>Books Overview</h3>
        <span>Generate Report<i class="fa fa-solid fa-file"></i></span>
      </div>
      <i class="fa fa-solid fa-circle"></i><span>Line chart of last month books</span><br>
      <i class="fa fa-solid fa-circle"></i><span>Number of current books in the system and book categories</span>
    </div>
  </div>

  <div class="report">
    <h1>Click the report you want</h1>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
  // Function to generate User Overview report content
  function generateUserOverviewReport() {
    const reportContent = `
    <div class="report-item">
      <h4>Last Month User Registration</h4>
      <canvas id="userChart1" style="width:100%;"></canvas>
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
    document.getElementById("orderOverviewBtn").style.backgroundColor = "white";
    document.getElementById("bookOverviewBtn").style.backgroundColor = "white";
    
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
          data: yValues
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

  // Function to generate Order Overview report content
  function generateOrderOverviewReport() {
    const reportContent = `
      <div class="report-item">
        <h4>This Month number of order received</h4>
        <canvas id="orderChart1" style="width:100%;height=100%;max-height:500px"></canvas>
      </div>
      <div class="report-item">
        <h4>Total Number of Delivered, Processing, Pending and Caceled Orders</h4>
        <div class="sub-item">
          <div class="table-container">
            <table>
                <tr>
                    <th>Status</th>
                    <th>Count</th> 
                </tr>
                <tr>
                  <?php foreach($data['countOrderStatus'] as $order):?>
                  <td><?php echo $order->status;?></td>
                  <td><?php echo $order->count;?></td>
                </tr>
                <?php endforeach;?>
            </table>
          </div>
          <div class="chart-container">
            <canvas id="orderChart2"></canvas>
          </div>
        </div>

      </div>
    `;
    document.querySelector(".report").innerHTML = reportContent;
    document.getElementById("orderOverviewBtn").style.backgroundColor = "#71CFB6";
    document.getElementById("userOverviewBtn").style.backgroundColor = "white";
    document.getElementById("bookOverviewBtn").style.backgroundColor = "white";

    const xValues = <?php echo json_encode($data['Orderlabels']); ?>;
    const yValues = <?php echo json_encode($data['Orderdata']); ?>;

    new Chart("orderChart1", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          label: 'Number Of Orders',
          borderColor: "black",
          fill:false,
          data: yValues
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

    new Chart("orderChart2", {
      type: "bar",
      data: {
        labels: [<?php foreach($data['countOrderStatus'] as $status): ?>"<?php echo $status->status; ?>",<?php endforeach;?>],
        datasets: [{
          backgroundColor:['#A1E998','#C9F383','#F9F871','#4EACC3'],
          borderColor: "rgba(0,0,255,0.1)",
          data: [<?php foreach($data['countOrderStatus'] as $status): ?><?php echo $status->count; ?>,<?php endforeach;?>]
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

  // Function to generate Book Overview report content
  function generateBookOverviewReport() {
    const reportContent = `
      <div class="report-item">
        <h4>This Month number of Books received</h4>
        <canvas id="bookChart1" style="width:100%;height=100%;max-height:500px"></canvas>
      </div>
      <div class="report-item">
        <h4>Number of Books Sold Based on Book Categories</h4>
        <div class="sub-item">
          <div class="table-container">
            <table>
                <tr>
                    <th>Category</th>
                    <th>Count</th> 
                </tr>
                <tr>
                  <?php foreach($data['countBookCategory'] as $category):?>
                  <td><?php echo $category->category;?></td>
                  <td><?php echo $category->count;?></td>
                </tr>
                <?php endforeach;?>
            </table>
          </div>
          <div class="chart-container">
            <canvas id="bookChart2"></canvas>
          </div>
        </div>

      </div>
    `;
    document.querySelector(".report").innerHTML = reportContent;
    document.getElementById("bookOverviewBtn").style.backgroundColor = "#71CFB6";
    document.getElementById("orderOverviewBtn").style.backgroundColor = "white";
    document.getElementById("userOverviewBtn").style.backgroundColor = "white";

    const xValues = <?php echo json_encode($data['newBooklabels']); ?>;
    
    new Chart("bookChart1", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          label: 'New Books',
          borderColor: "green",
          fill:false,
          data: <?php echo json_encode($data['newBookdata']); ?>
        },{
          label: 'Used Books',
          borderColor: "red",
          fill:false,
          data: <?php echo json_encode($data['usedBookdata']); ?>
        },{
          label:'Exchanged Books',
          borderColor: "blue",
          fill:false,
          data: <?php echo json_encode($data['exchangeBookdata']); ?>
        }]
      },
      options: {
        legend: {
            display: true,
            position: 'top', // You can change the position as needed (top, bottom, left, right)
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
      }, 
    });

    new Chart("bookChart2", {
      type: "bar",
      data: {
        labels: [<?php foreach($data['countBookCategory'] as $category): ?>"<?php echo $category->category; ?>",<?php endforeach;?>],
        datasets: [{
          backgroundColor:['#A1E998','#C9F383','#F9F871','#4EACC3','#6F7BB7','#388985','#966B7C','#B9006F'],
          borderColor: "rgba(0,0,255,0.1)",
          data: [<?php foreach($data['countBookCategory'] as $category): ?><?php echo $category->count; ?>,<?php endforeach;?>]
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
