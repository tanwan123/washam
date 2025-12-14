@extends('admin.admin')

@section('page-title', 'Settings')

@section('content')
<div class="bg-white p-6 rounded-xl shadow space-y-6 max-w-xl">
    <h3 class="text-xl font-semibold mb-2">Profile Settings</h3>

    <form>
        <label class="block mb-2 text-sm font-medium text-gray-600">Name</label>
        <input type="text" class="w-full border rounded-lg p-2 mb-4" value="{{ Auth::user()->name }}">

        <label class="block mb-2 text-sm font-medium text-gray-600">Email</label>
        <input type="email" class="w-full border rounded-lg p-2 mb-4" value="{{ Auth::user()->email }}">

        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Update Profile</button>
    </form>
</div>
@endsection
