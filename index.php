<html lang="pt">

    <head>
        <meta charset = "utf-8">
        <title>Desafio Técnico</title>
        <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
        <link rel="stylesheet" style="text/css" href="css/index.css">
    </head>

    <body>
        <div id="cabecalho">
            <img id="bg" src="img/bg_daredevil.png">
            <h1>Desafio técnico - Adriane Bobsin </h1>
            <h2>Personagens Marvel</h2> 
        </div>

        <div id="banners">
            <?php 
                require("personagens.php");
                $personagens = new Personagens();
                $personagens->lista_personagens();
            ?>
        </div>

        <div id="rodape">
            <hr><br/>
            <p id="texto_rodape">Adriane Bobsin de La Vega - 2019</p>
        </div>
    </body>

</html>