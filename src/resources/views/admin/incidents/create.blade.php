<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('incidents.index') }}">Back</a>
<h1>New incident</h1>

@if(Session::has('sucess'))
<p>{{ Session::get('sucess') }}</p>
@endif

<form method="POST" action="{{ route('incidents.store') }}">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" value="">

    <input type="submit" value="Submit">
</form>

</body>
</html>