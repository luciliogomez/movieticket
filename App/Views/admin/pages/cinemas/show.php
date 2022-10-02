<?php $this->layout("adm-template::template",[
    "title"=>$cinema['NOME'],
    "top" => "Cinemas",
    "description"=>"<b>".$cinema['NOME']."</b> - Gerir Cinema"
]); ?>



<div class="row">
    <a href="<?=URL?>/adm/cinemas/<?=$cinema['ID_CINEMA']?>/nova-sala" class="btn ">NOVA SALA</a>
</div>
<div class="tabela">
        <div class="col s12 ">
            <table class="table responsive-table bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NUMERO</th>
                        <th>CAPACIDADE</th>
                        <th>ACÇÕES</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($salas as  $dado): ?>
                    <tr>
                        <td><?=$dado['id_sala']?></td>
                        <td><?=$dado['numero']?></td>
                        <td><?=$dado['capacidade']?></td>
                        <td>
                            <a href="<?=URL?>/adm/salas/<?=$dado["ID_SALA"]?>/edit" class="btn btn-floating blue">
                                <i class="fa fa-edit"></i>
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






