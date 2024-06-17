<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    include('../setup/config.php');


    $sql = "DELETE FROM todolist WHERE id = :id";
    $stmt = conn()->prepare($sql);
    $stmt->execute(['id' => $id]);
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
