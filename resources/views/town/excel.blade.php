<table>
    <thead>
    <tr>
        <td>Id</td>
        <td>City</td>
        <td>Town</td>
    </tr>
    </thead>
    <tbody>
    @foreach($towns as $town)
        <tr>
            <td>{{ $town->id }}</td>
            <td>{{ $town->city->name }}</td>
            <td>{{ $town->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
