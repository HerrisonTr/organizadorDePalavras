<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['erro'] = "Método da requisição inválido";
    return header("Location: ./index.php");
}

if (!isset($_FILES['arquivo']) || !isset($_POST['separador'])) {
    $_SESSION['erro'] = "Preencha todos os campos obrigatórios";
    return header("Location: ./index.php");
}

$separador = $_POST['separador'] == 0 ? " " : trim($_POST['separador']);

$arquivo = $_FILES['arquivo']; 

$arquivoTemporario = $arquivo['tmp_name'];

$extensaoArquivo = array_reverse(explode('.', $arquivo['name']))[0];

if($extensaoArquivo != 'txt'){ 
    $_SESSION['erro'] = "Extensão do arquivo inválida";
    return header("Location: ./index.php");
}

$frutas = [];
$abrirArquivoRecbido = fopen($arquivoTemporario, "r");
while (($linha = fgets($abrirArquivoRecbido)) !== false) {
    // Passa por cada linha do arquivo enviado, realizando a separação das frutas em um array. 
    $frutasPorLinha = array_map('trim', explode($separador, $linha)); 

    // Mescla o array de frutas com o array retirado da linha do arquivo.
    $frutas = array_merge($frutas, array_filter($frutasPorLinha));
}
fclose($abrirArquivoRecbido);

asort($frutas);

$frutasOrganizadas = implode("$separador ", $frutas);

$nomeArquivoTratado = "arquivo_tratado_" . date("YmdHis") . ".txt";
$caminhoArquivoTratado = "./arquivos/$nomeArquivoTratado";
$arquivoTratado = fopen($caminhoArquivoTratado, "x+");
fwrite($arquivoTratado, $frutasOrganizadas);
fclose($arquivoTratado);

// Configuramos os headers que serão enviados para o browser
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="' . $nomeArquivoTratado);
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($caminhoArquivoTratado));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');
// Envia o arquivo para o cliente
readfile($caminhoArquivoTratado);
