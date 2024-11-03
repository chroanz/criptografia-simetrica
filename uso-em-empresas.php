<?php
// Funções de criptografia/descriptografia
function criptografar($dados, $chave) {
    $iv = random_bytes(16);
    $criptografado = base64_encode(openssl_encrypt($dados, 'aes-256-cbc', $chave, 0, $iv) . '::' . $iv);
    return $criptografado;
}

function descriptografar($dados, $chave) {
    list($criptografado, $iv) = explode('::', base64_decode($dados), 2);
    return openssl_decrypt($criptografado, 'aes-256-cbc', $chave, 0, $iv);
}

// Chave secreta de criptografia
$chave = 'tadeu_e_ermin_comendo_pamonha_na_estrada';

// Dados de cliente a serem armazenados
$dadosCliente = [
    'nome' => 'Jhon Da Hora',
    'email' => 'jhon_moral@santos.com',
    'telefone' => '40028922'
];

// Criptografar os dados do cliente antes de armazenar
$dadosCriptografados = criptografar(json_encode($dadosCliente), $chave);

// Armazenar os dados criptografados no banco de dados (exemplo)
echo "\nDados do cliente criptografados: " . $dadosCriptografados . "\n";

// Exemplo de recuperação dos dados criptografados do banco de dados
$dadosDescriptografados = descriptografar($dadosCriptografados, $chave);
echo "\nDados do cliente descriptografados: " . $dadosDescriptografados . "\n";
?>