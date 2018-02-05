<?php

class SiteController
{
    //Главная страничка
    public function actionIndex($page = 1)
    {
        //Получить все записи
        $tasks = Site::getTasks($page);

        //получаем количество записей в переменную $total
        $total = Site::getCountTasksId();

        //Создаем обьект пагинатора
        $pagination = new Pagination($total, $page, Site::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/site/index.php');

        return true;
    }

    //Добавление новой tasks
    public function actionCreate($params = false)
    {
        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/task/create");

        //Валидация полей
        if (isset($_POST['submit'])) {
            $name = $_POST['userName'];
            $email = $_POST['email'];
            $text = $_POST['task'];
            $img = '/template/image/' . $_FILES['userfile']['name'];


            //Добавляем новую task в БД и получить ее id
            $last_id = Site::addNewTask($name, $email, $text, $img, 0);

            //Меняем название файла
            $upload = explode(".", $_FILES['userfile']['name']);
            $newFile = $last_id . ".$upload[1]";

            //Путь к файлу
            $uploadFile = ROOT . '/template/image/' . $newFile;

            //Перемещаем файл
            if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadFile)) {

                //Новый путь к файлу в БД
                $image = '/template/image/' .$newFile;

                //Обновить путь image нужной tasks в БД
                Site::editPathImage($last_id,$image);

                //Переадресация на главную страницу
                header("location: /");
            }
        }


        require_once(ROOT . '/views/site/create.php');
        return true;
    }

    //Редактирование tasks
    public function actionEdit($id, $params = false)
    {
        //Проверка на авторизацию
        if (!isset($_SESSION['user'])) {
            header("Location: /signin");
        }

        //Проверка id task
        if (!is_numeric($id)) {
            header("Location: /");
            exit();
        }

        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/");

        $id = intval($id);

        //Получаем нужный task
        $task = Site::getShowItemTask($id);

        if (isset($_POST['save'])) {

            $status = (empty($_POST['status'])) ? $task['status'] : $_POST['status'];
            $text = $_POST['task'];

            //Редактируем task
            Site::editTask($status, $text, $id);
            header("Location: /");
            exit();

        }

        require_once(ROOT . '/views/site/edit.php');
        return true;
    }

    //task/details/$1
    public function actionDetails($id, $params = false)
    {
        //Проверка id task
        if (!is_numeric($id)) {
            header("Location: /");
            exit();
        }

        //Проверяем правильный ли путь в url
        Site::urlVerify($params, "/");

        $id = intval($id);

        //Получаем нужный task
        $task = Site::getShowItemTask($id);


        require_once(ROOT . '/views/site/details.php');
        return true;

    }
}