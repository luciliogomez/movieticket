<?php $this->layout("adm-template::template",[
    "title"=>"Meu Perfil",
    "top" => "Perfil",
    "description"=>"Meu Perfil"
]); ?>

<div class=" ">
    <div class="row">
        <div class="row show" style="padding:5px">
            <div class="col s12 m4 push-m2 l3 push-l2">
                <div class="pic-book">
                        <i style="font-size:8em;" class="fa fa-user"></i>
                    
                </div>
            </div>
            <div class="col s12 m5 push-m2" style="font-size: 1rem;">
                <h5 style="font-size: 1.4rem;">Nome: <span style="font-weight: bolder;"><?=$usuario['nome']?></span></h5>
                <h5 style="font-size: 1.4rem;">Email: <span style="font-weight: bolder;"><?=$usuario['email']?></span></h5>
                <h5 style="font-size: 1.4rem;">Nivel: <span style="font-weight: bolder;"><?=$usuario['nivel']?></span> </h5>
                <!-- <h5 style="font-size: 1.4rem;">Cinema: <span style="font-weight: bolder;"><?=$usuario['cinema']?></span> </h5> -->
                
               
            </div>
        </div>
        <div class="row center">
            <div class="col s12">
                <a href="<?=URL?>/adm/perfil/update" style="margin-right: 2%;" class="btn blue">EDITAR</a>
                <a href="<?=URL?>/adm/perfil/change_password" style="margin-right: 2%;" class="btn green">ALTERAR SENHA</a>
            </div>
        </div>
    </div>
</div>






