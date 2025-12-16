<form method="POST" action="{{ route('admin.collector.add') }}">
    @csrf
    <input name="name" placeholder="Collector Name" required>
    <input name="email" placeholder="Email" required>
    <input name="password" placeholder="Password" type="password" required>
    <button>Add Collector</button>
</form>
