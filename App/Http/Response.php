<?php
namespace App\Http;

class Response{

    private $httpStatusCode;

    private $contentType;

    private $content;

    private $headers = [];

    public function __construct($statusCode,$content,$contentType = "text/html")
    {
        $this->httpStatusCode = $statusCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    private function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeaders("Content-Type",$contentType);
        $this->addHeaders("Access-Control-Allow-Origin","*");
    }

    private function addHeaders($key,$value)
    {
        $this->headers[$key] = $value;
    }

    private function sendHeaders()
    {
        http_response_code($this->httpStatusCode);
        foreach($this->headers as $key => $value)
        {
            header($key.": ".$value);
        }
    }

    public function sendResponse()
    {
        $this->sendHeaders();
        switch($this->contentType)
        {
            case "text/html":
                echo $this->content;
                exit;
                break; 
            case "text/json":
                echo json_encode($this->content);
                exit;
                break;
        }
    }
}