<?php $this->layout("adm-template::template",[
    "title"=>"Filmes",
    "top" => "Filmes",
    "description"=>"Lista de Filmes"
]); ?>



<div class="row">
    <a href="<?=URL?>/adm/filmes/create" class="btn ">NOVO FILME</a>
</div>
<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITULO</th>
                        <th>GENERO</th>
                        <th>CLASSIFICACAO</th>
                        <th>ANO</th>
                        <!-- <th>DESCRICAO</th> -->

                    </tr>
                </thead>

                <tbody>
                <?php foreach($filmes as  $dado): ?>
                    <tr>
                        <td><?=$dado->getId()?></td>
                        <td style="max-width: 200px;"><?=$dado->getTitulo()?></td>
                        <td><?=$dado->getGenero()?></td>
                        <td><?=$dado->getClassificacao()?></td>
                        <td><?=$dado->getAno()?></td>
                        <!-- <td style="max-width: 250px;"><?=reduce_string($dado->getDescricao(),100)?></td> -->
                        <td>
                            <a href="<?=URL?>/adm/filmes/<?=$dado->getId()?>/" class="btn btn-floating btn-small blue">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="<?=URL?>/adm/filmes/<?=$dado->getId()?>/sessoes" class="btn green btn-small">
                                ver SESSOES
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
    <ul class="pagination center">
       <!-- /<?php //foreach($links as $link): ?> -->
            <?=$links?>
        <!-- <?php //endforeach;?> -->
    
    </ul>






