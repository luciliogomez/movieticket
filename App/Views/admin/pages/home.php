<?php  use App\Utils\Session;?>
<?php $this->layout("adm-template::template",[
    "title" => "MOVIE TICKETS"
]);

?>
<div class="row ">

    <div class="cards ">
        <div class="col s12 m3 ">
            <div class="card red white-text" >
                <div class="card-content">
                    <h5>Filmes</h5>
                    <h4><?=$filmes?></h4>
                </div>
            </div>
        </div>
    
        <div class="col s12 m3 ">
            <div class="card blue white-text" >
                <div class="card-content">
                    <h5>Reservas</h5>
                    <h4><?=$reservas?></h4>
                </div>
            </div>
        </div>
    
        <div class="col s12 m3 ">
            <div class="card green white-text" >
                <div class="card-content">
                    <h5>Sessões</h5>
                    <h4><?=$sessoes?></h4>
                </div>
            </div>
        </div>
        
        
        <?php if(Session::get("usuario")['nivel']=="admin"):?>
            <div class="col s12 m3 ">
                <div class="card grey white-text" >
                    <div class="card-content">
                        <h5>Funcionarios</h5>
                        <h4><?=$funcionarios?></h4>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
