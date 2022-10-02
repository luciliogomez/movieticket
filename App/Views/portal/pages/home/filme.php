<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$filme->getTitulo()?></title>
    
<script src="https://kit.fontawesome.com/6b4ddefc79.js" ></script>
    <link rel="stylesheet" href="<?=URL?>/resources/assets/tailwind.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/style.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/font-awesome-4.7.0/css/font-awesome.css">
    <style>
        td,th{
            padding: 15px 5px;
            display: table-cell;
            text-align: left;
            vertical-align: middle;
            border-radius: 2px;
            width: auto;
        }
    .mod-sucess,.mod-error{
        display: none;
        position: fixed;
        top: 0;
        /* left: 0; */
        /* right: 0;  */
        background-color: #fff;
        /* padding: 20px; */
        /* max-height: 70%; */ 
        width: 70%;
        margin: auto;
        margin-top: 35%;
        margin-left: 15%;
        /* overflow-y: auto; */
        border-radius: 2px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        /* will-change: top, opacity; */
    }
    
    .mod-sucess,.mod-error .mod-content{
        padding: 20px 30px;
    }
    .mod-sucess,.mod-error .mod-footer{
        padding: 20px 30px;
    }
    .mod{
        display: none;
        position: fixed;
        top: 0;
        /* left: 0; */
        /* right: 0;  */
        background-color: #fff;
        /* padding: 20px; */
        /* max-height: 70%; */ 
        width: 90%;
        margin: auto;
        margin-top: 4%;
        margin-right: 5%;
        /* overflow-y: auto; */
        border-radius: 2px;
        /* will-change: top, opacity; */
        }

    .mod .mod-header{
        padding: 10px 30px;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid gray;
    }
    .mod .mod-header h3{
        font-weight: bolder;
        font-size: 1.3rem;
    }
    .mod .mod-header span{
        font-weight: 500;
        font-size: 1.2rem;
        cursor: pointer;
    }
    .mod .mod-header span:hover{
        font-weight: bolder;
    }
    .mod .mod-content{
        padding: 10px 30px;
    }
    .mod .mod-content .states{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .mod .mod-content .states div{
        display: flex;
        justify-content: end;
        align-items: center;
        margin-right: 20px;
    }
    .mod .mod-content .states div span{
        width: 10px;
        height: 10px;
        margin-left: 10px;
        border-radius: 2px;
    }
    .mod .mod-content .places{
        width: 80%;
        margin: auto;
        margin-top: 2%;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    .mod .mod-content .places .place{
        width: 10% !important;
        padding: 2px 3px;
        color: white;
        border-radius: 2px;
        margin-right: 5%;
        margin-bottom: 5%;
        text-align: center;
        font-size: smaller;
        font-weight: 600;
        cursor:pointer;
    }
    .mod .mod-content .formulario{
        padding: 10px;
    }
    .mod .mod-content .formulario form div{
        padding: 10px;
        width: 100%;
        display: flex !important;
        flex-direction: column !important;
        
    }
    
@media (min-width: 768px) {
    .mod{
        width: 60%;
        margin-left: -10%;
        }
        .mod .mod-content .places{
        width: 50%;
    }
    .mod-sucess,.mod-error{
        
        width: 45%;
        
        margin-left: 35%;
        margin-top: 15%;
    }
}

@media (min-width: 1024px) {
    .mod{
        width: 43%;
        margin-left: 2%;
        }
        .mod-sucess,.mod-error{
        
        width: 35%;
        margin-top: 10%;
    }
    
}



@media (min-width: 668px) {
    .mod .mod-content .states{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: flex-start;
    }
    
    .mod .mod-content .states div{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-right: 20px;
    }
    
}

    .free {
        background-color: grey !important;
    }
    .free:hover{
        background-color: greenyellow;
    }
    .gray{
        background-color: grey !important;
    }
    .ocupado{
        background-color: red;
    }
    .red{
        background-color: red;
    }
    .selecionado{
        background-color: green !important;
    }
    .green{
        background-color: green !important;
    }
        
    </style>
</head>
<body class="w-full">                                                                             
                                                                                <!-- <?=$filme->getCapa() ?> -->
                                                                                <!-- <?=ASSETS?>/img/capas/4.jpg -->
    <header class="w-full min-h-screen md:h-screen  bg-right-top bg-no-repeat big" style="background-image: url(<?=$filme->getCapa()?>);background-repeat:no-repeat;" >
    <!-- black-a-95 bg-black-900/[0.85] -->
        <div class="w-full min-h-screen  md:h-screen bg-gradient-to-r from-blue-500 " style="background: linear-gradient(to left , transparent 0%, black 55%);">
            <nav class="text-white w-full h-1/6 mb-4 content py-6 flex justify-between items-center border-b border-gray-500">
                <div class="logo">
                    <h3 class="flex items-center justify-center">
                        <figure>
                            <!-- <img src="logo.png" alt=""> -->
                        </figure>
                        <span class="font-semibold text-2xl">MOVIE<a href="<?=URL?>" class="text-red-500">TICK</a></span>
                    </h3>
                </div>
                <ul class=" hidden md:flex  md:justify-end md:space-x-8 md:font-semibold">
                    <li class="link"><a href="<?=URL?>">HOME</a></li>
                    <li class="link"><a href="#">FILMES</a></li>
                    <li class="link"><a href="#" class="bg-red-600 hover:bg-red-500 rounded-sm py-1 px-2">LOGIN</a></li>
                </ul> 
                <span id="menu-button" class="text-2xl cursor-pointer md:hidden"><i class="fa fa-bars"></i></span>
                <div id="menu-mobile" class=" hidden mobile-menu fixed w-3/4  top-0 right-0  bg-black h-screen md:hidden opacity-95">
                    <div class="mb-1 p-6">
                        <button id="close-menu" class="text-2xl font-normal p-2 hover:font-bold">x</button>
                    </div>
                    <ul class=" flex flex-col justify-start items-start">
                        <li class="w-full">
                            <a href="<?=URL?>" class="text-2xl px-6 py-2 border-t border-white border-solid block hover:bg-white hover:text-black">
                                <i class="fa fa-home fa-fw mr-2" aria-hidden="true"></i> HOME
                            </a>
                        </li>
                        <li class="w-full">
                            <a href="#filmes" class="text-2xl px-6 py-2 border-t border-white border-solid block hover:bg-white hover:text-black">
                                <i class="fa fa-list fa-fw mr-2" aria-hidden="true"></i> FILMES
                            </a>
                        </li>
                        <li class="w-full">
                            <a href="<?=URL?>/adm/login" class="text-2xl px-6 py-2 border-t border-white border-solid block hover:bg-white hover:text-black">
                                <i class="fa fa-user fa-fw mr-2" aria-hidden="true"></i> LOGIN
                            </a>
                        </li>
                    </ul> 
                </div>   
            </nav>
            <div class="banner content font-semibold h-5/6 flex flex-col items-start justify-center w-100">
                <div class="font-semibold h-5/6 flex flex-col items-center  md:items-start justify-center  md:w-7/12" >
                    <div  class="mb-4">
                    <span class="font-light mr-3.5 text-white px-4 py-1 border border-white rounded-2xl uppercase"  ><?=$filme->getGenero()?></span>
                    <span class="font-light mr-3.5 text-white px-4 py-1 border border-white rounded-2xl uppercase"  ><?=$filme->getAno()?></span>
                    </div>
                    <h1 class=" text-4xl md:text-5xl text-white text-center md:text-left mb-4"><?=$filme->getTitulo()?></h1>
                    <p class="text-1xl text-gray-200 mb-4" style="font-weight: 200;">
                        <?=$filme->getDescricao()?>
                    </p>
                    
                    <a  href="#reservar" class="w-32 mb-4 rounded-md text-md px-4 py-2 text-gray-200 bg-red-500">Reserve Já</a>
                                                
                </div>
                
            </div>
        </div>
    </header>

   

    <div class="last w-full  py-12 px-2 bg-gray-900 text-white ">
        <div class="flex justify-center md:justify-between items-center  font-semibold mb-8 w-full" id="reservar">
            <h3 class=" text-2xl text-center md:text-left">Reserve  seu Bilhete</h3>
        </div>
        <div class="flex justify-center md:justify-start flex-wrap">
            <article class="w-3/5 mr-5 md:w-3/12 lg:w-1/5">
                <figure class="w-full mb-2">
                    <img src="<?=$filme->getCapa()?>" class="w-full h-72" alt="">
                </figure>
            </article>
            <article class="w-full mr-0 md:w-2/3 lg:w-2/3" >
                
                <h3 class="font-semibold text-2xl mb-4"><?=$filme->getTitulo()?></h3>
                <h5><span class="font-semibold">Ano:</span> <?=$filme->getAno()?></h5>
                <h5><span class="font-semibold">Classificação:</span> +<?=$filme->getClassificacao()?></h5>
                <div class="text-black" style="color:black;padding:5px 0;margin-top:8%;">
                    <select name="cinema" id="cinema" class="rounded-sm w-4/5 md:w-full p-2" >
                        <option value="" selected disabled>ESCOLHA O CINEMA</option>
                        <?php foreach($cinemas as $dado): ?>
                            <option value="<?=$dado['ID']?>"><?=$dado['CINEMA']?></option>
                        <?php endforeach; ?>
                    </select>
                    <table class="table-auto" style="margin-top:2%;width: 100%;display:table;border-radius:5px;background-color:white;">
                        <thead style="border-bottom:1px solid grey;">
                            <tr class="text-xs md:text-base">
                                <th>SALA</th>
                                <th>DATA</th>
                                <th>HORA</th>
                                <th>PRECO</th>
                                <th>LUGARES</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody id="sessoes" class="text-xs md:text-base">
                            
                            <div class="mod " id="mod1">
                                <div class="mod-header">
                                    <h3 class="text-sm md:text-base">Selecione os seus lugares e seus dados</h3>
                                    <span href="#" class="close-modal" >x</span>
                                </div>
                                <div class="mod-content  ">
                                        <div class="states">
                                            <div>
                                                <h6>Disponível:</h6><span class="state-color gray"></span>
                                            </div>
                                            <div>
                                                <h6>Ocupado:</h6><span class="state-color red"></span>
                                            </div>
                                            <div>
                                                <h6>Selecionado:</h6><span class="state-color green"></span>
                                            </div>
                                        </div>
                                        <div class="places overflow-y-auto max-h-56 md:max-h-72">
                                            <span class="place ocupado" id="">0</span>
                                            <span class="place free" id="">1</span>
                                            <span class="place free" id="">2</span>
                                            <span class="place free" id="">3</span>
                                            <span class="place free" id="">4</span>
                                            <span class="place free" id="">5</span>
                                            <span class="place free" id="">6</span>
                                            <span class="place free" id="">7</span>
                                            <span class="place free" id="">8</span>
                                            <span class="place free" id="">9</span>
                                            <span class="place free" id="">10</span>
                                            <span class="place free" id="">11</span>
                                            <span class="place ocupado" id="">12</span>
                                            <span class="place free" id="">13</span>
                                            <span class="place free" id="">14</span>
                                            <span class="place ocupado" id="">15</span>
                                            <span class="place ocupado" id="">16</span>
                                            <span class="place free" id="">17</span>
                                            <span class="place free" id="">18</span>
                                            <span class="place free" id="">19</span>
                                            <span class="place free" id="">20</span>
                                            <span class="place free" id="">21</span>
                                            <span class="place free" id="">22</span>
                                            <span class="place free" id="">23</span>
                                            <span class="place free" id="">24</span>
                                            <span class="place free" id="">25</span>
                                            <span class="place free" id="">26</span>
                                            <span class="place free" id="">27</span>
                                            <span class="place free" id="">28</span>
                                            <span class="place free" id="">29</span>
                                            <span class="place free" id="">30</span>
                                            <span class="place free" id="">31</span>
                                            <span class="place free" id="">32</span>
                                            <span class="place free" id="">33</span>
                                            <span class="place free" id="">34</span>
                                            <span class="place free" id="">35</span>
                                            
                                        </div>
                                        <div class="formulario ">
                                            <form action="" method="post" >
                                                <div class="flex flex-col mb-4">
                                                    <input type="hidden" name="lugares">
                                                    <input required placeholder="Seu Nome" type="text" name="nome" id="nome" class="rounded-sm  text-md px-4 py-2 text-gray-400  mb-3 " style="border: 1px solid grey;">
                                                    <input required placeholder="Telefone" type="number" min="900000000" max="999999999" name="telefone" id="telefone" class="rounded-sm text-md px-4 py-2 text-gray-400 " style="border: 1px solid grey;">
                                                    <span class=" text-sm text-red-500 mt-2 message"></span>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="button" id="enviar" class="w-32 rounded-sm text-md px-4 py-2 text-gray-200 green">Reservar</button>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                </div>
            </article>
            
        </div>
    </div>

    <footer class="text-center text-white bg-black content py-8" >
        <h3>Powered By <a href="#" class="text-red-500">Lucilio Gomes</a></h3>
    </footer>
    <div class="mod-sucess" id="">
        <div class="mod-content mb-4 flex flex-col" style="border-bottom: 1px solid grey;">
                <h3 style="text-align: center;font-size:1.5rem;margin-top:5%;margin-bottom:5%;">Reserva Efectuada</h3>
                <i class="fa-light fa-circle-check"></i>
                <i class="fa-light fa-circle-check" style="color:green;font-size:2rem"></i>
                <a href="" class="text-blue-700 text-center text-sm" id="recibo" >imprimir recibo </a>
        </div>
        <div class="mod-footer" style="display:flex;justify-content:center;align-items:center;">
            <button type="button"  class=" close-report w-32 rounded-md text-md px-4 py-2 text-white bg-gray-900 ">FECHAR</button>
        </div>
    </div>
    <div class="mod-error" id="">
        <div class="mod-content mb-4 flex flex-col" style="border-bottom: 1px solid grey;">
                <h3 style="text-align: center;font-size:1.5rem;margin-top:5%;margin-bottom:5%;color:red;">Reserva Não Efectuada</h3>
                <i class="fa-light fa-circle-check"></i>
                <i class="fa-light fa-circle-check" style="color:red;font-size:2rem"></i>
        </div>
        <div class="mod-footer" style="display:flex;justify-content:center;align-items:center;">
            <button type="button"  class="close-report w-32 rounded-md text-md px-4 py-2 text-gray-200 red">OK</button>
        </div>
    </div>


<script src="https://kit.fontawesome.com/6b4ddefc79.js" ></script>
<script src="<?=URL?>/resources/assets/jquery-3.3.1.min.js"></script>

<script src="<?=URL?>/resources/assets/materialize/js/materialize.js"></script>
<script>
var URL = '<?=URL?>';
var places = [];


    $(document).ready(function(){
        $('#menu-button').click(function(e){
            e.preventDefault()
            $('#menu-mobile').removeClass(" hidden ");
        });


        $('#close-menu').click(function(e){
            $('#menu-mobile').addClass(" hidden ");
        });


        $('#cinema').change(function(){
            var idCinema = $('#cinema').val();
            $.ajax({
            url: URL+'/filme/<?=$filme->getId()?>/sessoes/cinema/'+idCinema+'/',
            // url: URL+'/cinemas/'+idCinema+'/salas',
            type: 'get',
            beforeSend:function(){

            },
            success:function(data){
                console.log(data);
                var lines = "";
                // alert(data.length);
                for (let i = 0; i < data.length; i++) {
                    
                    var hora    = data[i].HORA;
                    var preco   = data[i].PRECO;
                    var lugares = data[i].LUGARES_DISPONIVEIS;
                    var sala    = data[i].SALA;
                    var data_   = data[i].DATA;
                    var id      = data[i].ID;
                     
                    lines = lines + "<tr>"+ 
                    "<td>"+sala+"</td>"+
                    "<td>"+data_+"</td>"+
                    "<td>"+hora+"</td>"+
                    "<td>"+preco+"</td>"+
                    "<td>"+lugares+"</td>"+
                    "<td><span  class='btn bg-red-500 modal-trigger' id='"+id+"'  style='padding: 4px 6px;color:wheat;border-radius:5px;cursor:pointer;'>Reservar</span>"+
                    "</td>"+
                    "</tr>";
                    
                }    
                $('#sessoes').html(lines);
                $('.modal-trigger').click(function(e){
                    var id_sessao = $(this).attr('id');
                    showPlaces(id_sessao);
                    $('.mod').fadeIn('1')
                });
               
            },
            error:function(data){
               alert("ERRO AO BUSCAR RUAS");
               console.log(data);
            }
            });
        
       
        });


        $('.close-modal').click(function(e){
            e.preventDefault()
            $('.mod').fadeOut('1');
            places = [];
        });

        $('#enviar').click(function(e){
            e.preventDefault()
            efectuarReserva();
        });


        $('.modal-trigger').click(function(e){
            e.preventDefault()
            $('.mod').fadeIn('1')
        });


        $('.free').click(function(e){
            $(this).removeClass(" free ");
            $(this).addClass(" selecionado ");
            console.log("ADDING")
        });


        $('.selecionado').click(function(e){
            console.log("REMOVING");
            alert("HEY")
            $(this).removeClass(" selecionado ");
            $(this).addClass(" free ");
        });



    });



    $('.modal-trigger').click(function(){
        var id = $(this).attr('id');
            $('.mod').fadeIn('1')
            alert(id);
        });



    function showPlaces(id)
    {
        $.ajax(
        {
            url: URL+'/sessoes/'+id+'/lugares',
            // url: URL+'/cinemas/'+idCinema+'/salas',
            type: 'get',
            beforeSend:function()
            {

            },
            success:function(data)
            {
                console.log(data);
                var lines = "";

                for (let i = 0; i < data.length; i++) 
                {
                    
                    var id_disponivel    = data[i].id_disponivel;
                    var estado   = data[i].estado;
                    var numero   = data[i].numero;
                    
                    if(estado == '0')
                    {
                        lines = lines + "<span class='place free' id='"+id_disponivel+"'>"+numero+"</span>";
                    }
                    else
                    {
                        lines = lines + "<span class='place ocupado' id='"+id_disponivel+"'>"+numero+"</span>";
                    }
                    
                }    
                $('.places').html(lines);
                
                $('.free').click(function(e){
                    var lugar = $(this).attr('id');
                    console.log(lugar);
                    var i = 0;
                    if((i = places.indexOf(lugar))>=0){
                        $(this).removeClass(" selecionado ");
                        $(this).addClass(" free ");
                        places.splice(i,1);
                        console.log(places);
                        console.log(i);
                    }else{
                        
                    $(this).removeClass(" free ");
                    $(this).addClass(" selecionado ");
                    places.push($(this).attr('id'));
                    console.log(places);
                    console.log(i);
                    }
                });


                $('.selecionado').click(function(e){
                    console.log("REMOVING");
                    alert("HEY")
                    $(this).removeClass(" selecionado ");
                    $(this).addClass(" free ");
                });
               
            },
            error:function(data)
            {
                alert("ERRO AO BUSCAR LUGARES");
                console.log(data)
            }
        });
    }



    function efectuarReserva(id)
    {
        var lugares_ = "";
        for (let i = 0; i < places.length; i++) {
            const element = places[i];
            if(i==0)
            {
                lugares_ = lugares_ + places[i]; 
            }else{
                lugares_ = lugares_ + ","+places[i];
            }
        }
        var nome_ = $("#nome").val();
        var telefone_ = $("#telefone").val();

        console.log(lugares_);
        console.log(nome_);
        console.log(telefone_);
        if(nome_=='' || telefone_==''){
            $(".message").text("Preencha todos os campos");
            $(".message").fadeIn(1);
            return;
        }else if(lugares_ =="")
        {
            $(".message").text("Escolha um lugar");
            $(".message").fadeIn(1);
            return;
        }
        // else if(telefone_ < 900000000 || telefone_ >=999999999){
        //     $(".message").text("Numero de telefone inválido");
        //     $(".message").fadeIn(1);
        //     return;
        // }


        $.ajax(
        {
            url: URL+'/reservas/store',
            // url: URL+'/cinemas/'+idCinema+'/salas',
            type: 'post',
            data: {
                nome: nome_,
                telefone: telefone_,
                lugares : lugares_ 
            },
            beforeSend:function()
            {

            },
            success:function(data)
            {
                console.log(data);
                if(data.status == 'sucesso')
                {
                    var codigo = data.codigo;
                    $("#recibo").attr("href","<?=URL?>/recibo/"+codigo+"/");
                    $('.mod').fadeOut();
                    $('.mod-sucess').fadeIn('2');
                    
                }else{
                    $('.mod').fadeOut();
                    $('.mod-error').fadeIn('2');
                    
                }

                $('.close-report').click(function(e){
                    
                    $('.mod-sucess').fadeOut('1');
                    $('.mod-error').fadeOut('1');
                    places = [];
                });
               
            },
            error:function(data)
            {
                $('.mod').fadeOut();
                $('.mod-error').fadeIn('2');
                console.log(data);
            }
        });
    }

</script>
</body>
</html>