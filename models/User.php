<?php

class User
{
    //Авторизация
    //если true возвращаем его id,если нет - false
    public static function checkUserData($name, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE name = :userName AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':userName', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }

        return false;
    }

    //Запоминаем пользователя в сессию
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    //Loguot
}