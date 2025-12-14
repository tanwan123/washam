@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Collector Dashboard</h2>

    <div class="grid gap-4">
        @foreach($orders as $order)
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold">Order #{{ $order->id }} — <span class="text-sm text-gray-500">{{ ucfirst($order->status) }}</span></h3>
                    <p class="text-gray-600">Customer: {{ $order->user->name }} — {{ $order->contact_phone }}</p>
                    <p class="text-gray-600">Pickup: {{ $order->pickup_address }}</p>
                    <p class="text-gray-600">Delivery: {{ $order->delivery_address ?? 'N/A' }}</p>
                    <p class="mt-2 font-bold">Total: {{ number_format($order->total, 0) }} FCFA</p>
                </div>

                <div class="space-y-2 text-right">
                    @if($order->status === 'assigned' || $order->status === 'pending')
                        <button data-url="{{ route('collector.order.pickup', $order->id) }}" class="pickup-btn bg-green-600 text-white px-4 py-2 rounded">Mark Picked</button>
                    @endif

                    @if($order->status === 'collected' || $order->status === 'in_washing' || $order->status === 'ready_for_dispatch')
                        <button data-url="{{ route('collector.order.deliver', $order->id) }}" class="deliver-btn bg-orange-600 text-white px-4 py-2 rounded">Mark Delivered</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.pickup-btn').forEach(btn=>{
        btn.addEventListener('click', async () => {
            const url = btn.dataset.url;
            if (!confirm('Mark this order as picked up?')) return;
            try {
                const res = await fetch(url, { method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' }});
                const data = await res.json();
                if(data.success) location.reload();
            } catch(e){ alert('Error'); }
        });
    });

    document.querySelectorAll('.deliver-btn').forEach(btn=>{
        btn.addEventListener('click', async () => {
            const url = btn.dataset.url;
            if (!confirm('Mark this order as delivered?')) return;
            try {
                const res = await fetch(url, { method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' }});
                const data = await res.json();
                if(data.success) location.reload();
            } catch(e){ alert('Error'); }
        });
    });
});
</script>
@endsection

@endsection
