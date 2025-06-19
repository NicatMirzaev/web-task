<?php

if (empty($_SESSION['logged_in'])) {
    header("Location: ?page=home");
    exit();
}

require_once 'config/database.php';
require_once 'config/config.php';

$userId = $_SESSION['user_id'];
$uploadMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
    $uploadDir = __DIR__ . '/../uploads/';
    $dbPathPrefix = '/uploads/';
    $files = $_FILES['files'];
    $successCount = 0;
    $errorCount = 0;
    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] === UPLOAD_ERR_OK) {
            $originalName = basename($files['name'][$i]);
            $uniqueId = substr(bin2hex(random_bytes(3)), 0, 6);
            $uniqueName = $uniqueId . '_' . $originalName;
            $targetPath = $uploadDir . $uniqueName;
            $sizeKb = round($files['size'][$i] / 1024, 2);
            if (move_uploaded_file($files['tmp_name'][$i], $targetPath)) {
                $db->insert(
                    "INSERT INTO uploads (user_id, file_name, original_file_name, size) VALUES (?, ?, ?, ?)",
                    [$userId, $uniqueName, $originalName, $sizeKb]
                );
                $successCount++;
            } else {
                $errorCount++;
            }
        } else {
            $errorCount++;
        }
    }
    if ($successCount > 0) {
        $uploadMessage = "$successCount file uploaded successfully.";
    }
    if ($errorCount > 0) {
        $uploadMessage .= " $errorCount file failed to upload.";
    }
}

function formatFileSize($sizeKb) {
    if ($sizeKb < 1024) {
        return $sizeKb . ' KB';
    } elseif ($sizeKb < 1024 * 1024) {
        return round($sizeKb / 1024, 2) . ' MB';
    } else {
        return round($sizeKb / (1024 * 1024), 2) . ' GB';
    }
}

$uploadedFiles = $db->fetchAll("SELECT * FROM uploads WHERE user_id = ? ORDER BY upload_date DESC, id DESC", [$userId]);

?>
<div id="dashboard">
    <div class="dashboard__container">
        <h1 class="dashboard__title">Upload Files</h1>
        <p class="dashboard__subtitle">Manage your uploaded files and storage</p>
        <?php if (!empty($uploadMessage)): ?>
            <div class="alert alert--success"><?php echo htmlspecialchars($uploadMessage); ?></div>
        <?php endif; ?>
        <form class="dashboard__upload-form" action="" method="POST" enctype="multipart/form-data">
            <div class="dashboard__upload">
                <strong class="dashboard__upload-title">Drag and drop files here</strong>
                <div class="dashboard__upload-desc">Or click to browse your files</div>
                <input type="file" id="dashboardFileInput" class="dashboard__file-input" name="files[]" multiple style="display:none;" />
                <button type="button" class="button button--primary" id="dashboardUploadBtn">Upload Files</button>
            </div>
        </form>
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
                <?php if (!empty($uploadedFiles)): ?>
                    <?php foreach ($uploadedFiles as $file): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($file['original_file_name']); ?></td>
                            <td><?php echo formatFileSize($file['size']); ?></td>
                            <td><?php echo htmlspecialchars($file['upload_date']); ?></td>
                            <td><a href="<?php echo BASE_URL . '/uploads/' . rawurlencode($file['file_name']); ?>" download class="header__menu-link dashboard__action-link">Download</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center; color:var(--color-gray);">No files uploaded yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 