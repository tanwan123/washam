@extends('admin.admin')

@section('page-title', 'Laundry Services')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Manage Laundry Services</h2>
    <button id="add-service-btn" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-4 py-2 rounded-lg transition">
        + Add Service
    </button>
</div>

<!-- Services Table -->

<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price (XAF)</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
    @foreach($services as $service)
    <tr data-image="{{ $service->image ? asset($service->image) : asset('images/default-service.jpg') }}">
        <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $service->name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $service->description }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-green-700 font-semibold">{{ number_format($service->price, 2) }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-center">
            <button data-id="{{ $service->id }}" class="view-btn bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg">
                View Details
            </button>
        </td>
    </tr>
    @endforeach
</tbody>

    </table>
</div>

<!-- Add/Edit Service Modal -->

<div id="service-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h3 class="text-xl font-bold mb-4" id="modal-title">Add New Service</h3>
        <form id="service-form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="service-id">

```
        <!-- Image Upload -->
        <div class="mb-4">
            <label for="service-image" class="block text-gray-700 font-medium mb-1">Service Image</label>
            <input type="file" name="image" id="service-image" class="w-full border border-gray-300 rounded-lg px-3 py-2" accept="image/*">
        </div>

        <!-- Service Name -->
        <div class="mb-4">
            <label for="service-name" class="block text-gray-700 font-medium mb-1">Service Name</label>
            <input type="text" name="name" id="service-name" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
        </div>

        <!-- Service Description -->
        <div class="mb-4">
            <label for="service-description" class="block text-gray-700 font-medium mb-1">Description</label>
            <textarea name="description" id="service-description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2" required></textarea>
        </div>

        <!-- Service Price -->
        <div class="mb-4">
            <label for="service-price" class="block text-gray-700 font-medium mb-1">Price (XAF)</label>
            <input type="number" name="price" id="service-price" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
        </div>

        <!-- Modal Buttons -->
        <div class="flex justify-end">
            <button type="button" id="close-modal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg mr-2">Cancel</button>
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg">Save</button>
        </div>
    </form>
</div>
```

</div>
@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('service-modal');
    const addBtn = document.getElementById('add-service-btn');
    const closeBtn = document.getElementById('close-modal');
    const form = document.getElementById('service-form');
    const modalTitle = document.getElementById('modal-title');

    const inputImage = document.getElementById('service-image');
    const inputName = document.getElementById('service-name');
    const inputDescription = document.getElementById('service-description');
    const inputPrice = document.getElementById('service-price');

    // Open Add Service Modal
    addBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modalTitle.textContent = 'Add New Service';
        form.action = "{{ route('admin.services.store') }}";
        form.reset();
        document.getElementById('service-id').value = '';
        form.querySelectorAll('input[name="_method"]').forEach(el => el.remove());
    });

    // Close Modal
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

    // Edit Service
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const tr = btn.closest('tr');
            const id = btn.dataset.id;
            const name = tr.querySelector('td:nth-child(1)').textContent;
            const description = tr.querySelector('td:nth-child(2)').textContent;
            const price = tr.querySelector('td:nth-child(3)').textContent.replace(/,/g, '');

            modal.classList.remove('hidden');
            modalTitle.textContent = 'Edit Service';
            document.getElementById('service-id').value = id;
            inputName.value = name.trim();
            inputDescription.value = description.trim();
            inputPrice.value = parseFloat(price);

            // Remove old _method fields
            form.querySelectorAll('input[name="_method"]').forEach(el => el.remove());

            // Update form action
            form.action = "{{ url('admin/services') }}/" + id;

            // Add PUT method field
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
        });
    });
});
</script>

@endsection
