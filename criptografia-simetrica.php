<?php
// Função para criptografar dados usando uma implementação básica
function criptografar($dados, $chave) {
    $iv = random_bytes(16); // Gera um vetor de inicialização (IV) aleatório de 16 bytes
    $criptografado = base64_encode(openssl_encrypt($dados, 'aes-256-cbc', $chave, 0, $iv) . '::' . $iv);
    return $criptografado;
}

// Função para descriptografar dados
function descriptografar($dados, $chave) {
    list($criptografado, $iv) = explode('::', base64_decode($dados), 2);
    return openssl_decrypt($criptografado, 'aes-256-cbc', $chave, 0, $iv);
}

$chave = 'a_chave_secreta_sao_os_amigos_que_fazemos_ao_longo_da_vida';
$dados = 'Era uma vez um lugarzinho no meio do nada com sabor de chocolate e cheiro de terra molhada.';

$dadosCriptografados = criptografar($dados, $chave);
echo "\n Dados criptografados: " . $dadosCriptografados . "\n";

$dadosDescriptografados = descriptografar($dadosCriptografados, $chave);
echo "\n Dados descriptografados: " . $dadosDescriptografados . "\n";
?>