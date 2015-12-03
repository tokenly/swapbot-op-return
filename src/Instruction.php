<?php 

namespace Tokenly\SwapbotOpReturn;

use Tokenly\SwapbotOpReturn\AddressConverter;
use Tokenly\SwapbotOpReturn\Constants;

/**
* represents a swapbot instruction
*/
class Instruction
{

    public function set() {
        // code
    }

    /**
     * Decodes OP_RETURN data to trigger an alternate swapbot receipt destination
     * @param  string $bitcoin_address a base58 encoded bitcoin address
     * @return string a hexadecimal representation of the OP_RETURN instruction
     */
    public function decodeInstruction($op_return_string) {
        $address_converter = new AddressConverter();

        if (substr($op_return_string, 0, strlen(Constants::PREFIX)) == Constants::PREFIX) {

        }

        return [
            'operation',
        ];

        return Constants::PREFIX . Constants::OP_DESTINATION . $address_converter->bitcoinAddressToHexadecimal($bitcoin_address);
    }

}