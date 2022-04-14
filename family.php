<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<form action="" method="post">
    <input type="text" name="name" placeholder="نام خود را وارد کنید"><br><br>
    <input type="text" name="family" placeholder="نام خانوادگی خود را وارد کنید"><br><br>
    <input type="submit" value="send" name="send">

</form>

<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=note", "root", "");
    //echo "اتصال موفق بود";

} catch (Exception $e) {
    echo $e->getMessage();
}
if (isset($_POST["send"])) {
    $name = trim($_POST["name"]);
    $family = trim($_POST["family"]);
    if (strlen($name) < 1 or strlen($family) < 1) {
        $name_error = "نام و نام خانوادگی باید دارای مقدار باشند";
        echo "<p style='color: #ff0000'> $name_error </p>";

    } else {
        $quary = $pdo->prepare("INSERT INTO `friend`(`name`, `family`) VALUES ('$name','$family')");
        $quary->execute();

        $quary1 = $pdo->prepare("SELECT * FROM `friend`");
        $quary1->execute();
        $res = $quary1->fetchAll();
//var_dump($res);

        echo "<table border='2'><tr><th>name</th><th>family</th></tr>";

        foreach ($res as $res2) {
            echo "<tr>";
            echo "<td>" . $res2['name'] . "</td>";
            echo "<td>" . $res2['family'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>
</body>
</html>
