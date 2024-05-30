<?php
include 'Layer.php';


if ($_POST['task'] == 'getLink') {
    $link = $_POST['link'];
    $caractere_aleatorii = '';
if (!validateUrl($link)) {
    $invalid_link = [
        'link' => "Invalid link"
    ];
    echo json_encode($invalid_link);
    return;
}
    for ($i = 0; $i < 4; $i++) {
        $caracter_aleatoriu = chr(mt_rand(97, 122));
        $caractere_aleatorii .= $caracter_aleatoriu;
    }
    $sort_link = "http://la2interlude.com/" . $caractere_aleatorii;
    $login = $_POST['login'];
    $db = new Database();

    if (isset($link)) {
        $sql = "INSERT INTO link VALUES('', '$link', '$sort_link', '$login', 0, NOW())";
        $resultInsert = $db->connectDB()->query($sql);
    }
    $masiv = [
        'link' => $sort_link
    ];

    echo json_encode($masiv);

} else {

    $data = file_get_contents('php://input');

    if (isset($data)) {
        $resultInsert = null;
        $res = json_decode($data, true);

        $link = $res['link'];
        for ($i = 0; $i < 4; $i++) {
            $caracter_aleatoriu = chr(mt_rand(97, 122));
            $caractere_aleatorii .= $caracter_aleatoriu;
        }
        $sort_link = "http://la2interlude.com/" . $caractere_aleatorii;
        $owner = $res['login'];
        $db = new Database();

        if (isset($link)) {
            $sql = "INSERT INTO link VALUES('', '$link', '$sort_link', '$owner', 0, NOW())";
            $resultInsert = $db->connectDB()->query($sql);
        }

        echo json_encode($sort_link);

    } else {
        echo " not insert data ";
    }
}

function validateUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}
?>