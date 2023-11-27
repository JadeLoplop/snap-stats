<table>
    <thead>
    <tr>
        <th>Publisher</th>
        <th>Impressions</th>
        <th>Conversions</th>
        <th>Conversion Rate</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stats as $stat)
        <tr>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
