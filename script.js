// script.js

//Notifiactions
document.addEventListener("DOMContentLoaded", function() {
    const closeButton = document.querySelector(".btn-close");
    const notificationBox = document.querySelector(".notification-box");

    closeButton.addEventListener("click", function() {
        notificationBox.style.display = "none";
    });
});


document.getElementById('submitBtn').addEventListener('click', function() {
    var resourceType = document.getElementById('resourceType').value;
    var branch = document.getElementById('branch').value;
    var semester = document.getElementById('semester').value;
  
    // Simulate fetching content based on selected options
    var content = "Content for " + resourceType + " of " + branch + " branch, Semester " + semester + " will be displayed here.";
  
    // Display the content
    document.getElementById('result').innerHTML = content;
  });
  