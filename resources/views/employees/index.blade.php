<h2>Employees List </h2>
<a href="{{ route('employees.create') }}" >Add Employee</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Photo</th>
        <th>Action</th>
    </tr>

    @foreach( $employees as $emp )
    <tr>
        <td>{{ $emp->name }}</td>
        <td>{{ $emp->email }}</td>
        <td>{{ $emp->phone }}</td>
        <td>{{ $emp->role }}</td>
        <td>
            @if($emp->photo)
            <img src="{{ asset('storage/'.$emp->photo) }}" width="50">
            @endif
        </td>
        <td>
            <form method="POST" action="{{ route('employees.destroy',$emp->id) }}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>  
        </td>  
    </tr>
    @endforeach
</table>