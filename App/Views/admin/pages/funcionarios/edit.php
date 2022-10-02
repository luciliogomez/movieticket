<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "top"         => "Funcionarios",
    "description" => "EDITAR FUNCIONARIO",
    "title"      => "EDITAR FUNCIONARIO"
]); ?>
<div class="row ">
    <form action="<?=URL?>/adm/funcionarios/update" method="post">
    <input type="hidden" name="id" value="<?=$funcionario['ID_FUNCIONARIO']?>">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="text" name="nome" id="" value="<?=$funcionario['NOME']?>">
                <label for="nome">Nome</label>
            </div>
            <div class="col s12 m4 input-field">
                <input type="email" name="email" id="" value="<?=$funcionario['EMAIL']?>">
                <label for="email">Email</label>
            </div>
            
            <div class="col s12 m4 input-field">
                <input type="password" name="senha" id="" value="<?=$funcionario['SENHA']?>" > 
                <label for="senha">Senha</label>
            </div>
            

        </div>
        <div class="row">
        
        <div class="col s12 m3  input-field">
                <select name="nivel" id="">
                    <option value="" selected disabled>Nivel</option>
                    <option value="admin" <?=($funcionario['NIVEL']=='admin')?'selected':''?> >Admin</option>
                    <option value="user" <?=($funcionario['NIVEL']=='user')?'selected':''?>>User</option>
                </select>
        </div>
        <div class="col s12 m3  input-field">
                <select name="id_cinema" id="">
                    <option value="" selected disabled>Cinema</option>
                    <?php foreach($cinemas as $dado): ?>
                        <option value=<?=$dado['ID_CINEMA']?> <?=($funcionario['ID_CINEMA']==$dado['ID_CINEMA'])?'selected':''?> ><?=$dado['NOME']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="GUARDAR" class="btn green">
                <a href="<?= URL?>/adm/funcionarios" class="btn red">VOLTAR</a>
            </div>

            
        </div>
    </form>
</div>