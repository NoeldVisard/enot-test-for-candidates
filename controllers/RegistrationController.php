<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\exceptions\FileSystemException;
use app\mappers\UserMapper;
use app\models\User;
use app\services\RegistrationServices;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {
        $body = $request->getBody();
        $registrationServices = new RegistrationServices();
        $response = $registrationServices->register($body["password"], $body["password2"], $body["email"]);
        if ($response === 200) {
            header("Location: http://localhost:8080/login");
        } else {
            // Перевод на страницу регистрации с ошибкой
            header("Location: http://localhost:8080/registration");
        }
    }

    public function registrationPage()
    {
        $template = 'registration';
        $this->render($template);
    }

}