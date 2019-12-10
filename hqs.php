<?php
    /*  ==== Personagens pré-defindos ==== 
        1009262 -> DareDevil;
        1009378 -> Jessica Jones;
        1009268 -> Demolidor
    */

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $id_personagem = $_GET['id'];
    $ts = time();
    $public_key = '13b18be510d23f7b42910153015c9b66';
    $private_key = '144f43e4935beb8ee83ce91c3ea61b776b264667';
    $hash = md5($ts . $private_key . $public_key);
    $query = array(
        'format' => 'comic',
        'formatType' => 'comic',
        'limit' => 5,
        'apikey' => $public_key,
        'ts' => $ts,
        'hash' => $hash,
    );

    curl_setopt($curl, CURLOPT_URL,
        "https://gateway.marvel.com:443/v1/public/characters/" . $id_personagem . "/comics" . "?" . http_build_query($query)
    );

    $retorno = json_decode(curl_exec($curl), true);
    curl_close($curl);
    $personagem = json_encode($retorno);

    echo "
    <html lang='pt'>

            <head>
                <meta charset = 'utf-8'>
                <title>Desafio Técnico</title>
                <link href='https://fonts.googleapis.com/css?family=Bangers&display=swap' rel='stylesheet'>
                <link rel='stylesheet' style='text/css' href='css/index.css'>
            </head>

            <body>
                <div id='cabecalho'>
                    <img id='bg' src='img/bg_daredevil.png'>
                    <h1>Desafio técnico - Adriane Bobsin </h1>
                    <h2>HQs - ".$_GET['nome']."</h2> 
                </div>";

    for ($i = 0; $i < 5; $i++) {
        echo "
                <div id='hq'>
                    <div id='titulo_hq'><h3>".$retorno['data']['results'][$i]['title']."</h3></div>
                    <div id='imagem_hq'><img src=".$retorno['data']['results'][$i]['thumbnail']['path']."/portrait_uncanny." . 
                                                $retorno['data']['results'][$i]['thumbnail']['extension']."></div>
                    <!--<div id='descricao'><p>". $retorno['data']['results'][$i]['description']."</p></div>-->
                </div>
         ";
    }

    echo "</body>
    </html>";
    

?>