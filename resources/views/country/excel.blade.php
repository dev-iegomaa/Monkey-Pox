<table>
    <thead>
    <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Iso</td>
        <td>Code</td>
    </tr>
    </thead>
    <tbody>
    @foreach($countries as $country)
        <tr>
            <td>{{ $country->id }}</td>
            <td>{{ $country->name }}</td>
            <td>{{ $country->iso }}</td>
            <td>{{ $country->code }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
