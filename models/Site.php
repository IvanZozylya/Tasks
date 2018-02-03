<?php

class Site
{
    const SHOW_BY_DEFAULT = 3;

    //Проверка url
    public static function urlVerify($params, $url)
    {
        if ($params == true) {
            header("Location: " . $url);
            exit();
        }

    }

    //получаем количество записей tasks по id
    public static function getCountTasksId()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM tasks ');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    //вывод всех tasks
    public static function getTasks($page = 1)
    {

        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();
        $tasks = array();
        $result = $db->query("SELECT `id`, `name`,`email`,`text`,`img`,`status` FROM tasks "
            . "ORDER BY `id` DESC "
            . "LIMIT " . self::SHOW_BY_DEFAULT
            . ' OFFSET ' . $offset);

        $i = 0;

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $tasks[$i] = $row;
            $i++;
        }

        return $tasks;
    }

    //Добавление новой task
    public static function addNewTask($name, $email, $text, $img, $status)
    {

        $db = Db::getConnection();
        $sth = $db->prepare('INSERT INTO tasks (`name`,`email`,`text`,`img`,`status`) VALUES (:name,:email,:text,:img,:status)');
        $params = array(
            'name' => $name,
            'email' => $email,
            'text' => $text,
            'img' => $img,
            'status' => $status,
        );
        $sth->execute($params);


    }

    //вывод одной task
    public static function getShowItemTask($id)
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM tasks WHERE id = " . $id);
        return $row = $result->fetch(PDO::FETCH_ASSOC);
    }

    //Редактирование task
    public static function editTask($status, $text, $id)
    {

        $db = Db::getConnection();
        $sth = $db->prepare('UPDATE `tasks` SET `status`=:status,`text`=:text
                WHERE id=:id');

        $params = array(
            'status' => $status,
            'text' => $text,
            'id' => $id,
        );
        $sth->execute($params);


    }
}