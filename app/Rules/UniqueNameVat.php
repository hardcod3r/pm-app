<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueNameVat implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $name = request()->input('name'); 

        $exists = DB::table('companies')
            ->where('name', $name)
            ->where('vat_id', $value)
            ->exists(); // Check if the combination exists

        if ($exists) {
            $fail('The combination of name and VAT ID must be unique.');
        }
    }
}
