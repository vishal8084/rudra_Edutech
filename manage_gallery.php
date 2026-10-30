<?php
session_start();

/* =========================================================
    ONLY LOGGED IN ADMIN ALLOWED
========================================================= */
if (!isset($_SESSION['user_id']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

/* =========================================================
   DATABASE CONFIGURATION
========================================================= */
$db_host = getenv("DB_HOST") ?: "localhost";
$db_user = getenv("DB_USER") ?: "root";
$db_pass = getenv("DB_PASS");
$db_pass = ($db_pass === false) ? "" : $db_pass;
$db_name = getenv("DB_NAME") ?: "rudra_edutech";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$message = "";
$error = "";

/* =========================================================
   ADD NEW GALLERY IMAGE
========================================================= */
if (isset($_POST['add_gallery'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img_name = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        
        $allowed = array('jpg', 'jpeg', 'png', 'webp');
        
        if (in_array($ext, $allowed)) {
            $new_img_name = uniqid('IMG_', true) . '.' . $ext;
            $upload_dir = "uploads/gallery/";
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $target_file = $upload_dir . $new_img_name;
            
            if (move_uploaded_file($img_tmp, $target_file)) {
                $stmt = $conn->prepare("INSERT INTO gallery (title, category, description, image) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $title, $category, $description, $new_img_name);
                
                if ($stmt->execute()) {
                    $message = "Image added successfully!";
                } else {
                    $error = "Database insertion failed.";
                }
                $stmt->close();
            } else {
                $error = "Failed to upload image file.";
            }
        } else {
            $error = "Only JPG, JPEG, PNG & WEBP files are allowed.";
        }
    } else {
        $error = "Please select an image file.";
    }
}

/* =========================================================
   DELETE GALLERY IMAGE
========================================================= */
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    
    $stmt = $conn->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        $file_path = "uploads/gallery/" . $row['image'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        $del_stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        $del_stmt->bind_param("i", $delete_id);
        $del_stmt->execute();
        $del_stmt->close();
        
        header("Location: manage_gallery.php?msg=deleted");
        exit();
    }
    $stmt->close();
}

if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
    $message = "Image deleted successfully!";
}

/* =========================================================
   UPDATE GALLERY ITEM
========================================================= */
if (isset($_POST['update_gallery'])) {
    $edit_id = intval($_POST['edit_id']);
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $old_image = $_POST['old_image'];
    
    $new_img_name = $old_image;
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img_name = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png', 'webp');
        
        if (in_array($ext, $allowed)) {
            $new_img_name = uniqid('IMG_', true) . '.' . $ext;
            $target_file = "uploads/gallery/" . $new_img_name;
            
            if (move_uploaded_file($img_tmp, $target_file)) {
                $old_path = "uploads/gallery/" . $old_image;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }
        }
    }
    
    $stmt = $conn->prepare("UPDATE gallery SET title = ?, category = ?, description = ?, image = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $category, $description, $new_img_name, $edit_id);
    
    if ($stmt->execute()) {
        $message = "Gallery item updated successfully!";
    } else {
        $error = "Failed to update record.";
    }
    $stmt->close();
}


$result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Management | Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=2.3">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --border: #e2e8f0;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --shadow-md: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
        }

        body {
            background: var(--light);
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            margin: 0;
            padding: 0;
        }

        .admin-wrapper {
            padding: 40px 20px;
            max-width: 1250px;
            margin: 0 auto;
        }

        /* Top Nav */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px 30px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }

        .top-nav h2 {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-nav-actions {
            display: flex;
            gap: 12px;
        }

        /* Card Boxes */
        .card-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .card-box h3 {
            margin-top: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid var(--light);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        /* Alerts */
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #ffeeec;
            color: #991b1b;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #fecaca;
        }

        /* Form Controls */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 13px;
            color: #475569;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            background: #f8fafc;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        /* Custom File Upload Box */
        .file-upload-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            border: 1px dashed var(--border);
            border-radius: 12px;
            background: #f8fafc;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            padding: 4px;
        }

        .file-upload-wrapper:hover {
            border-color: var(--primary);
            background: #f1f5f9;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            z-index: 2;
        }

        .file-upload-btn {
            background: var(--primary);
            color: white;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.3s;
        }

        .file-upload-name {
            padding: 0 15px;
            font-size: 13px;
            color: var(--secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Buttons Style */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }

        .btn-secondary { background: #e2e8f0; color: #334155; }
        .btn-secondary:hover { background: #cbd5e1; }

        .btn-danger { background: #fee2e2; color: #dc2626; }
        .btn-danger:hover { background: #dc2626; color: white; }

        .btn-warning { background: #fef3c7; color: #d97706; }
        .btn-warning:hover { background: #d97706; color: white; }

        .btn-sm {
            padding: 7px 14px;
            font-size: 12px;
            border-radius: 8px;
        }

        /* Table Design */
        .table-responsive {
            overflow-x: auto;
        }

        .gallery-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
        }

        .gallery-table th {
            background: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            text-align: left;
            border-bottom: 2px solid var(--border);
        }

        .gallery-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            vertical-align: middle;
        }

        .gallery-table tbody tr {
            transition: background 0.2s;
        }

        .gallery-table tbody tr:hover {
            background: #f8fafc;
        }

        .img-preview {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .category-pill {
            background: #eff6ff;
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        /* Modal Popup */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            padding: 35px;
            border-radius: 24px;
            width: 100%;
            max-width: 520px;
            position: relative;
            box-shadow: var(--shadow-md);
            animation: scaleUp 0.3s ease;
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scaleUp { from { transform: scale(0.95); } to { transform: scale(1); } }

        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; gap: 0; }
            .top-nav { flex-direction: column; gap: 15px; align-items: flex-start; }
            .top-nav-actions { width: 100%; justify-content: space-between; }
        }
    </style>
</head>
<body>

<div class="admin-wrapper">
    <!-- Top Navigation -->
    <div class="top-nav">
        <h2><i class="bi bi-images" style="color:var(--primary);"></i> Gallery Management Panel</h2>
        <div class="top-nav-actions">
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-globe"></i> Website</a>
            <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <?php if(!empty($message)): ?>
        <div class="alert-success"><i class="bi bi-check-circle-fill"></i> <?php echo $message; ?></div>
    <?php endif; ?>

    <?php if(!empty($error)): ?>
        <div class="alert-error"><i class="bi bi-exclamation-triangle-fill"></i> <?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Add New Image Form -->
    <div class="card-box">
        <h3><i class="bi bi-plus-circle-fill" style="color: var(--primary);"></i> Add New Image to Gallery</h3>
        <form action="manage_gallery.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label>Image Title</label>
                    <input type="text" name="title" placeholder="Enter clean title..." required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" placeholder="e.g. Events, Campus, Classes" required>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Write a short description..." style="height: 80px; resize: vertical;"></textarea>
            </div>
            <div class="form-group">
                <label>Upload Image File (JPG, PNG, WEBP)</label>
                <div class="file-upload-wrapper">
                    <div class="file-upload-btn"><i class="bi bi-folder2-open"></i> Browse File</div>
                    <div class="file-upload-name" id="fileNameDisplay">No file chosen</div>
                    <input type="file" name="image" accept="image/*" id="imageFileField" required onchange="updateFileName(this)">
                </div>
            </div>
            <button type="submit" name="add_gallery" class="btn btn-primary"><i class="bi bi-cloud-upload-fill"></i> Upload Image Now</button>
        </form>
    </div>

    <!-- Gallery Items List -->
    <div class="card-box">
        <h3><i class="bi bi-collection-fill" style="color: var(--primary);"></i> All Gallery Records</h3>
        <div class="table-responsive">
            <table class="gallery-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <img src="uploads/gallery/<?php echo htmlspecialchars($row['image']); ?>" class="img-preview" alt="Thumbnail" onerror="this.src='https://via.placeholder.com/65'">
                                </td>
                                <td><b style="color: var(--dark);"><?php echo htmlspecialchars($row['title']); ?></b></td>
                                <td><span class="category-pill"><?php echo htmlspecialchars($row['category']); ?></span></td>
                                <td style="color: var(--secondary); max-width: 250px;"><?php echo htmlspecialchars($row['description']); ?></td>
                                <td style="color: #64748b; font-size: 13px;"><?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?></td>
                                <td>
                                    <div class="action-btns">
                                        <button type="button" class="btn btn-warning btn-sm" onclick='openEditModal(<?php echo json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>)'>
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <a href="manage_gallery.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this gallery item?');">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; color: var(--secondary); padding: 30px;">No gallery images uploaded yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <h3 style="margin-top:0; border-bottom:2px solid var(--light); padding-bottom:15px; margin-bottom:20px; font-family:'Poppins',sans-serif;"><i class="bi bi-pencil-square" style="color: var(--primary);"></i> Edit Gallery Item</h3>
        <form action="manage_gallery.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" id="edit_id">
            <input type="hidden" name="old_image" id="old_image">
            
            <div class="form-group">
                <label>Image Title</label>
                <input type="text" name="title" id="edit_title" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" id="edit_category" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="edit_description" style="height: 80px; resize: vertical;"></textarea>
            </div>
            <div class="form-group">
                <label>Change Image (Optional)</label>
                <div class="file-upload-wrapper">
                    <div class="file-upload-btn"><i class="bi bi-folder2-open"></i> Browse New</div>
                    <div class="file-upload-name" id="editFileNameDisplay">No file chosen</div>
                    <input type="file" name="image" accept="image/*" id="editImageFileField" onchange="updateEditFileName(this)">
                </div>
            </div>
            <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 25px;">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                <button type="submit" name="update_gallery" class="btn btn-primary"><i class="bi bi-check-lg"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input) {
    const display = document.getElementById('fileNameDisplay');
    if (input.files && input.files.length > 0) {
        display.textContent = input.files[0].name;
        display.style.color = 'var(--dark)';
    } else {
        display.textContent = 'No file chosen';
        display.style.color = 'var(--secondary)';
    }
}

function updateEditFileName(input) {
    const display = document.getElementById('editFileNameDisplay');
    if (input.files && input.files.length > 0) {
        display.textContent = input.files[0].name;
        display.style.color = 'var(--dark)';
    } else {
        display.textContent = 'No file chosen';
        display.style.color = 'var(--secondary)';
    }
}

function openEditModal(data) {
    document.getElementById('edit_id').value = data.id;
    document.getElementById('old_image').value = data.image;
    document.getElementById('edit_title').value = data.title;
    document.getElementById('edit_category').value = data.category;
    document.getElementById('edit_description').value = data.description || '';
    document.getElementById('editFileNameDisplay').textContent = data.image ? data.image : 'No file chosen';
    document.getElementById('editModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Close modal on outside click
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        closeEditModal();
    }
}
</script>

</body>
</html>