<?php
    $title = "My Calender";
    require APPROOT . '/views/customer/header.php'; //path changed
?>
    <?php
        require APPROOT . '/views/customer/sidebar.php'; //path changed
    ?>
    <div class="container">
        <div class="my-calender">
            <div>
                <label for="searchDate">Search by Date:</label>
                <input type="date" id="searchDate">
                <button onclick="searchByDate()">Search</button>
            </div>
            <div id="calendar"></div>
        </div>
        <?php
            require APPROOT . '/views/customer/footer.php'; //path changed
        ?>
    </div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Sample events
    var events = [
      { date: '2024-01-31', title: 'Event 1' },
      { date: '2024-02-05', title: 'Event 2' },
      { date: '2024-02-15', title: 'Event 3' }
    ];

    // Initialize calendar
    var calendar = new SimpleCalendar('#calendar', events);
  });

  function SimpleCalendar(selector, events) {
    var container = document.querySelector(selector);
    var currentDate = new Date();

    function generateCalendar() {
        var calendarHTML = '<header><button onclick="prevMonth()">«</button><h2>'
            + getMonthName(currentDate.getMonth()) + ' ' + currentDate.getFullYear() +
            '</h2><button onclick="nextMonth()">»</button></header><table><thead><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr></thead><tbody>';

        var today = new Date();  // Get today's date for comparison

        var firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        var dayCount = 1;

        for (var i = 0; i < 6; i++) {
            calendarHTML += '<tr>';
            for (var j = 0; j < 7; j++) {
            if ((i === 0 && j < firstDay.getDay()) || dayCount > lastDay.getDate()) {
                calendarHTML += '<td></td>';
            } else {
                var date = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + dayCount;
                var eventsForDay = getEventsForDate(date);
                var isToday = (today.toDateString() === new Date(date).toDateString());  // Check if it's today

                calendarHTML += '<td class="day' + (isToday ? ' today' : '') + '" data-date="' + date + '">';
                calendarHTML += '<span class="date">' + dayCount + '</span>';
                eventsForDay.forEach(function (event) {
                calendarHTML += '<div class="event" title="' + event.title + '">' + event.title + '</div>';
                });
                calendarHTML += '</td>';
                dayCount++;
            }
            }
            calendarHTML += '</tr>';
        }

        calendarHTML += '</tbody></table>';
        container.innerHTML = calendarHTML;
    }


    function getEventsForDate(date) {
      return events.filter(function (event) {
        return event.date === date;
      });
    }

    function getMonthName(month) {
      var monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
      ];
      return monthNames[month];
    }

    window.prevMonth = function () {
      currentDate.setMonth(currentDate.getMonth() - 1);
      generateCalendar();
    };

    window.nextMonth = function () {
      currentDate.setMonth(currentDate.getMonth() + 1);
      generateCalendar();
    };

    generateCalendar();
  }

  function searchByDate() {
    var searchDateInput = document.getElementById('searchDate');
    var searchDate = searchDateInput.value;

    if (searchDate) {
      // Highlight the searched date or handle the search logic as needed
      var searchedDay = document.querySelector('[data-date="' + searchDate + '"]');
      if (searchedDay) {
        // Scroll to the searched date or perform any other action
        searchedDay.scrollIntoView({ behavior: 'smooth' });
        // You can also add additional visual indicators for the searched date
        searchedDay.style.backgroundColor = '#FFD700'; // Yellow background, for example
      } else {
        alert('No events found for the selected date.');
      }
    } else {
      alert('Please enter a valid date.');
    }
  }

</script>
