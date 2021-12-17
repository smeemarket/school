<h1>Admin Dashboard</h1>

@if(Session::has('authError'))
    <p style="color:red">{{ Session::get('authError') }}</p>
@endif

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" value="Logout">
</form>
