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
const uploadBtn = document.getElementById('dashboardUploadBtn');
const fileInput = document.getElementById('dashboardFileInput');
const uploadForm = document.querySelector('.dashboard__upload-form');
if (uploadBtn && fileInput && uploadForm) {
    uploadBtn.addEventListener('click', function() {
        fileInput.click();
    });
    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            uploadForm.submit();
        }
    });
}

// Update drag-and-drop to submit form
if (dashboardUpload && fileInput && uploadForm) {
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
            fileInput.files = files;
            uploadForm.submit();
        }
    });
} 