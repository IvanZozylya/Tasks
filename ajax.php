<?php
$link = new mysqli("localhost", "root", "", "test");

if (isset($_POST['name'])) {
    $result = $link->query("SELECT * FROM `tasks` ORDER BY `name`");
    $i = 0;
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[$i] = $row;
        $i++;
    }
}
if (isset($_POST['email'])) {
    $result = $link->query("SELECT * FROM `tasks` ORDER BY `email`");
    $i = 0;
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[$i] = $row;
        $i++;
    }

}
if (isset($_POST['status'])) {
    $result = $link->query("SELECT * FROM `tasks` ORDER BY `status`");
    $i = 0;
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[$i] = $row;
        $i++;
    }

}


mysqli_close($link);
echo json_encode($tasks);
?>