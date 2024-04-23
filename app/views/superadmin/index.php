
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/superadmin/index.css" />
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>/assets/images/publisher/ReadSpot.png">
  <title>Super Admin Dashboard</title>
  <script>
        const rootUrl = '<?php echo URLROOT; ?>';
    </script>
</head>
<body>
  <?php require APPROOT . '/views/superadmin/nav.php';
  ?>

<div class="img-container">
      <div class="profile">
        <h2>Welcome Back, <br><span style="color: red; font-size: 38px;"><?php echo explode(" ", $data['superadminName'])[0];?></span><i class="fas fa-hand-paper wave-icon"></i></h2>
        
        </h2>
      </div>
      <div class="image">
        <img id="image1" src="<?php echo URLROOT;?>/assets/images/publisher/admin.jpg" width="700px" height="150px" >
       
      </div>
     
  </div>
  
  <div class="chart-container">
    <div class="chart">
      <h2>Number of Users</h2>
      <canvas id="myChart1"></canvas>
    </div>
    <div class="chart">
      <h2>User Registration Trends</h2>
      <canvas id="userRegistrationChart"></canvas>
       
    </div>
  </div>
  <div class="chart-container1">
    <div class="chart1">
      <h2>Number of Logins for Today</h2>
     <canvas id="userLoginPieChart"></canvas>
    </div>
    <div class="chart1">
      <h2>No Of Complaints</h2>
        <canvas id="mychart2"  ></canvas>
    </div>
    <div class="chart1">
      <h2>User Registration Trends</h2>
        <canvas id="mychart2"  ></canvas>
    </div>
    </div>
    


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // set up block
    const publishers=<?php echo json_encode($data['countPublishers']); ?>;
    const charity=<?php echo json_encode($data['countCharity']); ?>;
    const customers=<?php echo json_encode($data['countCustomers']); ?>;
    const moderators=<?php echo json_encode($data['countModerators']); ?>;
    const admins=<?php echo json_encode($data['countAdmins']); ?>;
    const delivery=<?php echo json_encode($data['countDelivery']); ?>;
    const data={
      labels: ['Publishers', 'Charity organizations', 'Customers', 'Community moderators','Admins','Delivery Systems'],
      datasets: [{
        label: 'Number of users',
        data: [publishers, charity, customers, moderators,admins,delivery],
        backgroundColor: [
          '#333333', '#70BFBA', '#02514C', '000000', '404040','#70BFBA'
        ],
        borderWidth: 0,
        borderRadius: 5,
      }]

    };
    // config block
    const config={
      type: 'bar',
      data,
      options: {
        indexAxis: 'x', // Set indexAxis to 'y' for a horizontal bar chart
        scales: {
          x: {
            beginAtZero: true
          },
          y: {
            barPercentage: 0.3, // Adjust the bar height (default is 0.9)
            categoryPercentage: 0.5 // Adjust the spacing between bars (default is 0.8)
          }
        },
        plugins: {
          legend: {
            display: false // Set display to false to hide the legend
          },
          title: {
            display: true,
            text: 'Number of Users', // Title text
            padding: {
              top: 10,
              bottom: 10
            }
          }
        }
      }
    };
    // render block
    const myChart1 = new Chart(
      document.getElementById('myChart1'),config
    );

    // pie chart of complaints
    
  </script>
  <script>
    const resolvedCount = <?php echo json_encode($data['resolved_count']); ?>;
    const unresolvedCount = <?php echo json_encode($data['unresolved_count']); ?>;
     // Data for pie chart
    
    const complaintsData = {
      datasets: [{
        data: [resolvedCount, unresolvedCount],
        backgroundColor: ['green', 'red']
      }],
      labels: ['Resolved', 'Unresolved']
    };

    // Configuration for pie chart
    const complaintsConfig = {
      type: 'doughnut', // Change to doughnut type for the desired style
      data: complaintsData,
      options: {} // You can add options here if needed
    };

    // Initialize pie chart
    const complaintsPieChart = new Chart(
      document.getElementById('mychart2'), complaintsConfig
    );

    // JavaScript
    const ctxline = document.getElementById('userRegistrationChart').getContext('2d');
    const userDataline = <?php echo json_encode($data['UserCountByDate']); ?>;
    const labelsline = Array.from({ length: 31 }, (_, i) => i + 1);

    // Generate data array with user counts for each day, insert 0 if no user registered on that day
    const dataline = labelsline.map(day => {
      const userData = userDataline.find(data => data.day === day.toString());
      return userData ? userData.user_count : 0;
    });

    const configline = {
      type: 'line',
      data: {
        labels: labelsline,
        datasets: [{
          label: 'Registered Users',
          data: dataline,
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
      options: {
        scales: {
          x: {
            title: {
              display: true,
              text: 'Day'
            },
            // Set the x-axis to start from 1
            beginAtZero: false,
            // Adjust the maximum value of x-axis to 31
            max: 31
          },
          y: {
            title: {
              display: true,
              text: 'Number of Users who registered to the site'
            },
            // Prevent negative values from being displayed on y-axis
            beginAtZero: true
          }
        }
      }
    };

    const userRegistrationChart = new Chart(ctxline, configline);

    var userLoginData = <?php echo json_encode($data['UserLoginCountToday']); ?>;
    var userLoginLabels = userLoginData.map(function(item) {
        return item.user_role;
    });
    var userLoginCounts = userLoginData.map(function(item) {
        return item.login_count;
    });
    var ctxUserLogin = document.getElementById('userLoginPieChart').getContext('2d');
    var userLoginPieChart = new Chart(ctxUserLogin, {
        type: 'pie',
        data: {
            labels: userLoginLabels,
            datasets: [{
                label: 'User Logins Today',
                data: userLoginCounts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Red
                    'rgba(54, 162, 235, 0.6)', // Blue
                    'rgba(255, 206, 86, 0.6)', // Yellow
                    'rgba(75, 192, 192, 0.6)', // Green
                    'rgba(153, 102, 255, 0.6)', // Purple
                    'rgba(255, 159, 64, 0.6)' // Orange
                    // Add more colors if needed
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: 'User Logins Today'
            }
        }
    });
    </script>
 
</body>
<script>
        function goBack() {
            // Use the browser's built-in history object to go back
            window.history.back();
        }
        
    </script>
</html>

