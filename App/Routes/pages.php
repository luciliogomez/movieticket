<?php

use App\Controllers\Pages\Candidato;
use App\Controllers\Pages\Cidade;
use App\Controllers\Pages\Filme;
use App\Controllers\Pages\Cinema;
use App\Controllers\Pages\Reserva;  
use App\Controllers\Pages\Funcionario;
use App\Http\Response;
use App\Controllers\Pages\Home;
use App\Controllers\Pages\Login;
use App\Controllers\Pages\Sessao;
use App\Controllers\Pages\Vaga;
use App\Utils\View;



$router->get("/",[
    function($request){
        return new Response(200,Home::index($request));
    }
]);
$router->get("/filme/{idFilme}/sessoes/cinema/{idCinema}",[
    function($idFilme,$idCinema,$request){
        return new Response(200,Home::getSessoesOnCinema($idFilme,$idCinema,$request),"text/json");
    }
]);

$router->get("/filme/{id}/",[
    function($id,$request){
        return new Response(200,Home::showMovie($id,$request));
    }
]);
// Home::getSessoesOnCinema($idFilme,$idCinema,$request),"text/json"


$router->post("/filter",[
    function($request){
        return new Response(200,Home::filter($request));
    }
]);

$router->get("/filter",[
    function($request){
        return new Response(200,Home::filter($request));
    }
]);

$router->get("/sessoes/{id}/lugares",[
    function($id,$request){
        return new Response(200,Sessao::getLugaresDaSessao($id,$request),"text/json");
    }
]);


// ROTAS PARA O PAINEL DE ADMINISTRAÇÃO

