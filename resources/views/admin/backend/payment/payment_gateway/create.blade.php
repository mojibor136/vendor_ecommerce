<h1>Add New Payment Gateway</h1>

<form method="POST" action="{{ route('payment-gateway.store') }}">
    @csrf
    <input type="text" name="gateway_name" placeholder="Gateway Name" required><br><br>

    <textarea name="credentials" placeholder='{"app_key":"xxx", "app_secret":"xxx"}' required></textarea><br><br>

    <label>Active:</label>
    <input type="checkbox" name="is_active" value="1" checked><br><br>

    <button type="submit">Save</button>
</form>
