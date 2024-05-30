<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php

include 'Layer.php';
head("Main");
session_start();

// if ($_SERVER["REQUEST_URI"] != '/index.php') {
//     header('Location: http://la2interlude.com/profile.php');
// }



if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['conf_pass'])) {

    if (strnatcasecmp($_POST['password'], $_POST['conf_pass']) != 0) {
        echo "different passwords";
    } else {
        $db = new Database();
        $sql = "SELECT * FROM users WHERE login = '$_POST[login]'";
        $result = $db->connectDB()->query($sql);
        if ($result->num_rows == 0) {
            $_SESSION['Profile'] = $_POST['login'];
            $sql = "INSERT INTO users VALUES('', '$_POST[login]', '$_POST[password]', 0, NOW())";
            $result = $db->connectDB()->query($sql);
        } else { ?>
            <script>
                alert("User alredy exist");
            </script>
            <?php
        }
    }
}


if (!isset($_SESSION['Profile']) || $_SESSION['Profile'] == null) {
    ?>
    Для получение ссылки нужно зарегистрироваться или зайти в профиль:
    <form method="POST" action="index.php">
        <nav>
            <label for="login">Login: </label>
            <input type="text" id="login" name="login" placeholder="login">
        </nav>
        <nav>
            <label for="pass">password: </label>
            <input type="text" name="password" placeholder="password" id="pass">
        </nav>
        <nav>
            <label for="conf_pass">confirm password: </label>
            <input type="text" name="conf_pass" placeholder="confirm password" id="conf_pass">
            <nav>
                <input type="submit" value="Register">
            </nav>
    </form>
    <br><br>
    <a href="/profile.php">Зайти в профиль</a>
    <?php
} else {
    ?>


    <div class="form_get_link">
        Получить короткую ссылку:
        <form method="POST">
            <nav>
                <label for="link">Insert link: </label>
                <input type="text" id="link_insert" name="link" placeholder="link">
            </nav>
            <input type="hidden" id="login_get" name="login" value="<?= $_SESSION['Profile'] ?>">
            <nav>
                <input onclick="getLink()" type="submit" value="Получить ссылку">
            </nav>
        </form>
    </div>
    <div id="short_link"></div>
    <div class="get_new_link"><a href="/">Получить новую ссылку</a></div>
    <br><br>
    <a href="/profile.php">Зайти в профиль</a>
<?php } ?>


<script>
    function getLink() {
        event.preventDefault();
        var login = document.getElementById('login_get').value;
        var link = document.getElementById('link_insert').value;
        if (!link) {
            alert('insert link adress');
            return;
        }
        $.ajax({
            type: "POST",
            url: "api.php",
            data: {
                task: "getLink",
                link: link,
                login: login
            },
            success: function (msg) {
                var x = JSON.parse(msg);
                let y = x.link;
                var forma = document.querySelector('.form_get_link');
                var new_link = document.querySelector('.get_new_link');
                forma.style.display = 'none';
                new_link.style.display = 'block';
                document.getElementById('short_link').innerHTML = "Short-link: " + y;
            }, error: function (jqXHR, textStatus) {
                alert('Error');
            }
        }

        );
    }
</script>