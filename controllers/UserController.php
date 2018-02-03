<?php

class UserController
{
    //Авторизация
    public function actionSignIn($params = false)
    {
        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/signin");

        //Если пользователь уже авторизирован перекидиваем на главную
        if (isset($_SESSION['user'])) {
            header("Location: /");
            exit();
        }

        $name = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['inputName'];
            $password = $_POST['inputPassword'];
            $errors = false;

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);
            if ($userId == false) {

                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            }

            if ($errors == false) {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                // Перенаправляем пользователя в на главную страницу с правами админа
                header("Location: /");
            }
        }

        require_once(ROOT . '/views/site/signin.php');
        return true;
    }

    //LogOut
    public function actionLogout($params = false)
    {
        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/signin");
        unset($_SESSION['user']);
        header("Location: /signin");
        return true;
    }
}