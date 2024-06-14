<?php
// Listar todos los algoritmos de hash disponibles
echo "Algoritmos de Hash disponibles:\n";
$hash_algos = hash_algos();
foreach ($hash_algos as $algo) {
    echo "<br>- $algo\n";
}

echo "\n";

// Listar todos los algoritmos de cifrado disponibles con OpenSSL
echo "<br><br><br><br><br><br>Algoritmos de Cifrado disponibles con OpenSSL:\n";
$cipher_methods = openssl_get_cipher_methods();
foreach ($cipher_methods as $cipher) {
    echo "<br>- $cipher\n";
}
?>
