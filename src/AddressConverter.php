<?php 

namespace Tokenly\SwapbotOpReturn;

/**
* converts bitcoin address to and from base58 format
*/
class AddressConverter
{
    
    static $BASE_58_CHARS = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

    /**
     * decodes a base58 bitcoin address into a 25 byte binary bitcoin address
     * @param  string $bitcoin_address a base58 encoded bitcoin address
     * @return string 25 byte binary bitcoin address as a hexadecimal string
     */
    public function bitcoinAddressToHexadecimal($bitcoin_address) {
        return $this->decodeBase58($bitcoin_address);
    }

    /**
     * encodes a 25 byte binary bitcoin address as a base58 bitcoin address string
     * @param  string $bitcoin_address_as_hex_string 25 byte binary bitcoin address as a hexadecimal string
     * @return string a base58 encoded bitcoin address
     */
    public function binaryDataToBitcoinAddress($bitcoin_address_as_hex_string) {
        return $this->encodeBase58(hex2bin($bitcoin_address_as_hex_string));
    }

    // ------------------------------------------------------------------------
    
    /**
     * Encode a binary string to base58
     *
     * @param $binary
     * @return string
     * @throws \Exception
     */
    protected function encodeBase58($binary_bitcoin_address)
    {
        $size = strlen($binary_bitcoin_address);
        if ($size == 0) {
            return '';
        }

        $orig = $binary_bitcoin_address;
        $decimal = gmp_import($binary_bitcoin_address);

        $return = "";
        while (gmp_cmp($decimal, 0) > 0) {
            list($decimal, $rem) = gmp_div_qr($decimal, 58);
            $return = $return . self::$BASE_58_CHARS[gmp_intval($rem)];
        }
        $return = strrev($return);

        //leading zeros
        for ($i = 0; $i < $size && $orig[$i] == "\x00"; $i++) {
            $return = "1" . $return;
        }

        return $return;
    }

    /**
     * Decode a base58 string
     *
     * @param $base58
     * @return string hexadecimal string
     */
    protected function decodeBase58($base58_address)
    {
        if (strlen($base58_address) == 0) {
            return null;
        }

        $original = $base58_address;
        $strlen = strlen($base58_address);

        $decoded = '0';
        for ($i = 0; $i < $strlen; $i++) {
            $decoded = gmp_add(gmp_mul($decoded, 58), strpos(self::$BASE_58_CHARS, $base58_address[$i]));
        }

        $hex = ($decoded == '0') ? '' : gmp_strval($decoded, 16);
        for ($i = 0; $i < $strlen && $original[$i] == "1"; $i++) {
            $hex = "00" . $hex;
        }

        $hex = str_pad($hex, 50, '0', STR_PAD_LEFT);

        return $hex;
    }

}