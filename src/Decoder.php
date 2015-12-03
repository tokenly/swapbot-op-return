<?php 

namespace Tokenly\SwapbotOpReturn;

use Tokenly\SwapbotOpReturn\AddressConverter;
use Tokenly\SwapbotOpReturn\Constants;
use Exception;

/**
* Decodes an Op Return
*/
class Decoder
{

    /**
     * Decodes OP_RETURN data to trigger an alternate swapbot receipt destination
     * returns an array of the operation and the base58 encoded bitcoin address on success
     * @param  string $op_return_string the hexadecimal encoded 
     * @return mixed null if not a valid OP_RETURN or an array of ['operation' => 'destination, 'address' => $address_string] on success
     */
    public function decodeInstruction($raw_op_return_string) {
        $op_return_string = strtolower($raw_op_return_string);

        $prefix_length = strlen(Constants::PREFIX);
        if (substr($op_return_string, 0, $prefix_length) == Constants::PREFIX) {
            // check operation byte
            if (substr($op_return_string, $prefix_length, 1) != Constants::OP_DESTINATION) {
                throw new Exception("Unknown operation byte", 1);
            }
            $operation = 'destination';

            // get the address
            $address_hex = substr($op_return_string, $prefix_length + 2);
            if (strlen($address_hex) != 50) { throw new Exception("Invalid address length", 1); }
            $address_converter = new AddressConverter();
            $address = $address_converter->binaryDataToBitcoinAddress($address_hex);

            return [
                'operation' => $operation,
                'address'   => $address,
            ];
        }

        return null;
    }

}