<?php
namespace App\Http;

class Request{

    private $uri;
    
    private $httpMethod;

    private $queryParams = [];

    private $postVars = [];

    private $headers = [];

    private $router;

    public function __construct($router)
    {
        $this->setUri();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->queryParams = $_GET;
        $this->postVars = $_POST;
        $this->headers = getallheaders();
        $this->router = $router;
    }

    private function setUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $xUri = explode("?",$uri);
        
        $this->uri = $xUri[0];
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function getPostVars()
    {
        return $this->postVars;
    }

    public function getRouter()
    {
        return $this->router;
    }

}