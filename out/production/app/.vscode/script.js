const sidebar = document.querySelector(".sidebar");
const buttonSidebar = document.querySelector(".button-sidebar");

// Add a click event listener to the sidebar button.
buttonSidebar.addEventListener("click", function() {
  // Set the right property of the sidebar to 0px, which will move it to the left side of the page.
  sidebar.style.right = "0px";
});

// Add a click event listener to the window.
window.addEventListener("click", function(event) {
  // If the event target is the sidebar, set the right property of the sidebar to -250px, which will hide it.
  if (event.target === sidebar) {
    sidebar.style.right = "-250px";
  }
});
