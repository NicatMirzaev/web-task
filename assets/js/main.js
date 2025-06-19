// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add active class to current navigation item
    const currentPage = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.parentElement.classList.add('active');
        }
    });
});

// File drag-and-drop functionality
const dashboardUpload = document.querySelector('.dashboard__upload');
if (dashboardUpload) {
    dashboardUpload.addEventListener('dragover', function(e) {
        e.preventDefault();
        dashboardUpload.classList.add('dashboard__upload--dragover');
    });
    dashboardUpload.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dashboardUpload.classList.remove('dashboard__upload--dragover');
    });
    dashboardUpload.addEventListener('drop', function(e) {
        e.preventDefault();
        dashboardUpload.classList.remove('dashboard__upload--dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            let fileNames = [];
            for (let i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            alert('Files dropped: ' + fileNames.join(', '));
        }
    });
}

const uploadBtn = document.getElementById('dashboardUploadBtn');
const fileInput = document.getElementById('dashboardFileInput');
if (uploadBtn && fileInput) {
    uploadBtn.addEventListener('click', function() {
        fileInput.click();
    });
    fileInput.addEventListener('change', function() {
        const files = fileInput.files;
        if (files.length > 0) {
            let fileNames = [];
            for (let i = 0; i < files.length; i++) {
                fileNames.push(files[i].name);
            }
            alert('Files selected: ' + fileNames.join(', '));
        }
    });
} 