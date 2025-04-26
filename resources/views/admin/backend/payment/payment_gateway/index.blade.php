<h1>Payment Gateway List</h1>

<a href="{{ route('payment-gateway.create') }}">Add New Gateway</a>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gateways as $gateway)
            <tr>
                <td>{{ $gateway->gateway_name }}</td>
                <td>{{ $gateway->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('payment-gateways.edit', $gateway->id) }}">Edit</a>
                    <form action="{{ route('payment-gateways.destroy', $gateway->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
