// Get the current page URL
var currentPageUrl = window.location.href;

// Get all menu items
var menuItems = document.querySelectorAll('.menu-list li');

// Loop through menu items to find the active one
for (var i = 0; i < menuItems.length; i++) {
    var page = menuItems[i].getAttribute('data-page');
    if (currentPageUrl.includes(page)) {
        menuItems[i].classList.add('active');
        break; // Exit the loop once the active item is found
    }
}
