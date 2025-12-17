<h2> Edit Employee </h2>

<form method="POST" action="{{ route=('employee.update',$employee->id) }}" >
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $employee->name }} "><br><br>
    <input type="email" name="email"  value="{{ $employee->email}} "><br><br>
    <input type="text" name="phone"  value="{{ $employee->phone }} "><br><br>
    <input type="text" name="role"  value="{{ $employee->naroleme }} "><br><br>

    <button>update</button>
</form>