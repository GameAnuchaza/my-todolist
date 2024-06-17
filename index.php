<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>
    <?php
    include ('setup/set.php');
    ?>

</head>

<body>
    <div class="container">
        <header class="p-3 text-bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <h1 class="col-12 text-center">To do List</h1>

                </div>
            </div>
        </header><br>
        <form action="data/addlist.php" method="POST">
            <div class="mb-3 d-flex align-items-center">
                <input type="text" name="list" class="form-control me-2" id="exampleFormControlInput1"  required>
                <button type="submit" class="btn btn-primary">ADD</button>
            </div>
        </form>

        <?php include('setup/config.php'); ?>
        <?php 
    $StrQ = "SELECT * FROM todolist";
    $result = Show_data($StrQ);
?>

        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                    <th class="col-1">
                    </th>
                    <!-- <th>
                        <center>รหัสประเภท</center>
                    </th> -->
                    <th>
                    </th>
                    <th class="col-2">
                    </th>
                </thead>
                <tbody>
                    <?php foreach($result as $item){ ?>

                    <tr>
                    <td class="text-center align-middle">
                <div class="form-check">
                    <form action="data/upliststatuslist.php" method="post">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input custom-checkbox" type="checkbox" name="status" value="1"
                            <?php if ($item['statuslist'] == 1) echo 'checked'; ?>
                            onchange="this.form.submit()">
                    </form>
                </div>
            </td>
                        <td class="text-align: left; vertical-align: middle;">
                            <?=$item['list']?>
                        </td>
                        <td class="text-right">
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-block btn-outline-danger btn-md"
                                    href="data/dellist.php?id=<?= $item['id'] ?>"
                                    onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบรายการนี้?')">
                                    <i class="bi bi-trash3-fill"></i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>


</body>

</html>