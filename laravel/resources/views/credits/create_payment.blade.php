@extends('layouts.app')

<h1>Create Credit</h1>
<form id="paymentForm" method="post">
    @csrf
    <label for="credit_id">Select Credit Recipient:</label>
    <select id="credit_id" name="credit_id" required>
        <option value="" selected disabled>Please select</option>
        @foreach ($credits as $credit)
            <option value="{{ $credit->id }}" data-remaining="{{ $credit->remaining_amount }}">{{$credit->id}}
                - {{ $credit->credit_recipient }}</option>
        @endforeach
    </select>

    <div>
        <label for="remaining_amount">Remaining Amount (BGN):</label>
        <input type="text" id="remaining_amount" name="remaining_amount" readonly>
    </div>
    <div>
        <label for="amount">Amount (BGN):</label>
        <input type="number" id="amount" name="amount" min="1" required>
    </div>

    <button type="submit">Pay</button>
</form>

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#credit_id').on('change', function () {
                var remainingAmount = $(this).find(':selected').data('remaining');
                $('#remaining_amount').val(remainingAmount);
            });
        });
    </script>
@endsection
