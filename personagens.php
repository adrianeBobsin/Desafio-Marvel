<?php

     class Personagens {
        /*  ==== Personagens pré-defindos ==== 
            1009262 -> DareDevil;
            1009378 -> Jessica Jones;
            1009268 -> Demolidor
        */

        public function lista_personagens() {
            $personagens_ids = array(0 => 1009262, 1 => 1009268, 2 => 1009378);

            for($i = 0; $i < 3; $i++) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $id_personagem = $personagens_ids[$i];
                $ts = time();
                $public_key = '13b18be510d23f7b42910153015c9b66';
                $private_key = '144f43e4935beb8ee83ce91c3ea61b776b264667';
                $hash = md5($ts . $private_key . $public_key);
                $query = array(
                    'format' => 'comic',
                    'formatType' => 'comic',
                    'apikey' => $public_key,
                    'ts' => $ts,
                    'hash' => $hash,
                );

                curl_setopt($curl, CURLOPT_URL,
                            "https://gateway.marvel.com:443/v1/public/characters/" . $id_personagem . "?" . http_build_query($query)
                );

                $retorno = json_decode(curl_exec($curl), true);
                curl_close($curl);
                $personagem = json_encode($retorno);
                
                echo "
                    <div id='personagem'>
                        <a href='hqs.php?id=".$id_personagem."&nome=".$retorno['data']['results'][0]['name']."'>
                            <div id='titulo'><h2>".$retorno['data']['results'][0]['name']."</h2></div>
                            <div id='imagem'><img src=".$retorno['data']['results'][0]['thumbnail']['path']."/portrait_uncanny." . 
                                                        $retorno['data']['results'][0]['thumbnail']['extension']."></div>
                        </a>
                    </div>
                ";
            }
        }
    }
?>