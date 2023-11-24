<?php  
    $URL = "https://amigosecretoigor.000webhostapp.com/";
    if (!isset($_POST['vetParticipante'])) die("Acesso proibido!");
    $vetParticipante = $_POST['vetParticipante'];        
    $vetAmigo = $vetParticipante;    
    $vetAmigosPossiveis = $vetAmigo;    
    // $vetEmail = $_POST['vetEmail'];  
    $vetAmigo = [];
    $i = 0;
    if (is_array($vetAmigo) && is_array($vetParticipante)){
        if (count($vetParticipante) > 0 /*&& count($vetAmigo) > 0 && count($vetParticipante) == count($vetAmigo)*/){
            foreach($vetParticipante as $participante){        
                $indicePossivelAmigo = rand(0, count($vetAmigosPossiveis)-1);
                $possivelAmigo = $vetAmigosPossiveis[$indicePossivelAmigo];
                while ($participante == $possivelAmigo || in_array($possivelAmigo, $vetAmigo)){            
                    $indicePossivelAmigo = rand(0, count($vetAmigosPossiveis)-1);
                    $possivelAmigo = $vetAmigosPossiveis[$indicePossivelAmigo];
                }
                $vetAmigo[$i] = $possivelAmigo;        
                array_splice($vetAmigosPossiveis, 2, $indicePossivelAmigo);
                $i++;
            }
            $i = 0;
            $chaveEvento = uniqid(true);
            echo "<h1> Evento Criado com sucesso <h1>";
            echo "<h2> Chave do evento:".$chaveEvento."<h2>";            
            echo "<h3> Informe aos participantes a chave do evento e suas chaves pessoais:</h3>";
            $myfile = fopen($chaveEvento.".txt", "w") or die("Unable to open file!");
            while ($i < count($vetParticipante)){                
                $chave = uniqid(true);
                echo  $vetParticipante[$i]." => <b>Chave Evento:</b>".$chaveEvento." <b>Chave Pessoal:</b>".$chave."<br><br>";
                // participanteX tirou amigoY
                $linha = $chave.";".$vetParticipante[$i].";".$vetAmigo[$i]."\n";
                fwrite($myfile, $linha);
                $i++;
            }
            echo "<h3> Todos os participantes devem acessar:".$URL." e VERIFICAR seu amigo </h3>";
            echo "<a href='$URL'> Voltar </a>";
            fclose($myfile);           
        }  else {
            echo "<h1> - Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
            echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";    
        }
    } else {
        echo "<h1> Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
        echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";
    }
?>