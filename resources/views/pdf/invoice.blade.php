<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background: #f2f2f2;
        }

        img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

    </style>
</head>
<body>

    <h2>{{ $title }}</h2>
    <p>Date: {{ $date }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Shop Name</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $index => $shop)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>
                    @php
                    if ($shop->image && file_exists(public_path('storage/'.$shop->image))) {
                    $type = pathinfo($shop->image, PATHINFO_EXTENSION);
                    $data = file_get_contents(public_path('storage/'.$shop->image));
                    $base64 = 'data:image/'.$type.';base64,'.base64_encode($data);
                    }
                    @endphp

                    @if(isset($base64))
                    <img src="{{ $base64 }}">
                    @endif
                </td>

                <td>{{ $shop->name ?? 'N/A' }}</td>
                <td>{{ $shop->email ?? 'N/A' }}</td>
                <td>{{ $shop->address ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
