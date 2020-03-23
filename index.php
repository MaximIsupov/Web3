<?php
/**
 * Интернет-программирование. Задача 8.
 * Реализовать скрипт на веб-сервере на PHP или другом языке,
 * сохраняющий в XML-файл заполненную форму задания 7. При
 * отправке формы на сервере создается новый файл с уникальным именем.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
    if (!empty($_GET['save'])) {
        // Если есть параметр save, то выводим сообщение пользователю.
        print('Спасибо, результаты сохранены.');
    }
    // Включаем содержимое файла form.php.
    include('form.php');
    echo "<link rel='stylesheet' href='style.css'>";
    // Завершаем работу скрипта.
    exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['fio'])) {
    print('Вы забыли написать свое имя.<br/>');
    $errors = TRUE;
}

if (empty($_POST['mail'])) {
    print('Вы не заполнили поле e-mail. Пожалуйсте, сделайте это.<br/>');
    $errors = TRUE;
}

if (empty($_POST['year'])) {
    print('Заполните год рождения!<br/>');
    $errors = TRUE;
}

if (empty($_POST['abilities'])) {
    print('Вы позабыли выбрать свою способность!<br/>');
    $errors = TRUE;
}

if (empty($_POST['limps'])) {
    print('Количество конечностей вами не указано...<br/>');
    $errors = TRUE;
}

if (empty($_POST['sex'])) {
    print('Выбор пола не был сделан.<br/>');
    $errors = TRUE;
}

if (empty($_POST['bio'])) {
    print('Биография не расписана((<br/>');
    $errors = TRUE;
}

if (empty($_POST['checkbox'])) {
    print('Галочка напротив поля "Ознакомлен с контрактом" не поставлена((<br/>');
    $errors = TRUE;
}

$abilities=serialize($_POST['abilities']);

//$abilities = serialize($_POST['abilities']);

// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
    // При наличии ошибок завершаем работу скрипта.
    exit();
}

// Сохранение в базу данных.

$user = 'u16350';
$pass = '1871497';
$db = new PDO('mysql:host=localhost;dbname=u16350', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO application SET name = ?, mail = ?, year = ?, abilities = ?, limps = ?, sex = ?, bio = ?, checked = ?");
    $stmt -> execute(array($_POST['fio'], $_POST['mail'], $_POST['year'], $abilities, $_POST['limps'], $_POST['sex'], $_POST['bio'],  $_POST['checkbox']));
}
catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
}

//  stmt - это "дескриптор состояния".

//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(array('label'=>'perfect', 'color'=>'green'));

//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
 $stmt->bindParam(':firstname', $firstname);
 $stmt->bindParam(':lastname', $lastname);
 $stmt->bindParam(':email', $email);
 $firstname = "John";
 $lastname = "Smith";
 $email = "john@test.com";
 $stmt->execute();
 */

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');

