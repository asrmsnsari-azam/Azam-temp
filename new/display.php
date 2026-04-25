<?php
// Student Records Display Page
// Includes centralized database configuration

require_once 'config.php';

// Fetch all students
$sql = "SELECT * FROM students ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records - Registration Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header & Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="https://via.placeholder.com/40x40?text=SR" alt="Logo" class="rounded-circle me-2" style="width:40px;height:40px;">
                Student Registration
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="display.php">View Records</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary">Registered Students</h1>
            <p class="lead text-muted">View all student records stored in the database</p>
        </div>

        <div class="table-container">
            <?php if ($result && $result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Picture</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Hobbies</th>
                                <th>Country</th>
                                <th>Date of Birth</th>
                                <th>Registered On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="text-center fw-bold"><?php echo $row['id']; ?></td>
                                    <td class="text-center">
                                        <?php if (!empty($row['picture']) && file_exists($row['picture'])): ?>
                                            <img src="<?php echo $row['picture']; ?>" alt="Student Photo" class="student-img">
                                        <?php else: ?>
                                            <img src="https://via.placeholder.com/80x80?text=No+Image" alt="No Image" class="student-img">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php 
                                            echo ($row['gender'] === 'Male') ? 'primary' : 
                                                 (($row['gender'] === 'Female') ? 'danger' : 'secondary'); 
                                        ?>">
                                            <?php echo $row['gender']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo !empty($row['hobbies']) ? htmlspecialchars($row['hobbies']) : '-'; ?></td>
                                    <td><?php echo htmlspecialchars($row['country']); ?></td>
                                    <td><?php echo date('F d, Y', strtotime($row['dob'])); ?></td>
                                    <td><?php echo date('M d, Y h:i A', strtotime($row['created_at'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <p class="text-muted">Total Registered Students: <strong><?php echo $result->num_rows; ?></strong></p>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <img src="https://via.placeholder.com/150x150?text=No+Data" alt="No Data" class="mb-3 rounded-circle">
                    <h3 class="text-muted">No Records Found</h3>
                    <p class="text-muted">There are no student records in the database yet.</p>
                    <a href="index.html#registration" class="btn btn-primary mt-3">Register First Student</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Back to Registration Button -->
        <div class="text-center mb-5">
            <a href="index.html#registration" class="btn btn-outline-primary btn-lg me-2">Register New Student</a>
            <a href="index.html" class="btn btn-outline-secondary btn-lg">Back to Home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-1">&copy; 2024 Student Registration Portal. All rights reserved.</p>
            <p class="mb-0"><small>Designed for Web Development & Database Course</small></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>

