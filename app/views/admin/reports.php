<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/nav.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/admin/reports.css" />
  <script src="<?php echo URLROOT;?>/assets/js/admin/pdf.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <title>Reports</title>
</head>
<body>
  <?php require APPROOT . '/views/admin/nav.php';?>


  <div class="selection-bar">
    <form action="<?php echo URLROOT;?>/admin/reports" method="post">
      <div class="title-bar">
      <h3>Title</h3>
        <input type="text" placeholder="Add a report title" id="title">
      </div>
      <div class="input-bar">
        <div class="select">
          <select name="report-type" id="report-type" onchange="handleReportSelection()">
            <option value="" disabled selected>Select Report Type</option>
            <option value="registration" id="registration" name="registration"">Registration report</option>
            <option value="book-inventory" id="book-inventory" name="book-inventory">Book Inventory Report</option>
            <option value="">Login Activity</option>
          </select>
        </div>

        <div id="date">
          <div class="date-picker">
            <label>Start Date</label>
            <input type="date" placeholder="Start Date" name="start-date" id="start-date">
          </div>
          <div class="date-picker">
            <label>End Date</label>
            <input type="date" placeholder="End Date" name="end-date" id="end-date">
          </div>
        </div>

        <div id="book_inventory">
          <div class="checkBox"><input type="checkbox"><label>Total number of books</label></div>
          <div class="checkBox"><input type="checkbox"><label>Book Categories</label></div>
          <div class="checkBox"><input type="checkbox"><label>Top Authors</label></div>
          <div class="checkBox"><input type="checkbox"><label>Book Availability</label></div>
        </div>

        <div class="button">
          <button type="submit">Generate Report</button>
        </div>
      </div>
    </form>
  </div>

  <?php 
    if($_SERVER['REQUEST_METHOD']=='POST'){
      echo '<div class="table-container" id="pdf">
          <h2>'.$data['title'].'</h2>
          <div class="table" id="pdf"> 
            <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>New Registrations</th>
              </tr>
            </thead>
            <tbody>';
              foreach ($data['registrationDetails'] as $registrationDetail):
              echo '<tr>'.
                '<td>'.$registrationDetail->registration_date . '</td>'.
                '<td>'.$registrationDetail->new_registrations . '</td>'.
              '</tr>';
              endforeach;
            echo '</tbody>'.
          '</table>'.
    '</div>'.
    '</div>';
    echo '<button id=download>Download PDF</button>';
    }
  ?>

<script>
    function handleReportSelection() {
      var selectedValue = document.getElementById("report-type").value;
      var dateSection = document.getElementById("date");
      var inventorySection = document.getElementById("book_inventory");

      if (selectedValue === "registration") {
        dateSection.style.display = "flex";
      }
      else if(selectedValue==="book-inventory"){
        inventorySection.style.display = "flex";
      }
    }
</script>

</body>
</html>