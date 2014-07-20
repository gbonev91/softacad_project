<?php

function pages_get($id) {

    global $db_connection;

    $sql = '
        SELECT id, title, content
        FROM pages
        WHERE id = '.$id;

    $res = mysqli_query($db_connection, $sql);
    return mysqli_fetch_assoc($res);

}