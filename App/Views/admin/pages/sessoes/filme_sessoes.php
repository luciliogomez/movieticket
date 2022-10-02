<?php $this->layout("adm-template::template",[
    "title"=>"SESSOES",
    "top" => "SESSOES",
    "description"=>"Sessões de - <b>".$filme['TITULO']."</b>"
]); ?>



<div class="row">
    <a href="<?=URL?>/adm/filmes/create" class="btn ">NOVA SESSÃO</a>
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
                        <th>HORA</th>
                        <th>PRECO</th>
                        <th>LUGARES DISPONÍVEIS</th>

                    </tr>
                </thead>

                <tbody>
                <?php foreach($sessoes as  $dado): ?>
                    <tr>
                        <td><?=$dado['ID']?></td>
                        <td><?=$dado['CINEMA']?></td>
                        <td><?=$dado['SALA']?></td>
                        <td><?=$dado['DATA']?></td>
                        <td><?=$dado['HORA']?></td>
                        <td><?=$dado['PRECO']?></td>
                        <td><?=$dado['DISPONIVEIS']?></td>
                        <td>
                            <a href="<?=URL?>/adm/filmes/<?=$cinema["ID_FILME"]?>/show" class="btn btn-floating blue">
                                <i class="fa fa-eye"></i>
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






