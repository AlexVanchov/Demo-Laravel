<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Rules\CreditLimitRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class CreditController
 * @package App\Http\Controllers
 */
class CreditController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $credits = Credit::all();
        return view('credits.index', compact('credits'));
    }

    /*
     * Show the form for creating credit
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('credits.create');
    }

    /*
     * Store a newly created credit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form data
        $request->validate([
            'credit_recipient' => ['required', 'string', new CreditLimitRule],
            'amount' => 'required|numeric|min:1|max:80000',
            'term_months' => 'required|integer|min:1|max:12',
        ]);

        $creditRecipient = $request->input('credit_recipient');
        $amount = $request->input('amount');
        $termMonths = $request->input('term_months');
        $remainingAmount = $amount;

        Credit::create([
            'credit_recipient' => $creditRecipient,
            'amount' => $amount,
            'term_months' => $termMonths,
            'remaining_amount' => $remainingAmount,
        ]);

        return redirect('/')->with('success', 'Credit for ' . $creditRecipient . '(' . $amount . ' BGN) created successfully!');
    }

    /*
     * Show the form for creating payment
     *
     * @return \Illuminate\View\View
     */
    public function createPayment(): View
    {
        $credits = Credit::all();
        return view('credits.create_payment', compact('credits'));
    }

    /*
     * Pay Installment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePayment(Request $request): RedirectResponse
    {
        // validate form data
        $validated_data = $request->validate([
            'credit_id' => 'required|exists:credits,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $installment_to_pay = $validated_data['amount'];
        $credit = Credit::findOrFail($validated_data['credit_id']);

        $status = 'success';
        $response_msg = 'Payment of ' . $installment_to_pay . ' (BGN) was successfully made.';
        if ($installment_to_pay > $credit->remaining_amount) {
            $old_remaining_amount = $credit->remaining_amount;
            $response_msg .= ' Credit is overpaid by ' . ($installment_to_pay - $old_remaining_amount) . ' (BGN)';
            $status = 'warning';
        }

        $credit->payInstallment($installment_to_pay);
        return redirect()->route('credit.index')->with($status, $response_msg);
    }
}
