<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        *{
    box-sizing: border-box;
    padding: 0;
    margin: 0;
    border: none;
    outline: none;
    font-family: Arial, Helvetica, sans-serif;
}

html,body{
    height: 100%;
    width: 100%;
    /* background-image: url(img1.jpg); */
    /* background-repeat: no-repeat; */
    /* background-position: center; */
    /* background-size: cover; */
background-color: white;
}

div{
    width: 100%;
    height: 100%;
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    /* background-color: rgba(0, 0,0,0.8); */
}
h2{
    font-size: 12em;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin-bottom: 15px;
    /* background-image: url(img1.jpg); */
    color: tomato;
}
h4{
    font-size: 1.5em;
    margin-bottom: 10px;
    color: black;
}
p{
    margin-bottom: 35px;
    color: black;
}
a{
    background-color: rgb(21, 110, 199);
    color: white;
    text-decoration: none;
    font-size: 1em;
    font-weight: bold;
    padding: 15px 25px;
    border-radius: 25px;
}

    </style>
</head>
<body>
    <div>
        <h2>Oops!</h2>
        <h4><?=$code?> - <?=$message?></h4>
        <p>A página que tentou aceder, pode ter sido removida,<br> seu nome foi alterado ou está temporáriamente indisponível</p>
        <a href="<?=URL?>/"> GO TO HOMEPAGE</a>
    </div>
</body>
</html>