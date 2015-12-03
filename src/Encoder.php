<?php 

namespace Tokenly\SwapbotOpReturn;

use Tokenly\SwapbotOpReturn\AddressConverter;
use Tokenly\SwapbotOpReturn\Constants;

/**
* Encodes an Op Return
*/
class Encoder
{

    /**
     * builds the OP_RETURN data to trigger an alternate swapbot receipt destination
     * @param  string $bitcoin_address a base58 encoded bitcoin address
     * @return string a hexadecimal representation of the OP_RETURN instruction
     */
    public function buildDestinationInstruction($bitcoin_address) {
        $address_converter = new AddressConverter();

        return Constants::PREFIX . Constants::OP_DESTINATION . $address_converter->bitcoinAddressToHexadecimal($bitcoin_address);
    }

}