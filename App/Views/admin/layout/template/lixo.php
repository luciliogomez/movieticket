<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?=URL?>/resources/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/style.css">
    <link rel="stylesheet" href="<?=URL?>resources/assets/dashboard.css">
</head>
<body>
    <header class="container flex-row-space-between">
        <div class="logo flex-row-start">
            <span><i class="fa fa-clock-o"></i></span>
            <h3>Solvagas</h3>
        </div>
        <nav >
            <ul class="flex-row-end">
                <li><a href="<?=URL?>/vagas">Vagas</a></li>
                <?php if(!isset($_SESSION['usuario'])):?>
                <li><a href="login_empresa.html">Sou Empresa</a></li>
                <li class="active"><a href="<?=URL?>/candidatos/login">Login</a></li>
                <?php else: ?>
                    <li class="active rad-1">
                        <a href="<?=URL?>/<?=$_SESSION['usuario']["tipo"];?>/<?=$_SESSION['usuario']["id"];?>/dashboard"><i class="fa fa-user "></i> <?=first($_SESSION['usuario']["nome"]);?></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

        <!-- PUT YOUR CONTENT HERE -->
            <?= $this->section("content") ?>
        <!-- END CONTENT -->
    <footer>
        <div class="footer-top flex-row-space-between">

            <div class="companie">
                <figure>
                    <div class="logo flex-row-start">
                        <span style="color: white;"><i class="fa fa-clock-o"></i></span>
                        <h3 style="color: white;">Solvagas</h3>
                    </div>
                </figure>
                <p>&copy; Solvagas. Todos direitos reservados.</p>
            </div>
    
            <div class="group-links flex-row-start">
                <div class="group">
                    <h4>Solvagas</h4>
                    <ul>
                        <li><a href="#">Sobre Nós</a></li>
                        <li><a href="#">Trabalhe Conosco</a></li>
                        <li><a href="#">Contacto</a></li>
    
                    </ul>
                </div>
                <div class="group">
                    <h4>Candidatos</h4>
                    <ul>
                        <li><a href="vagas.html">Ver Vagas</a></li>
                        <li><a href="#">Criar Perfil</a></li>
                    </ul>
                </div>
    
            </div>
        </div>
        <div class="footer-bottom">
            &copy; Developed by <a href="#" style="color: wheat;">Lucilio Gomes</a>
        </div>
    </footer>
</body>
</html>