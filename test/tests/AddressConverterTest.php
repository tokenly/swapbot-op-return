<?php

use Tokenly\SwapbotOpReturn\AddressConverter;
use \PHPUnit_Framework_Assert as PHPUnit;

/*
* 
*/
class AddressConverterTest extends \PHPUnit_Framework_TestCase
{


    public function testBitcoinAddressToHexadecimal() {
        $converter = new AddressConverter();
        $result = $converter->bitcoinAddressToHexadecimal('1JztLWos5K7LsqW5E78EASgiVBaCe6f7cD');
        PHPUnit::assertEquals('00c56cb39f9b289c0ec4ef6943fa107c904820fe0980df2772', $result);
        $result = $converter->bitcoinAddressToHexadecimal('1BURNsssssssssssssssssssssstsp2x8');
        PHPUnit::assertEquals('0001fb0c86969f0ec7c3137ef692ed24da94d5bb29600f4679', $result);
        $result = $converter->bitcoinAddressToHexadecimal('1ANTHERXXXXXXXXXXXXXXXXXXXXVA2ynW');
        PHPUnit::assertEquals('0001c5a6dc8dd376ab0a6c27f872f4fd6965fa795c6f0c7fe7', $result);
    } 


    public function testBinaryDataToBitcoinAddress() {
        $converter = new AddressConverter();
        $result = $converter->binaryDataToBitcoinAddress('00c56cb39f9b289c0ec4ef6943fa107c904820fe0980df2772');
        PHPUnit::assertEquals('1JztLWos5K7LsqW5E78EASgiVBaCe6f7cD', $result);
        $result = $converter->binaryDataToBitcoinAddress('0001fb0c86969f0ec7c3137ef692ed24da94d5bb29600f4679');
        PHPUnit::assertEquals('1BURNsssssssssssssssssssssstsp2x8', $result);
        $result = $converter->binaryDataToBitcoinAddress('0001c5a6dc8dd376ab0a6c27f872f4fd6965fa795c6f0c7fe7');
        PHPUnit::assertEquals('1ANTHERXXXXXXXXXXXXXXXXXXXXVA2ynW', $result);
    } 




}
