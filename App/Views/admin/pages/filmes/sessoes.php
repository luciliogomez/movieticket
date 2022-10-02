<?php $this->layout("adm-template::template",[
    "title"=>$filme->getTitulo()." - Sessões",
    "top" => "Sessões",
    "description"=>$filme->getTitulo()." - <b>Sessões</b>"
]); ?>



<div class="row">
    <a href="<?=URL?>/adm/sessoes/<?=$filme->getId()?>/create" class="btn ">NOVA SESSÃO</a>
</div>
<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CINEMA</th>
                        <th>SALA</th>
                        <th>DATA</th>
                        <th>PRECO</th>
                        <th>LUGARES LIVRES</th>

                    </tr>
                </thead>

                <tbody>
                <?php foreach($sessoes as  $dado): ?>
                    <tr>
                        <td><?=$dado['ID']?></td>
                        <td><?=$dado['CINEMA']?></td>
                        <td><?=$dado['SALA']?></td>
                        <td><?=$dado['DATA']?></td>
                        <td><?=$dado['PRECO']?></td>
                        <td><?=$dado['LUGARES DISPONIVEIS']?></td>
                        <!-- <td>
                            <a href="<?=URL?>/adm/filmes/<?=$cinema["ID_FILME"]?>/show" class="btn btn-floating blue">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td> -->
                    </tr>
                <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
    <ul class="pagination center">
       <!-- /<?php //foreach($links as $link): ?> -->
            
        <!-- <?php //endforeach;?> -->
    
    </ul>






