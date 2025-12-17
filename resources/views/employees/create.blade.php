<h2>Add Employee </h2>

<form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="name" placeholder="name"><br><br>
<input type="email" name="email" placeholder="email"><br><br>
<input type="text" name="phone" placeholder="phone"><br><br>
<input type="text" name="role" placeholder="role"><br><br>
<input type="file" name="photo" ><br><br>
<button type="submit" >Save</button>
</form>