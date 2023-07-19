<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Credit;

class CreditLimitRule implements Rule
{
    public function passes($attribute, $value)
    {
        $totalCredits = Credit::where('credit_recipient', $value)->sum('remaining_amount');
        return floatval($totalCredits) <= 80000;
    }

    public function message()
    {
        return 'Credit recipient already has credits exceeding the limit of 80000 BGN.';
    }
}
