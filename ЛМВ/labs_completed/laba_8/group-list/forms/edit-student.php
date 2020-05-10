<?php
    include(__DIR__ . "/../auth/check-auth.php");
    if (!CheckRight('student', 'edit')) {
        die('Ви не маєте права на виконання цієї операції');
    }
    if ($_POST) {
        $f = fopen("../data/" .  $_GET['group'] . "/" . $_GET['file'], "w");
        $privilege = 0;
        if ($_POST['stud_privilege'] == 1) {
            $privilege = 1;
        }
        $grArr = array($_POST['stud_name'], $_POST['stud_gender'], $_POST['stud_dob'], $privilege);
        $grStr = implode(";", $grArr);
        fwrite($f, $grStr);
        header('Location: ../index.php?group=' . $_GET['group']);
    }
    $path = __DIR__ . "/../data/" . $_GET['group'];
    $node = $_GET['file'];
    $student = require __DIR__ . '/../data/declare-student.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редагування студента</title>
    <link rel="stylesheet" href="../css/edit-student-form-style.css" />
</head>
<body>
    <a href="../index.php">На головну</a>
    <form name="edit-student" method="post">
        <div>
            <label for="stud_name">Прізвище: </label>
            <input type="text" name="stud_name" value="<?php echo $student['name'];?>">
        </div>
        <div>
            <label for="stud_gender">Стать: </label>
            <select name="stud_gender">
                <option disabled>Стать</option>
                <option <?php echo ("чол" == $student['gender'])?"selected":""; ?> value="чол">Чоловіча</option>
                <option <?php echo ("жін" == $student['gender'])?"selected":""; ?> value="жін">Жіноча</option>
            </select>
        </div>
        <div>
            <label for="stuud_dob">Дата народження:</label>
            <input type="date" name="stud_dob" value="<?php echo $student['dob'];?>">
        </div>
        <div>
            <input type="checkbox" name="stud_privilege" <?php echo ("1" == $student['privilege'])?"checked":""; ?>> пільга
        </div>
        <div>
            <input type="submit" name="ok" value="змінити">
        </div>
    </form>

</body>
</html>