<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "top"         => "Filmes",
    "description" => "CADASTRAR NOVO FILME",
    "title"      => "CADASTRAR FILME"
]); ?>
<div class="row ">
    <form action="<?=URL?>/adm/filmes/store" method="post">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="text" name="titulo" id="" required>
                <label for="titulo">Titulo</label>
            </div>

            <div class="col s12 m3  input-field">
                <select name="genero" id="">
                    <option value="" selected disabled>Género</option>
                    <option value="romance">Romance</option>
                    <option value="action">Acção</option>
                    <option value="comedia">Comédia</option>
                    <option value="adventure">Aventura</option>
                </select>
            </div>
            <div class="col s12 m2  input-field">
                <select name="classificacao" id="">
                <option value="" disabled selected>Classificação</option>
                    <option value="18">18+</option>
                    <option value="13">13+</option>
                    <option value="6">6+</option>
                </select>
            </div>
            

        </div>
        <div class="row">
            <div class="col s12 m3  input-field">
                    <input type="number" name="ano" id=""  required min="1000">
                    <label for="ano">Ano</label>
            </div>
            <div class="col s12 m3  input-field">
                    <input type="text" name="capa" id=""  >
                    <label for="ano">FOTO DE CAPA (link)</label>
            </div>
            <div class="col s12 m3  input-field">
                    <input type="number" name="duracao" id=""  min="10" max="999">
                    <label for="duracao">Duração</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m5  input-field">
                <textarea name="descricao" class="materialize-textarea" id="" cols="30" rows="10" required minlength="20"></textarea>
                <label for="ano">Descrição do Filme</label>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="ADICIONAR" class="btn green">
                <a href="<?= URL?>/adm/filmes" class="btn red">VOLTAR</a>
            </div>

            
        </div>
    </form>
</div>