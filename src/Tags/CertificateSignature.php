<?php

namespace Picker\ZATCA\Tags;

use Picker\ZATCA\Tag;

class CertificateSignature extends Tag
{
    public function __construct($value)
    {
        parent::__construct(9, $value);
    }
}

