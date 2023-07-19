@extends('layouts.app')
<h1>Create Credit</h1>
<form action="/credits" method="post">
    @csrf
    <div>
        <label for="credit_recipient">Recipient:</label>
        <input type="text" id="credit_recipient" name="credit_recipient" required>
    </div>
    <div>
        <label for="amount">Amount (BGN):</label>
        <input type="number" id="amount" name="amount" min="1" max="80000" required>
        @error('credit_recipient')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="term_months">Term (months):</label>
        <input type="number" id="term_months" name="term_months" min="1" max="12" required>
    </div>
    <button type="submit">Create</button>
</form>
