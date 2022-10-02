<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOVIETICK - HOME</title>
    <link rel="stylesheet" href="<?=URL?>/resources/assets/tailwind.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/style.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/font-awesome-4.7.0/css/font-awesome.min.css">
</head> 
<body class="">  
    <header class="w-full h-screen  " style="background-image: url(<?=ASSETS?>/img/capas/7.jpg)" >
        <div class="w-full h-screen black-a-95 bg-black-900/[0.65] ">
            <nav class="bg-black text-white w-full h-1/6 content px-32 py-6 flex justify-between items-center border-b border-gray-500">
                <div class="logo">
                    <h3 class="flex items-center justify-center">
                        <figure>
                            <img src="logo.png" alt="">
                        </figure>
                        <span class="font-semibold   text-3xl ">MOVIE<a href="<?=URL?>" class="text-red-500">TICK</a></span>
                    </h3>
                </div>
                <ul class=" hidden md:flex  md:justify-end md:space-x-8 md:font-semibold">
                    <li class="link"><a href="<?=URL?>">HOME</a></li>
                    <li class="link"><a href="#filmes">FILMES</a></li>
                    <li class="link"><a href="<?=URL?>/adm/login" class="bg-red-700 hover:bg-red-600 rounded-sm py-1 px-2">LOGIN</a></li>
                </ul> 
                <span id="menu-button" class="text-2xl cursor-pointer md:hidden"><i class="fa fa-bars"></i></span>
                <div id="menu-mobile" class=" hidden mobile-menu fixed w-3/4  top-0 right-0 opacity-95 bg-black h-screen md:hidden">
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
            
            <div class="banner content font-semibold h-5/6 flex flex-col items-center justify-center ">
                <h1 class=" text-3xl md:text-5xl text-white text-center mb-2">RESERVE BILHETES PARA </br>OS MELHORES <span class="text-red-500">FILMES</span></h1>
                <p class=" text-center text-1xl text-gray-50">
                    Fácil, Rápido e Seguro. Obtenha o seu bilhete hoje mesmo!
                </p>
            </div>
        </div>
    </header>
    <div class="content w-full py-6 filter bg-gray-900">
        <div>
            <form action="<?=URL?>/filter" method="post" class="flex justify-center space-y-2 flex-wrap items-end space-x-4 mb-4">
                <div class="input text-white flex flex-col">
                    <label for="" class="mb-2 text-lg">Pesquise por filme</label>
                    <input name="titulo" placeholder="Titulo do filme" type="text" class="rounded-md text-md px-4 py-2 text-gray-400 bg-gray-800 outline outline-0">
                </div>
                <div class="input text-white flex flex-col">
                    <label for=""class="mb-2 text-lg">Genero</label>
                    <select name="genero" class="rounded-md text-md px-4 py-2 text-gray-400 bg-gray-800 outline outline-0">
                        <option value="Comedy">Comedia</option>
                        <option value="Action">Acção</option>
                        <option value="Drama">Drama</option>
                        <option value="All">Todos</option>
                    </select>
                </div>
                <div class="input text-white flex flex-col items-start justify-start ">
                    <button type="submit" class="w-14 md:hidden rounded-md text-md px-4 py-2 text-gray-200 bg-red-800  hover:bg-red-600 outline outline-0">
                    <i class="fa fa-search fa-fw " aria-hidden="true"></i>
                    </button>
                    <button type="submit" class="hidden md:block w-32 rounded-md text-md px-4 py-2 text-gray-200 bg-red-800  hover:bg-red-600 outline outline-0">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="last w-full content py-12 bg-black text-white" id="filmes">
        <div class="flex justify-between items-center font-semibold mb-8">
            <h3>Em Exibição</h3>
            <a href="<?=URL?>/#filmes" class="underline">Ver Todos</a>
        </div>
        <div class="flex  space-x-0 md:space-x-8 flex-wrap justify-center  mb-3" >

            <?php foreach($filmes as $dado): ?>
            <article class="w-3/4 md:w-1/3 lg:w-1/5 mb-5 mt-2 md:h-96  h-[28rem]">
                <figure class="w-full mb-2">
                <!-- <?=$dado->getCapa()?> <?=ASSETS?>/img/capas/4.jpg -->
                <a href="<?=URL?>/filme/<?=$dado->getId()?>/"> <img src="<?=$dado->getCapa()?>" class="w-full h-96 md:h-80 hover:scale-105 transition  rounded-md hover:border-red-600" alt=""></a> 
                </figure>
               <h3 class="font-semibold text-lg"><?=$dado->getTitulo()?></h3>
                <h5><?=$dado->getAno()?></h5>
            </article>

            <?php endforeach; ?>
        </div>
        <div class="mt-3 ">
                <!-- <div class="center flex justify-center space-x-4">
                    <a href="#" class="px-2 py-1  hover:text-red-400 fa fa-chevron-left "></a>
                    <a href="#" class="px-2  bg-red-500 rounded-sm hover:bg-red-400">1</a>
                    <a href="#" class="px-2 bg-red-500 rounded-sm hover:bg-red-400">2</a>
                    <a href="#" class="px-2 bg-red-500 rounded-sm hover:bg-red-400">3</a>
                    <a href="#" class="px-2 bg-red-500 rounded-sm hover:bg-red-400">4</a>
                    <a href="#" class="px-2 py-1  hover:text-red-400 fa fa-chevron-right"></a>
                </div> -->
                <?=$links?>
        </div>
    </div>


    <footer class="text-center text-white bg-gray-900 content py-8" >
        <h3>Powered By <a href="#" class="text-red-500">Lucilio Gomes</a></h3>
    </footer>


    
<script src="<?=URL?>/resources/assets/jquery-3.3.1.min.js"></script>
<script>


    $(document).ready(function(){
        
        $('#menu-button').click(function(e){
            e.preventDefault()
            $('#menu-mobile').removeClass(" hidden ");
        });


        $('#close-menu').click(function(e){
            $('#menu-mobile').addClass(" hidden ");
        });


        $('.selecionado').click(function(e){
            console.log("REMOVING");
            alert("HEY")
            $(this).removeClass(" selecionado ");
            $(this).addClass(" free ");
        });



    });

</script>
</body>
</html>