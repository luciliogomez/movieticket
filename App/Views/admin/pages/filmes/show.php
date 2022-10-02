<?php $this->layout("adm-template::template",[
    "title"=>$filme->getTitulo(),
    "top" => "Filmes",
    "description"=>$filme->getTitulo()
]); ?>

<div class=" ">
    <div class="row">
        <div class="row show" style="padding:5px">
            <div class="col s12 m4 push-m2 l3 push-l2">
                <div style="border: 1px solid gray;padding:5px;min-height:280px">
                    <figure>
                        <img src="<?=$filme->getCapa()?>" alt="" style="width: 100%;">
                    </figure>    
                </div>
            </div>
            <div class="col s12 m5 push-m2" style="font-size: 1rem;">
                <h5 style="font-size: 1.2rem;">Titulo: <span style="font-weight: bolder;"><?=$filme->getTitulo()?></span></h5>
                <h5 style="font-size: 1.2rem;">Genero: <span style="font-weight: bolder;"><?=strtolower($filme->getGenero())?></span></h5>
                <h5 style="font-size: 1.2rem;">Classificacao: <span style="font-weight: bolder;"><?=$filme->getClassificacao()?></span> </h5>
                <h5 style="font-size: 1.2rem;">Ano: <span style="font-weight: bolder;"><?=$filme->getAno()?></span> </h5>
                <p style="text-align: justify"><?=$filme->getDescricao()?></p>
               
            </div>
        </div>
        <div class="row center">
            <div class="col s12">
                <a href="<?=URL?>/adm/filmes/<?=$filme->getId()?>/edit" style="margin-right: 2%;" class="btn blue">EDITAR</a>
            </div>
        </div>
    </div>
</div>






