<?php $this->layout("adm-template::template",[
    "title"=>"Meu Perfil",
    "top" => "Perfil",
    "description"=>"Editar Meu Perfil"
]); ?>



<div class="row ">
    <form action="" method="post">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="text" name="nome" id="" value="<?=$usuario['nome']?>">
                <label for="nome">Nome</label>
            </div>
            <div class="col s12 m4 input-field">
                <input type="email" name="email" id="" value="<?=$usuario['email']?>">
                <label for="email">Email</label>
            </div>
            

        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="GUARDAR" class="btn green">
                <a href="<?= URL?>/adm/perfil" class="btn red">VOLTAR</a>
            </div>

            
        </div>
    </form>
</div>





