<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body class="container py-6">
    @if(Session::has('sucess'))
    <p>{{ Session::get('sucess') }}</p>
    @endif
    <table class="table table-striped table-hover caption-top">
        <caption>Incidents</caption>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($incidents as $incident)
            <tr>
                <td scope="row"><a href="{{ route('incidents.show',$incident->id) }}">{{ $incident->id }}</a></td>
                <td scope="row">{{ $incident->name }}</td>
                <td scope="row"><a href="{{ route('incidents.destroy',$incident->id) }}">Delete</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="3">
                    <p>There is no records</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $incidents->links() }}

    <a href="{{ route('incidents.create') }}">
        New
    </a>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>