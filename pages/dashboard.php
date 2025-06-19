<?php
if (empty($_SESSION['logged_in'])) {
    header("Location: ?page=home");
    exit();
}
?>
<div id="dashboard">
    <div class="dashboard__container">
        <h1 class="dashboard__title">Upload Files</h1>
        <p class="dashboard__subtitle">Manage your uploaded files and storage</p>
        <div class="dashboard__upload">
            <strong class="dashboard__upload-title">Drag and drop files here</strong>
            <div class="dashboard__upload-desc">Or click to browse your files</div>
            <input type="file" id="dashboardFileInput" class="dashboard__file-input" multiple style="display:none;" />
            <button type="button" class="button button--primary" id="dashboardUploadBtn">Upload Files</button>
        </div>
        <h2 class="dashboard__section-title">My Files</h2>
        <div class="dashboard__table-wrapper">
            <table class="dashboard__table">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Size</th>
                        <th>Upload Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Document1.pdf</td>
                        <td>2.5 MB</td>
                        <td>2024-01-15</td>
                        <td><a href="#" class="header__menu-link dashboard__action-link">View</a></td>
                    </tr>
                    <tr>
                        <td>Image2.jpg</td>
                        <td>1.2 MB</td>
                        <td>2024-01-10</td>
                        <td><a href="#" class="header__menu-link dashboard__action-link">View</a></td>
                    </tr>
                    <tr>
                        <td>Presentation3.pptx</td>
                        <td>5.8 MB</td>
                        <td>2024-01-05</td>
                        <td><a href="#" class="header__menu-link dashboard__action-link">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> 