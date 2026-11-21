<?php

namespace App\Enums;

enum Category: string
{
    case It = 'IT';
    case Philology = 'Philology';
    case General = 'General';
    case Nonsense = 'Nonsense';

    public function label(): string
    {
        return $this->value;
    }
}
