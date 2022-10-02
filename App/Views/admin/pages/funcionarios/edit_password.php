<?php $this->layout("adm-template::template",[
    "title"=>"Meu Perfil",
    "top" => "Perfil",
    "description"=>"ALTERAR SENHA"
]); ?>



<div class="row ">
    <form action="" method="post">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="password" name="old_password" id="" >
                <label for="old_password">Senha Anterior</label>
            </div>
            <div class="col s12 m4 input-field">
                <input type="password" name="new_password" id="" >
                <label for="new_password">Nova Senha</label>
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





