//copy code lang to ai assistance
// Function to toggle the menu visibility
function toggleMenu() {
    var menuItems = document.querySelector('.menu-items');
    var menuToggle = document.querySelector('.menu-toggle');
    // Toggle the 'active' class to show/hide the menu
    menuItems.classList.toggle('active');
    menuToggle.classList.toggle('active');
}

//sa trainer to next and prev
document.addEventListener("DOMContentLoaded", function() {
    // Get references to DOM elements
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");
    const carousel = document.querySelector(".carousel");
    const items = document.querySelectorAll(".item");
    // Initialize variables
    let currentIndex = 0;
    const totalItems = items.length;

    // Function to show a specific carousel item
    function showItem(index) {
        items.forEach((item, i) => {
            // Show the item if its index matches the current index, otherwise hide it
            item.style.display = (i === index) ? "block" : "none";
        });
    }

    // Show the initial carousel item
    showItem(currentIndex);

    // Event listener for the previous button
    prevBtn.addEventListener("click", function() {
        // Calculate the index of the previous item
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        // Show the previous item
        showItem(currentIndex);
    });

    // Event listener for the next button
    nextBtn.addEventListener("click", function() {
        // Calculate the index of the next item
        currentIndex = (currentIndex + 1) % totalItems;
        // Show the next item
        showItem(currentIndex);
    });
});