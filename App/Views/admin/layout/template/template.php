<?php  use App\Utils\Session;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/materialize/css/materialize.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/dashboard.css">
    <title><?=$title?></title>
</head>
<body>
    <div class="all row">
        <!-- MENU DE NAVEGACAO LATERAL -->
        <div class="navigation col s2 ">
    <div class="logo center white-text">
        <span class="light"><i class="fa fa-pencil fa-1x"></i>MOVIETICKET</span>
    </div>
    <div class="list-group white-text">
        <a href="<?=URL?>/adm" class="list-group-item white-text"><i class="fa fa-home fa-fw" aria-hidden="true"></i>
            Home
        </a>
        
        <a href="<?=URL?>/adm/filmes" class="list-group-item white-text"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
            Filmes
        </a>

        <a href="<?=URL?>/adm/sessoes" class="list-group-item white-text"><i class="fa fa-book fa-fw" aria-hidden="true"></i>
            Sessoes
        </a>

        <a href="<?=URL?>/adm/reservas" class="list-group-item white-text"><i class="fa fa-list fa-fw" aria-hidden="true"></i>
            Reservas
        </a>
        <?php if(Session::get("usuario")['nivel']=="admin"):?>
        <a href="<?=URL?>/adm/cinemas" class="list-group-item white-text"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>
            Cinemas
        </a>
        <a href="<?=URL?>/adm/funcionarios" class="list-group-item white-text"><i class="fa fa-user fa-fw" aria-hidden="true"></i>
            Funcionarios
        </a>
        <a href="<?=URL?>/adm/cidades" class="list-group-item white-text"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
            Cidades
        </a>
        <?php endif; ?>
        <a href="<?=URL?>/adm/perfil" class="list-group-item white-text"><i class="fa fa-user fa-fw" aria-hidden="true"></i>
            Meu Perfil
        </a>
        
        <a href="<?=URL?>/adm/logout" class="list-group-item white-text"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i>
            Sair
        </a>
    </div>
</div>
        
        <!-- CONTEUDO PRINCIPAL -->
        <div class="content col s10 push-s2">
            <!-- Pequeno conteudo no topo -->
            <div class="top-content white">
                <span class=""><i class="fa fa-home"></i> Cineticket > <?=$top??'Home'?></span>
            </div>

            <div class="main-content white">
                <!-- Tema descritivo da Pagina -->
                <div class="content-description z-depth-1">
                    <h4><?=$description??"Página de Administração"?></h4>
                </div>

                <!-- Corpo do conteudo principal -->
                <div class="content-body">

                    <!-- Put your content here -->
                    <?= $this->section("content") ?>     

                    

                </div>
            </div>
        </div>
    </div>
    <?php if(Session::has("error") || Session::has("sucess")): ?>
                <!-- Modal Structure -->
                <div id="modals" class="modal">
                <div class="modal-content">
                    <?php if(Session::has("error")): ?>
                        <h5 class="red-text center"><?=Session::free("error")?></h5>
                    <?php elseif(Session::has("sucess")):?>
                        <h5 class="green-text center"><?=Session::free("sucess")?></h5>
                    <?php endif;?>
                </div>
                <div class="modal-footer">
                    <a href="#" class="modal-close waves-effect waves-green btn-flat">OK</a>
                </div>
                </div>
            <?php endif; ?>
    <script src="<?=URL?>/resources/assets/jquery-3.3.1.min.js"></script>
    <script src="<?=URL?>/resources/assets/materialize/js/materialize.js"></script>
    <script>
        $('select').material_select();
        
        // var erro = document.getElementsByClassName('erro')[0];
        // setTimeout(() => {
        //     erro.innerHTML('');
        // }, 10000);

        // modals
        $(document).ready(function(){
                $('.modal').modal();
        });


    </script>
    <script>
            $(document).ready(function(){
                $('#modals').modal('open');
            });
    </script>

  
  
</body>
</html>