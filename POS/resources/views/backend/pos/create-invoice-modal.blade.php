<form class="px-3 text-start" method="post" action="{{ route('sales.store') }}">
    @csrf
    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
    <div class="mb-3">
        <label class="form-label">Payment</label>
        <select name="payment" class="form-select">
            <option value="" selected disabled>Select Payment
            </option>
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
            <option value="Due">Due</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Paid</label>
        <input type="text" id="paid" name="paid" class="form-control" placeholder="Paid Amount">
    </div>

    <div class="mb-3 text-center">
        <button class="btn btn-primary" type="submit">Complete
            Order</button>
    </div>

</form>
