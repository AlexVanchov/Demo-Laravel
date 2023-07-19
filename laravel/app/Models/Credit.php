<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed amount
 * @property mixed term_months
 * @property mixed remaining_amount
 * @property mixed credit_recipient
 */
class Credit extends Model
{
    use HasFactory;

    protected $fillable = ['credit_recipient', 'amount', 'term_months', 'remaining_amount'];

    /**
     * Pay installment
     *
     * @param $amount
     * @return void
     */
    public function payInstallment($amount): void
    {
        if ($amount > $this->remaining_amount) {
            $amount = $this->remaining_amount;
        }

        $this->remaining_amount -= $amount;
        $this->save();
    }

    /**
     * Get monthly installment
     *
     * @return float
     */
    public function getMonthlyInstallment(): float
    {
        return round($this->amount / $this->term_months, 2);
    }
}
