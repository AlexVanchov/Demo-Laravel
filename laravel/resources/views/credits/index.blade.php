@extends('layouts.app')
<h1>Credits</h1>
<a href="{{ route('credit.create') }}" class="btn btn-primary">Add New Recipient</a>
<a href="{{ route('credit.payment') }}" class="btn btn-primary">Pay Installment</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Recipient</th>
        <th>Amount</th>
        <th>Term (months)</th>
        <th>Remaining Amount</th>
        <th>Monthly Installment</th>
        <th>Start Date</th>
        <th>Last Installment</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($credits as $credit)
        <tr>
            <td>{{ $credit->id }}</td>
            <td>{{ $credit->credit_recipient }}</td>
            <td>{{ $credit->amount }} BGN</td>
            <td>{{ $credit->term_months }}</td>
            <td>{{ $credit->remaining_amount }} BGN</td>
            <td>{{ $credit->getMonthlyInstallment() }}</td>
            <td>{{ $credit->created_at }}</td>
            <td>{{ $credit->updated_at != $credit->created_at ? $credit->updated_at : "None" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
