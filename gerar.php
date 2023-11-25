<?php
define("URL", "https://amigosecretoigor.000webhostapp.com/");

class Geracao
{
    public function gera($vetParticipante)
    {
        // if (!isset($_POST['vetParticipante'])) die("Acesso proibido!");
        $i = 0;
        if (is_array($vetParticipante)) {
            if (!(count($vetParticipante) > 1)) die("Número insuficiente de participantes");

            while ($i < count($vetParticipante)) {
                if (empty($vetParticipante[$i])) {
                    die("Não é permitido participante com nome em branco:");
                }
                $i++;
            }
        } else {
            die("Cadastro incorreto de participantes");
        }

        if (is_array($vetParticipante)) {
            for ($i = 0; $i < count($vetParticipante); $i++) {
                for ($j = $i + 1; $j < count($vetParticipante); $j++) {
                    // if (strcmp(trim(strtoupper($vetParticipante[$i])), trim(strtoupper($vetParticipante[$i])))){
                    if (trim(strtoupper($vetParticipante[$i])) == trim(strtoupper($vetParticipante[$j]))) {
                        die("Não é permitido participantes com nome exatamente iguais");
                    }
                }
            }
        } else {
            die("Cadastro incorreto de participantes");
        }


        $vetAmigo = $vetParticipante;
        $vetAmigoPossivel = $vetParticipante;
        // $vetEmail = $_POST['vetEmail'];  
        $vetAmigo = [];
        $i = 0;
        if (is_array($vetAmigo) && is_array($vetParticipante)) {
            if (count($vetParticipante) > 0 /*&& count($vetAmigo) > 0 && count($vetParticipante) == count($vetAmigo)*/) {
                foreach ($vetParticipante as $aux => $participante) {
                    // array_splice($vetAmigoPossivel, $aux, 1);  
                    shuffle($vetAmigoPossivel);
                    $indicePossivelAmigo = 0;
                    $possivelAmigo = $vetAmigoPossivel[$indicePossivelAmigo];
                    while ($participante == $possivelAmigo || in_array(trim($possivelAmigo), $vetAmigo)) {
                        if ($indicePossivelAmigo < count($vetAmigoPossivel)) {
                            $possivelAmigo = $vetAmigoPossivel[$indicePossivelAmigo];
                            $indicePossivelAmigo++;
                        } else {
                            $indicePossivelAmigo = 0;
                            if ($aux == 0) {
                                $indicePossivelAmigo++;
                            }
                            $possivelAmigo = $vetAmigoPossivel[$indicePossivelAmigo];
                            // die("Erro na geração do amigo secreto. Favor reiniciar o processo! <a href='".$URL."'> voltar </a>");
                        }
                    }
                    $vetAmigo[$i] = $possivelAmigo;
                    // array_splice($vetAmigoPossivel, $indicePossivelAmigo, 1);                     
                    // $vetAmigoPossivel[] = $vetParticipante[$i];
                    $i++;
                }
                $i = 0;
                $chaveEvento = uniqid(true);
                echo "<h1> Evento Criado com sucesso (obs: evento tem validade de 1 ano) <h1>";
                echo "<h2> Chave do evento:" . $chaveEvento . "<h2>";
                echo "<h3> Informe aos participantes a chave do evento e suas chaves pessoais:</h3>";
                $myfile = fopen($chaveEvento . ".txt", "w") or die("Unable to open file!");
                while ($i < count($vetParticipante)) {
                    $chave = uniqid(true);
                    echo  $vetParticipante[$i] . " => <b>Chave Evento:</b>" . $chaveEvento . " <b>Chave Pessoal:</b>" . $chave . "<br><br>";
                    // participanteX tirou amigoY
                    $linha = $chave . ";" . $vetParticipante[$i] . ";" . $vetAmigo[$i] . "\n";
                    fwrite($myfile, $linha);
                    $i++;
                }
                echo "<h3> Todos os participantes devem acessar: <a href='" . URL . "'> ".URL." </a> e VERIFICAR seu amigo (usando a chave do evento e sua chave pessoal) </h3>";
                echo "<a href='javascript:void(0)' onclick='history.go(-1)'> Voltar </a>";
                fclose($myfile);
            } else {
                echo "<h1> - Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
                echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";
            }
        } else {
            echo "<h1> Não foi possível criar o evento de amigo secreto. Possíveis causas: <h1>";
            echo "<h2> Nomes e Emails dos participantes são campos obrigatórios </h2>";
        }
    }
}

require_once "validade.php";

$validade = new Validade();
$validade->valida();

if (!isset($_POST['vetParticipante'])) die("Acesso proibido!");

$vetParticipante = $_POST['vetParticipante'];
$geracao = new Geracao();
$geracao->gera($vetParticipante);

?>