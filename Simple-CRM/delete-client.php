<?php
session_start();
require 'db.php';
require 'functions.php';
redirect_if_not_logged_in();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

// Check if client exists
$stmt = $pdo->prepare("SELECT id FROM clients WHERE id = ?");
$stmt->execute([$id]);
$client = $stmt->fetch();

if ($client) {
    $stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
?>