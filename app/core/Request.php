<?php

namespace App\Core;

use App\Core\Traits\ValidationTools;

class Request implements Interfaces\RequestParams
{
    use ValidationTools;

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $get;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $post;

    /**
     * @var string
     */
    private $root;

    /**
     * @var array
     */
    private $files;

    /**
     * @var string
     */
    private $serverPath;

    /**
     * @var bool
     */
    private $verifiedCsrf = false;


    /**
     * @return array
     */
    public function get(): array
    {
        return $this->get;
    }


    /**
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }


    /**
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }


    /**
     * @return array
     */
    public function post(): array
    {
        return $this->post;
    }

    /**
     * @return string
     */
    public function root(): string
    {
        return $this->root;
    }

    /**
     * @return array
     */
    public function files(): array
    {
        return $this->files;
    }

    /**
     * @return string
     */
    public function serverPath(): string
    {
        return $this->serverPath;
    }

    /**
     * @return bool
     */
    public function verifiedCsrf(): bool
    {
        return $this->verifiedCsrf;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method() == 'post' ? true : false;
    }


    /**
     * Request constructor.
     */
    public function __construct()
    {
        $uri = parse_url($_SERVER['REQUEST_URI']);
        parse_str($uri['query'], $getParams);

        $this->get = self::validateStringValuesForArr($getParams);
        $this->post = self::validateStringValuesForArr($_POST);

        if (isset($_POST[Cipher::CSRF_KEY])) {
            $this->verifiedCsrf = Cipher::verificationCsrf($_POST[Cipher::CSRF_KEY]);
        }

        $this->path = $uri['path'];
        $this->method = mb_strtolower($_SERVER['REQUEST_METHOD']);
        $this->root = $_SERVER['DOCUMENT_ROOT'];
        $this->serverPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
        $this->files = $_FILES;
    }
}