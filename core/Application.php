<?php

declare(strict_types=1);

namespace app\core;

use Exception;
use Psr\Log\LogLevel;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Database $database;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->database = new Database($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    public function run()
    {
        $this->router->resolve();
    }

}