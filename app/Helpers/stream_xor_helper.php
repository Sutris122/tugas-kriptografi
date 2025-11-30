<?php
if (! function_exists('xor_encrypt_hex')) {
    /**
     * Encrypt plaintext and return hex string.
     * Uses HMAC-SHA256 based keystream: HMAC(key, nonce || counter)
     * Key: secret shared key (string)
     * Nonce: random per-record bytes (binary or hex)
     */
    function xor_encrypt_hex(string $plaintext, string $key, string $nonce_hex): string
    {
        $nonce = hex2bin($nonce_hex);
        $plaintext_bytes = $plaintext;
        $out = '';
        $counter = 0;
        $keystream = '';
        $needed = strlen($plaintext_bytes);
        while (strlen($keystream) < $needed) {
            $block = $nonce . pack('J', $counter); // pack 64-bit counter, 'J' available on 64-bit, fallback handled below
            // To be portable: use uniqid-style fallback if pack('J') not available
            if ($block === false) {
                $block = $nonce . pack('N', $counter);
            }
            $keystream .= hash_hmac('sha256', $block, $key, true);
            $counter++;
        }
        $keystream = substr($keystream, 0, $needed);
        // XOR
        $cipher = $plaintext_bytes ^ $keystream;
        return bin2hex($cipher);
    }
}


if (! function_exists('xor_decrypt_hex')) {
    function xor_decrypt_hex(string $cipher_hex, string $key, string $nonce_hex): string
    {
        $cipher = hex2bin($cipher_hex);
        $nonce = hex2bin($nonce_hex);
        $needed = strlen($cipher);
        $keystream = '';
        $counter = 0;
        while (strlen($keystream) < $needed) {
            $block = $nonce . pack('J', $counter);
            if ($block === false) {
                $block = $nonce . pack('N', $counter);
            }
            $keystream .= hash_hmac('sha256', $block, $key, true);
            $counter++;
        }
        $keystream = substr($keystream, 0, $needed);
        $plain = $cipher ^ $keystream;
        return $plain;
    }
}
