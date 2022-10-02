<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?=URL?>/resources/assets/materialize/css/materialize.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="<?=URL?>/resources/assets/custom_index.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="content center">
        <div class="row ">
            <div class="col s12 m4 l4 push-l4  center">
                <div class="login white center">
                    <div class="logo">
                        <i class="fa fa-pencil fa-3x red-text "></i>
                        <h5 class="light">MOVIETICKET</h5>
                    </div>
                    <div class="row campus">
                        <form action="" method="post">
                            <div class="col s12 input-field">
                                <input type="text" name="email" value="<?=$email?>" >
                                <label for="email">Email</label>
                            </div>
                            <div class="col s12 input-field">
                                <input type="password" name="password" value="<?=$password?>">
                                <label for="password">Password</label>
                            </div>
                    
                            <div class="col s12 input-field">
                                <input type="submit" class="btn red" name="entrar" value="Entrar" >
                            </div>
                            <div class="col s12 input-field red-text">
                                 <?=$status?> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=URL?>/resources/assets/jquery-3.3.1.min.js"></script>
    <script src="<?=URL?>/resources/assets/materialize/js/materialize.js"></script>
    <script>

    </script>
</body>
</html>