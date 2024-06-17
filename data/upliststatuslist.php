<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    $itemId = $_POST['id'];
    $status = $_POST['status'];

    $pdo = new PDO('mysql:host=localhost;dbname=datalist', 'root', '');
    $sql = "UPDATE todolist SET statuslist = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['status' => $status, 'id' => $itemId]);


    ?>
    <script>
        window.location.href = '../index.php';
    </script>
<?php
} else {
    echo "ไม่สามารถบันทึกข้อมูลได้ เนื่องจาก ".$e->getMessage();
    header("Location: index.php");
    exit();
}
?>
