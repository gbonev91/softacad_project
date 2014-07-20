<?php

function db_select($sql)
{
    global $db_connection;
    $res = mysqli_query($db_connection, $sql);
    $result = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $result[] = $row;
    };
    return $result;
}

function db_insert($table, $data)
{
    global $db_connection;
    $keys = implode(",", array_keys($data));
    foreach ($data as $key => $value) {
        $val[] = '"' . $value . '"';
    }
    $vals = implode(",", $val);
    $buf = mysqli_query(
        $db_connection,
        '
        INSERT INTO '.$table.'('.$keys.')
        VALUES ('.$vals.')'
    );
    return $buf;
}

function db_update($table, $data, $id)
{
    global $db_connection;

    $parts = array();
    foreach ($data as $key => $value) {
        $parts[]= $key.'="'.$value.'"';
    }

    $sql = '
        UPDATE '.$table.'
        SET '.implode(',', $parts).'
        WHERE id = '.$id;
    mysqli_query($db_connection, $sql);
}

function db_delete($table, $id)
{
    global $db_connection;
    $sql = 'DELETE FROM '.$table.' WHERE id = '.$id;
    mysqli_query($db_connection, $sql);
    return true;
}
