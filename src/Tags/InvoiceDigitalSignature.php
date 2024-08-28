<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class InvoiceDigitalSignature extends Tag
{
    public function __construct($value)
    {
        parent::__construct(7, $value);
    }
}
