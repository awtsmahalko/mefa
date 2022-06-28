<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header("location:app/authentication.php");
} else {
    header("location:app/index.php");
}
