<?php
include 'Layer.php';
session_start();
if(!isset($_SESSION['Profile'])){
    $_SESSION['Profile'] = null;
}

if(isset($_POST['exit'])) {
    $_SESSION['Profile'] = null;
}

if (isset($_POST['login']) && $_POST['password'] || $_SESSION['Profile'] != null) {
    $db = new Database();
    if($_SESSION['Profile'] == null){
    $sql = "SELECT * FROM users WHERE login = '$_POST[login]' AND password = '$_POST[password]' LIMIT 1;";
    } else {
        $sql = "SELECT * FROM users WHERE login = '$_SESSION[Profile]' LIMIT 1;";
    }
    $res = $db->connectDB()->query($sql);
    $row = $res->fetch_assoc();
    if (isset($row['login'])) {
        $_SESSION['Profile'] = $row['login'];
        if ($row['grup'] > 0) {
            $sql = "SELECT * FROM link";
        } else {
            $sql = "SELECT * FROM link WHERE owner = '$row[login]'";
        }
        $links = $db->connectDB()->query($sql);
        ?>
        <table>
            <tr>
                <td>Длинная ссылка</td>
                <td>Короткая ссылка</td>
                <td>Просмотры</td>
            </tr>
            <?php
            while ($result = $links->fetch_assoc()) {
                echo "<tr><td> " . $result['link'] . "</td><td> " . $result['sort_link'] . " </td><td>" . $result['transition'] . " </td></tr>";
            }
            ?>
        </table>
        <form method="POST" action="profile.php">
            <input name="exit" value="1" type="hidden">
            <input type="submit" value="Выход из профиля"></input>
        </form>
        <br><br>
        <a href="/index.php">Получить ссылку</a>
        <?php

    } else {
        echo "Wrong login or password";
    }
}

if (($_SESSION['Profile'] == null)) {
    ?>

    Аккаунт:
    <form method="POST" action="profile.php">
        <nav>
            <label for="login">Login: </label>
            <input type="text" id="login" name="login" placeholder="login">
        </nav>
        <nav>
            <label for="pass">password: </label>
            <input type="text" name="password" placeholder="password" id="pass">
        </nav>
        <input type="submit" value="Login">
        </nav>
    </form>

    <br><br>
    <a href="/index.php">Получить ссылку</a>
<?php } ?>