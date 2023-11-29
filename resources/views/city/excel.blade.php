<table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Country</td>
            <td>City</td>
        </tr>
    </thead>
    <tbody>
        @foreach($cities as $city)
            <tr>
                <td> {{ $city->id }} </td>
                <td> {{ $city->country->name }} </td>
                <td> {{ $city->name }} </td>
            </tr>
        @endforeach
    </tbody>
</table>