$router->get("/adm",[
    function($request){
        return new Response(200,Home::dashboard());
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/login",[
    function($request){
        return new Response(200,View::render("adm-login::login",["email"=>'',"password"=>'',"status"=>''] ));
    },
    "middlewares"=>[
        "require-logout"
    ]
]);

$router->post("/adm/login",[
    function($request){
        return new Response(200,Login::setLogin($request));
    },
    "middlewares"=>[
        "require-logout"
    ]
]);


$router->get("/adm/logout",[
    function($request){
        return new Response(200,Login::setLogout($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


// Rotas para fimes
$router->get("/adm/filmes",[
    function($request){
        return new Response(200,Filme::index($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->get("/adm/filmes/create",[
    function($request){
        return new Response(200,Filme::create($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/adm/filmes/store",[
    function($request){
        return new Response(200,Filme::store($request),"text/json");
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/filmes/{id}/",[
    function($id,$request){
        return new Response(200,Filme::show($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/filmes/{id}/edit",[
    function($id,$request){
        return new Response(200,Filme::edit($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);
$router->post("/adm/filmes/update",[
    function($request){
        return new Response(200,Filme::update($request),"text/json");
    },
    "middlewares"=>[
        "require-login"
    ]
]);




// Rotas para sessoes e filmes em sessoes 

$router->get("/adm/sessoes",[
    function($request){
        return new Response(200,Sessao::getAllSessoes($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);



$router->get("/adm/filmes/{id}/sessoes",[
    function($id,$request){
        return new Response(200,Filme::getSessoes($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/sessoes/{id_filme}/create",[
    function($id_filme,$request){
        return new Response(200,Sessao::create($id_filme,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/filmes/exibicao",[
    function($request){
        return new Response(200,Filme::getFilmesEmExibicao($request),"text/json");
    }
]);


$router->post("/adm/sessoes/store",[
    function($request){
        return new Response(200,Sessao::storeSessao($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

// Rotas para reservas

$router->get("/adm/reservas",[
    function($request){
        return new Response(200,Reserva::index($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/reservas/store",[
    function($request){
        return new Response(200,Reserva::store($request),"text/json");
    }
]);

$router->get("/recibo/{id}/",[
    function($id,$request){
        return new Response(200,Reserva::getRecibo($id,$request),"text/json");
    }
]);


$router->get("/adm/bilhetes/{id}/",[
    function($id,$request){
        return new Response(200,Reserva::getBilhetes($id,$request));
    }
]);

$router->get("/adm/reservas/{id}/cancelar",[
    function($id,$request){
        return new Response(200,Reserva::cancel($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/reservas/actualizar",[
    function($request){
        return new Response(200,Reserva::update($request),"text/json");
    }
]);


$router->get("/adm/reservas/{id}/confirmar",[
    function($id,$request){
        return new Response(200,Reserva::confirm($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/historico/{id}/",[
    function($id,$request){
        return new Response(200,Reserva::history($id,$request),"text/json");
    }
]);


$router->post("/adm/reservas/filter",[
    function($request){
        return new Response(200,Reserva::filter($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->get("/adm/reservas/filter",[
    function($request){
        return new Response(200,Reserva::filter($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


//////////////////////////////////////////////////////////////


// Rotas para cinemas 


$router->get("/adm/cinemas",[
    function($request){
        return new Response(200,Cinema::index($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/cinemas/{id}/",[
    function($id,$request){
        return new Response(200,Cinema::show($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);
$router->get("/adm/cinemas/create",[
    function($request){
        return new Response(200,Cinema::create($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/adm/cinemas/store",[
    function($request){
        return new Response(200,Cinema::store($request),"text/json");
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->get("/adm/cinemas/{id}/nova-sala",[
    function($id,$request){
        return new Response(200,Cinema::create_sala($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/adm/cinemas/{id}/nova-sala",[
    function($id,$request){
        return new Response(200,Cinema::add_sala($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/salas/{id}/edit",[
    function($id,$request){
        return new Response(200,Cinema::edit_sala($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/adm/salas/update",[
    function($request){
        return new Response(200,Cinema::update_sala($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->post("/cinemas/{id}/update",[
    function($id,$request){
        return new Response(200,Cinema::update($id,$request),"text/json");
    }
]);

$router->get("/cinemas/{id}/salas",[
    function($id,$request){
        return new Response(200,Cinema::get_salas($id,$request));
    }
]);

$router->post("/salas/store",[
    function($request){
        return new Response(200,Cinema::add_sala(1,$request),"text/json");
    }
]);

$router->get("/salas/{id}/lugares",[
    function($id,$request){
        return new Response(200,Cinema::get_lugares($id,$request),"text/json");
    }
]);



//////////////////////////////////////////////////////////////

// Rotas para cidades e ruas

$router->get("/adm/cidades",[
    function($request){
        return new Response(200,Cidade::list($request));
    }
]);

$router->get("/adm/cidades/create",[
    function($request){
        return new Response(200,Cidade::create($request));
    }
]);

$router->post("/adm/cidades/store",[
    function($request){
        return new Response(200,Cidade::store($request));
    }
]);

$router->get("/adm/cidades/{id}/",[
    function($id,$request){
        return new Response(200,Cidade::load($id,$request));
    }
]);
$router->get("/adm/cidades/{id}/nova-rua",[
    function($id,$request){
        return new Response(200,Cidade::add_rua($id,$request));
    }
]);

$router->post("/adm/cidades/{id}/nova-rua",[
    function($id,$request){
        return new Response(200,Cidade::new_street($id,$request));
    }
]);

$router->get("/cidades",[
    function($request){
        return new Response(200,Cidade::index($request),"text/json");
    }
]);

$router->get("/cidades/{id}/",[
    function($id,$request){
        return new Response(200,Cidade::show($id,$request),"text/json");
    }
]);


$router->post("/cidades/store",[
    function($request){
        return new Response(200,Cidade::store($request),"text/json");
        }
]);

$router->get("/cidades/{id}/ruas",[
    function($id,$request){
        return new Response(200,Cidade::ruas($id,$request));
    }
]);

$router->get("/ruas",[
    function($request){
        return new Response(200,Cidade::all_ruas($request));
    }
]);


$array = [];



// ROTA PARA FUNCIONARIOS E UTILIZADORES



// Rotas para funcionarios e autenticacao
$router->get("/adm/funcionarios",[
    function($request){
        return new Response(200,Funcionario::index($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/funcionarios/create",[
    function($request){
        return new Response(200,Funcionario::create($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/adm/funcionarios/store",[
    function($request){
        return new Response(200,Funcionario::store($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->get("/adm/funcionarios/{id}/edit",[
    function($id,$request){
        return new Response(200,Funcionario::edit($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->post("/adm/funcionarios/update",[
    function($request){
        return new Response(200,Funcionario::update($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);



$router->get("/adm/perfil",[
    function($request){
        return new Response(200,Funcionario::perfil($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->get("/adm/perfil/update",[
    function($request){
        return new Response(200,Funcionario::edit_perfil($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->get("/adm/funcionarios/{id}/delete",[
    function($id,$request){
        return new Response(200,Funcionario::delete($id,$request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);
$router->post("/adm/perfil/update",[
    function($request){
        return new Response(200,Funcionario::update_perfil($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);


$router->get("/adm/perfil/change_password",[
    function($request){
        return new Response(200,Funcionario::edit_password($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);

$router->post("/adm/perfil/change_password",[
    function($request){
        return new Response(200,Funcionario::change_password($request));
    },
    "middlewares"=>[
        "require-login"
    ]
]);
