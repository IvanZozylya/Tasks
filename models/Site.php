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
    public static function addNewTask($name, $email, $text)
    {

        $db = Db::getConnection();
        $sth = $db->prepare('INSERT INTO tasks (`name`,`email`,`text`) VALUES (:name,:email,:text)');
        $params = array(
            'name' => $name,
            'email' => $email,
            'text' => $text,
        );
        $sth->execute($params);

        $lastId = $db->lastInsertId();
        return $lastId != 0 ? $lastId : false;

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

    //Обновить путь image нужной tasks
    public static function editPathImage($id, $image)
    {
        $db = Db::getConnection();
        $sth = $db->prepare('UPDATE tasks SET `img` = :image WHERE `id` = :id');
        $params = array(
            'id' => $id,
            'image' => $image,

        );
        $sth->execute($params);

    }

    //Проверка на формы на несоответствие или ошибки
    public static function checkModelValidity($name, $email, $text, $filePath)
    {
        $errors = [];

        if (!self::checkEmail($email)) {
            $errors[] = ('Incorrect email');
        }
        if (!self::checkTextMinSize($name)) {
            $errors[] = ('Incorrect name');
        }
        if (!self::checkTextMinSize($text)) {
            $errors[] = ('Incorrect text');
        }
        if (!self::checkImage($filePath)) {
            $errors[] = ("Incorrect image's format. Only png/jpeg/gif formats are supported");
        }

        return $errors;
    }

    //правильность email
    private static function checkEmail($email)
    {
        if (self::cleanStr(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            return true;
        }
        return false;

    }

    //правильность text, не короче 2 символов
    private static function checkTextMinSize($text)
    {

        if (strlen(self::cleanStr($text)) >= 2) {
            return true;
        }
        return false;

    }

    //правильность Image
    private static function checkImage($file)
    {
        $filePath = $file;

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string)finfo_file($fi, $filePath);

        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) {
            return false;
        }

        return true;


    }

    //Валидация строки
    private static function cleanStr($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;

    }


}