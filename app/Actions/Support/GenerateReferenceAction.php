<?php

namespace App\Actions\Support;

use Illuminate\Support\Str;

class GenerateReferenceAction
{
    public function execute(int $length = 11): string
    {
        return Str::upper(Str::random($length));
    }
}