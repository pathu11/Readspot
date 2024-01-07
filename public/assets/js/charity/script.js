
let isLoggedIn = false;

function showMessage() 
{
    if (isLoggedIn) 
    {
        alert("Post your event here!");
    }
    else 
    {
        alert("Login first");
    }
}

function toggleReadMore() {
    var aboutText = document.getElementById("about-text");
    var readMoreBtn = document.getElementById("read-more");

    if (aboutText.style.maxHeight) {
        aboutText.style.maxHeight = null;
        readMoreBtn.innerHTML = "Read More";
    } else {
        aboutText.style.maxHeight = aboutText.scrollHeight + "px";
        readMoreBtn.innerHTML = "Read Less";
    }
}


function toggleDetails(id) {
    var details = document.getElementById(id);
    details.classList.toggle("show-details");
}


document.addEventListener("DOMContentLoaded", function() {
    var contactBar = document.getElementById("contact-bar");
    contactBar.style.transform = "translateY(0)";
});


//Connect to whatsapp
function openWhatsApp() {
    var phoneNumber = "+94768545700";
    var whatsappUrl = "https://wa.me/" + phoneNumber;
    window.open(whatsappUrl, '_blank');
}


//Nav Identify
var currentPage = "home";
var activeNavLink = document.querySelector('nav a[href="#' + currentPage + '"]');
activeNavLink.classList.add('active');

// Add this to your existing JavaScript or create a new script file

// Function to open the login modal and add blur to the background
function openModal() {
    var modal = document.getElementById("loginModal");
    document.body.classList.add("blur");
    modal.style.display = "block";
}

// Function to close the login modal and remove blur from the background
function closeModal() {
    var modal = document.getElementById("loginModal");
    document.body.classList.remove("blur");
    modal.style.display = "none";
}

// Event listener for the "Login" link
document.getElementById("login").addEventListener("click", openModal);

// Event listener for the close button in the modal
document.getElementsByClassName("close")[0].addEventListener("click", closeModal);




  // Wait for the content to load
  document.addEventListener("DOMContentLoaded", function () {
    // Show the logo with a delay
    setTimeout(function () {
      document.getElementById("logo").style.opacity = "1";
    }, 500);

    // Wait for the logo animation to finish and then show the dashboard
    setTimeout(function () {
      document.getElementById("logo").style.display = "none";
      document.getElementById("dashboard").style.display = "block";
    }, 1500); // Adjust the delay according to your animation duration
  });