<?php

use Tokenly\SwapbotOpReturn\Encoder;
use Tokenly\SwapbotOpReturn\Decoder;
use \PHPUnit_Framework_Assert as PHPUnit;

/*
* 
*/
class DestinationInstructionTest extends \PHPUnit_Framework_TestCase
{


    public function testBuildDestinationInstruction() {
        $encoded = new Encoder();
        $result = $encoded->buildDestinationInstruction('1JztLWos5K7LsqW5E78EASgiVBaCe6f7cD');
        PHPUnit::assertEquals('53574150424f540000c56cb39f9b289c0ec4ef6943fa107c904820fe0980df2772', $result);
    } 


    public function testDecodeDestinationInstruction() {
        $decoder = new Decoder();
        $result = $decoder->decodeInstruction('53574150424f540000c56cb39f9b289c0ec4ef6943fa107c904820fe0980df2772');
        $expected = [
            'operation' => 'destination',
            'address'   => '1JztLWos5K7LsqW5E78EASgiVBaCe6f7cD',
        ];
        PHPUnit::assertEquals($expected, $result);
    } 






}
