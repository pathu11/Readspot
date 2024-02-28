const startingMinutes = 5;
// Get remaining time from localStorage if available, otherwise set it to default
let time = localStorage.getItem('remainingTime') || (startingMinutes * 60);
const countdownEl = document.getElementById('countdown');
// Update countdown on page load
setInterval(updateCountdown,1000);

// Countdown function
function updateCountdown() {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  seconds = seconds < 10 ? '0' + seconds : seconds;

  countdownEl.innerHTML = `${minutes}:${seconds}`;
  time--;

  // Update remaining time in localStorage
  localStorage.setItem('remainingTime', time);
}

// Handle form submission
document.getElementById('quizForm').addEventListener('submit', function () {
  // Clear remaining time from localStorage
  localStorage.removeItem('remainingTime');
});
