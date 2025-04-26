<h1>Edit Payment Gateway</h1>

<form method="POST" action="{{ route('payment-gateway.update', $payment_gateway->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="gateway_name" value="{{ $payment_gateway->gateway_name }}" required><br><br>

    <textarea name="credentials" required>{{ json_encode($payment_gateway->credentials) }}</textarea><br><br>

    <label>Active:</label>
    <input type="checkbox" name="is_active" value="1" {{ $payment_gateway->is_active ? 'checked' : '' }}><br><br>

    <button type="submit">Update</button>
</form>
