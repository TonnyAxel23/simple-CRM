<?php
session_start();
require 'db.php';
require 'functions.php';
redirect_if_not_logged_in();

// Fetch all clients
$stmt = $pdo->query("SELECT * FROM clients ORDER BY created_at DESC");
$clients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - Simple CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Client Dashboard</h1>
            <a href="add-client.php" class="btn btn-success">Add New Client</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo htmlspecialchars($client['name']); ?></td>
                        <td><?php echo htmlspecialchars($client['email']); ?></td>
                        <td><?php echo htmlspecialchars($client['phone']); ?></td>
                        <td>
                            <span class="badge 
                                <?php 
                                switch($client['status']) {
                                    case 'active': echo 'bg-success'; break;
                                    case 'inactive': echo 'bg-secondary'; break;
                                    case 'pending': echo 'bg-warning'; break;
                                }
                                ?>">
                                <?php echo ucfirst($client['status']); ?>
                            </span>
                        </td>
                        <td><?php echo date('M d, Y H:i', strtotime($client['created_at'])); ?></td>
                        <td>
                            <a href="edit-client.php?id=<?php echo $client['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="delete-client.php?id=<?php echo $client['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>