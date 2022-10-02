<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "top"         => "Funcionarios",
    "description" => "CADASTRAR NOVO FUNCIONARIO",
    "title"      => "CADASTRAR FUNCIONARIO"
]); ?>
<div class="row ">
    <form action="<?=URL?>/adm/funcionarios/store" method="post">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="text" name="nome" id="">
                <label for="nome">Nome</label>
            </div>
            <div class="col s12 m4 input-field">
                <input type="email" name="email" id="">
                <label for="email">Email</label>
            </div>
            <div class="col s12 m3  input-field">
                <select name="nivel" id="">
                    <option value="" selected disabled>Nivel</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

        </div>
        <div class="row">
        <div class="col s12 m3  input-field">
                <select name="id_cinema" id="">
                    <option value="" selected disabled>Cinema</option>
                    <?php foreach($cinemas as $dado): ?>
                        <option value=<?=$dado['ID_CINEMA']?>><?=$dado['NOME']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="ADICIONAR" class="btn green">
                <a href="<?= URL?>/adm/funcionarios" class="btn red">VOLTAR</a>
            </div>

            
        </div>
    </form>
</div>