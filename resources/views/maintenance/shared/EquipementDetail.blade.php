<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Jour</th>
        @foreach ($params as $param)
            <th>{{ $param }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($resultats as $ligne)
        <tr>
            <td>{{ \Carbon\Carbon::parse($ligne->dateajout)->format('d-m-Y') }}</td>
            @foreach ($params as $param)
                <td>{{ $ligne->$param }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
