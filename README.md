## Summary

Encodes and Decodes OP_RETURN data used to trigger custom Swapbot actions.


## Usage

Here is an example of how to create Swapbot OP_RETURN data to specify a custom destination for a swap:

```php

$new_destination_address = '1JztLWos5K7LsqW5E78EASgiVBaCe6f7cD';
$encoder = new Tokenly\SwapbotOpReturn\Encoder();
$hex_string = $encoder->buildDestinationInstruction($new_destination_address);

echo $hex_string.PHP_EOL;

// 53574150424f540000c56cb39f9b289c0ec4ef6943fa107c904820fe0980df2772

```