<?php

use App\Utils\Session;

 $this->layout("adm-template::template",[
    "top"         => "Filmes",
    "description" => "EDITAR FILME - <span class='boldd'>{$filme->getTitulo()}</span>",
    "title"      => $filme->getTitulo()
]); ?>
<div class="row ">
    <form action="<?=URL?>/adm/filmes/update" method="post">
    <input type="hidden" name="id_filme" value="<?=$filme->getId()?>">
        <div class="row">

            <div class="col s12 m4 input-field">
                <input type="text" name="titulo" id="" value="<?=$filme->getTitulo()?>" required >
                <label for="titulo">Titulo</label>
            </div>

            <div class="col s12 m3  input-field">
                <select name="genero" id="">
                    <option value="romance" <?=($filme->getGenero()=='romance')?'selected':''?> >Romance</option>
                    <option value="accao" <?=((strtolower($filme->getGenero())=='accao')||(strtolower($filme->getGenero())=='action') )?'selected':''?>>Acção</option>
                    <option value="animacao" <?=((strtolower($filme->getGenero())=='animacao')||(strtolower($filme->getGenero())=='animation') )?'selected':''?>>Animação</option>
                    <option value="comedia" <?=((strtolower($filme->getGenero())=='comedia')||(strtolower($filme->getGenero())=='comedy') )?'selected':''?>>Comédia</option>
                    <option value="aventura" <?=((strtolower($filme->getGenero())=='aventura')||(strtolower($filme->getGenero())=='adventure') )?'selected':''?>>Aventura</option>
                    <option value="drama" <?=((strtolower($filme->getGenero())=='drama')||(strtolower($filme->getGenero())=='drama') )?'selected':''?>>Drama</option>
                    <option value="familia" <?=((strtolower($filme->getGenero())=='familia')||(strtolower($filme->getGenero())=='family') )?'selected':''?>>Família</option>
                    <option value="terror" <?=((strtolower($filme->getGenero())=='terror')||(strtolower($filme->getGenero())=='terror') )?'selected':''?>>Terror</option>
                    <option value="horror" <?=((strtolower($filme->getGenero())=='horror')||(strtolower($filme->getGenero())=='horror') )?'selected':''?>>Horror</option>
                </select>
            </div>
            <div class="col s12 m2  input-field">
                <select name="classificacao" id="">
                    <option value="18" <?=($filme->getClassificacao()=='18')?'selected':''?>>18+</option>
                    <option value="13" <?=($filme->getClassificacao()=='13')?'selected':''?>>13+</option>
                    <option value="6" <?=($filme->getClassificacao()=='6')?'selected':''?>>6+</option>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col s12 m3  input-field">
                    <input type="number" name="ano" id="" value="<?=$filme->getAno()?>" required min="1000">
                    <label for="ano">Ano</label>
            </div>
            <div class="col s12 m3  input-field">
                    <input type="text" name="capa" id="" value="<?=$filme->getCapa()?>" >
                    <label for="ano">FOTO DE CAPA (link)</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m5  input-field">
                <textarea name="descricao" class="materialize-textarea" id="" cols="30" rows="10" 
                required minlength="20"><?=$filme->getDescricao()?></textarea>
                <label for="ano">Descrição do Filme</label>
            </div>
        </div>
        <div class="row center">

            <div class="col s12 input-field ">
                <input type="submit" name="add" id="" value="GUARDAR" class="btn green">
                <a href="<?= URL?>/adm/filmes" class="btn red">VOLTAR</a>
            </div>

            
        </div>
    </form>
</div>