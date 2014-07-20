<?php

function news_comments_get_all($news_id) {
    $sql = '
        SELECT id, name, content, date_added
        FROM comments
        WHERE news_id = '.$news_id;

    $result = db_select($sql);

    return $result;
}

function news_get_all_count() {

    $sql ='
        SELECT news.id, news.title, COUNT(comments.id) as cnt
        FROM news
        LEFT JOIN comments ON news.id = comments.news_id
        GROUP BY news.id
    ';
    $results = db_select($sql);

    return $results;
}

function news_get($id) {

    global $db_connection;

    $sql = '
        SELECT id, title, content, image
        FROM news
        WHERE id = '.$id;

    $res = mysqli_query($db_connection, $sql);
    return mysqli_fetch_assoc($res);

}