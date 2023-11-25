<?php

class Validade
{
    // private $ok;

    public function __construct()
    {
        // $this->ok = true;
    }

    public function valida()
    {

        $codigo = ["gerar.php", "index.html", "validade.php", "verificar.php", ".git", "README.md"];

        if ($handle = opendir('.')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && !in_array($entry, $codigo)) {
                    // echo "$entry <br>";
                    $futureDate = date('Y-m-d', strtotime('+1 year', filectime($entry)));
                    $futureDate = explode("-", $futureDate);
                    $data_atual = date("Y-m-d");
                    $data_atual = explode("-", $data_atual);
                    // 2024, 2025 e etc. >= 2023+1 
                    if ($futureDate[2] >= $data_atual[2] + 1) {
                        // se for 2024 tenho que verificar o mes
                        if ($futureDate[2] - $data_atual[2] + 1 == 0) {
                            // se o mes eh maior => deleta
                            if ($futureDate[1] > $data_atual[1]) {
                                unlink($entry);
                            }
                            // se for o mesmo mes mas o dia eh maior => deleta
                            else if ($futureDate[1] == $data_atual[1] && $futureDate[0] > $data_atual[0]) {
                                unlink($entry);
                            }
                        } else {
                            // se a diferença for maior => deleta
                            unlink($entry);
                        }
                    }
                }
            }
            closedir($handle);
        }
    }
}

?>
