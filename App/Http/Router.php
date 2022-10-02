<?php
namespace App\Http;

use App\Utils\View;
use Closure;
use Exception;
use Reflection;
use ReflectionFunction;
use App\Http\Middlewares\Queue as MiddlewareQueue;
class Router{
    private $url;

    private $prefix;

    private $routes = [];

    private $request;

    public function __construct($url)
    {
        $this->url = $url;
        $this->setPrefix();
        $this->request = new Request($this);
    }

    private function setPrefix()
    {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    public function get($route,$params = [])
    {
        $this->addRoute("GET",$route,$params);
    }
    public function post($route,$params = [])
    {
        $this->addRoute("POST",$route,$params);
    }

    public function addRoute($method,$route,$params = [])
    {
        foreach($params as $key => $value)
        {
            if($value instanceof Closure)
            {
                $params['controller'] = $value;
                unset($params[$key]);
            }
        }

        $params['middlewares'] = $params['middlewares'] ?? [];
         
        $params['variables'] = [];
        $patthernVariables = "/{(.*?)}/";
        if(preg_match_all($patthernVariables,$route,$matches))
        {
            $route = preg_replace($patthernVariables,"(.*?)",$route);
            $params['variables'] = $matches[1];
        }

        $patthernRoute = "/^".str_replace("/","\/",$route)."$/";


        $this->routes[$patthernRoute][$method] = $params;
    }

    /**
     * @return Response
     *  */    
    public function run()
    {
        try{

            $route = $this->getActualRoute();

            if(!isset($route['controller'])){
                throw new Exception("ERRO NO SERVIDOR",500);
            }

            $reflection = new ReflectionFunction($route['controller']);
            $args = [];
            foreach($reflection->getParameters() as $parameter => $name){
                
                $parameterName = $name->getName();
                $args[$parameterName] = $route['variables'][$parameterName];
            }

            return (new MiddlewareQueue($route['controller'],$args,$route['middlewares']))->next($this->request);

            // return call_user_func_array($route['controller'],$args);

        }catch(Exception $ex){
            return new Response($ex->getCode(),View::render("error::error",[
                "code" =>   $ex->getCode(),
                "message"=> $ex->getMessage()
            ]));
        }
    }

    public function getActualRoute()
    {
        $uri = $this->getUri();

        $httpMethod = $this->request->getHttpMethod();

        foreach($this->routes as $patthernRoute => $methods)
        {
            if(preg_match($patthernRoute,$uri,$matches)){
                
                if(isset($methods[$httpMethod])){
                    unset($matches[0]);
                    $methods[$httpMethod]['variables'] = array_combine($methods[$httpMethod]['variables'],$matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    return $methods[$httpMethod];

                }else{
                    throw new Exception("METODO NÃO ENCONTRADO",403);
                }
            }
        }
        throw new Exception("PAGINA NÃO ENCONTRADA",404);
    }

    public function getUri()
    {
        $uri = $this->request->getUri();
        $xUri = strlen($this->prefix)? explode($this->prefix,$uri) : [$uri];
        return end($xUri);
    }

    public function redirect($uri)
    {
        $uri = $this->url.$uri;
        header("Location: ".$uri);
        exit;
    }

}