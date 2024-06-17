<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    include('../setup/config.php');
    if(isset($_POST['list'])){
        
        try {
            $list = $_POST['list'];
            $data = [
                'id' => "",
                'list' => $list,
                'statuslist' => 0                
            ];

            $StrQ = "INSERT INTO todolist (id, list, statuslist) VALUES (:id, :list, :statuslist)";
            
            if (insert_data($data, $StrQ)) {
                ?>
                    <script>
                        window.location.href = '../index.php';
                    </script>
                <?php
                }
            
        } catch (PDOException $e) {
            echo "ไม่สามารถบันทึกข้อมูลได้ เนื่องจาก ".$e->getMessage();
        }
    }

?>
    
</body>
</html>