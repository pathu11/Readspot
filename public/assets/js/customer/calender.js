// script.js
document.addEventListener("DOMContentLoaded", function() {
// const calendar = document.querySelector(".my-calender");
const date = document.querySelector(".cal-date");
const daysContainer = document.querySelector(".cal-days");
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");
const todayBtn = document.querySelector(".today-btn");
const gotoBtn = document.querySelector(".goto-btn");
const dateInput = document.querySelector(".date-input");
const eventDay = document.querySelector(".event-day");
const eventDate = document.querySelector(".event-date");
const eventsContainer = document.querySelector(".events");
const addEventBtn = document.querySelector(".add-event");
const addEventWrapper = document.querySelector(".add-event-wrapper");
const addEventCloseBtn = document.querySelector(".close");
const addEventTitle = document.querySelector(".event-name");
const addEventFrom = document.querySelector(".event-time-from");
const addEventTo = document.querySelector(".event-time-to");
const addEventSubmit = document.querySelector(".add-event-btn");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

// const eventsArr = [];

// const eventsArr = [
//     { day: 12, month: 1, year: 2024 }, // Example event on January 12, 2024
//     { day: 15, month: 1, year: 2024 }, // Example event on January 15, 2024
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
//     { day: 15, month: 1, year: 2024 },
    
//     // Add more event data as needed
// ];

// const eventsArr = json_encode($eventsFromBackend);
// getEvents();
// console.log(eventsArr);

//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="cal-day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      updateEvents(i);
      if (event) {
        days += `<div class="cal-day today active-date event">${i}</div>`;
      } else {
        days += `<div class="cal-day today active-date">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="cal-day event">${i}</div>`;
      } else {
        days += `<div class="cal-day">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="cal-day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {
  const days = document.querySelectorAll(".cal-day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active-date");
      });
      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".cal-day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active-date");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".cal-day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active-date");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active-date");
      }
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});

dateInput.addEventListener("input", (e) => {
  dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
  if (dateInput.value.length === 2) {
    dateInput.value += "/";
  }
  if (dateInput.value.length > 7) {
    dateInput.value = dateInput.value.slice(0, 7);
  }
  if (e.inputType === "deleteContentBackward") {
    if (dateInput.value.length === 3) {
      dateInput.value = dateInput.value.slice(0, 2);
    }
  }
});

gotoBtn.addEventListener("click", gotoDate);

function gotoDate() {
  console.log("here");
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Invalid Date");
}

//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

// function update events when a day is active
function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      event.day === date &&
      event.month === month + 1 &&
      event.year === year
    ) {
      events += `<div class="event" onclick="redirectToEvent(${event.eventID})">
        <div class="title">
          <i class="fas fa-circle"></i>
          <h3 class="event-title">${event.title}</h3>
        </div>
        <div class="event-time">${event.from} - ${event.to}</div>
      </div>`;
    }
  });
  eventsContainer.innerHTML = events;
}

//function to get events from localstorage
// function getEvents() {
//   let events = JSON.parse(localStorage.getItem("events"));
//   if (events) {
//     eventsArr.length = 0;
//     events.forEach((event) => {
//       eventsArr.push(event);
//     });
//   }
// }

//add event button click show add event wrapper
addEventBtn.addEventListener("click", () => {
  addEventWrapper.classList.add("active-date");
});

//add event close button click hide add event wrapper
addEventCloseBtn.addEventListener("click", () => {
  addEventWrapper.classList.remove("active-date");
});

//add event form submit add event to eventsArr
addEventSubmit.addEventListener("click", () => {
  const title = addEventTitle.value;
  const from = addEventFrom.value;
  const to = addEventTo.value;
  if (title && from && to) {
    eventsArr.push({
      title,
      day: activeDay,
      month: month + 1,
      year,
      from,
      to,
    });
    localStorage.setItem("events", JSON.stringify(eventsArr));
    addEventWrapper.classList.remove("active-date");
    updateEvents(activeDay);
  } else {
    alert("Please fill all fields");
  }
});
});
