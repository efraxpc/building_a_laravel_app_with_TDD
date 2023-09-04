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

<form method="POST" action="{{ route('incidents.update') }}">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" value="{{$incident->name}}">
    <input type="hidden" name="id" value="{{$incident->id}}">
    <input type="submit" value="Submit">
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>