@extends('admin.admin')

@section('content')
<h1 class="text-3xl font-bold mb-4">Users</h1>
<table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
    <thead class="bg-green-600 text-white">
        <tr>
            <th class="py-2 px-4">ID</th>
            <th class="py-2 px-4">Name</th>
            <th class="py-2 px-4">Email</th>
            <th class="py-2 px-4">Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-t">
            <td class="py-2 px-4">{{ $user->id }}</td>
            <td class="py-2 px-4">{{ $user->name }}</td>
            <td class="py-2 px-4">{{ $user->email }}</td>
            <td class="py-2 px-4">{{ $user->admin ? 'Admin' : 'User' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
