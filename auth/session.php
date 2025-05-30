<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['id']);
}

function getUserRole() {
    return $_SESSION['role'] ?? null;
}

function getUsername() {
    return $_SESSION['username'] ?? '';
}
