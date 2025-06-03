<?php
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function is_logged_in() {
    return isset($_SESSION['admin_id']);
}

function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

// Add more helper functions as needed
?>