<form action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
    </select>

    <button type="submit">Update</button>
</form>
