<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; padding: 8px; }
        th { background: #f2f2f2; }
        img { width: 60px; height: 60px; object-fit: cover; }
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
                    $imagePath = $shop->image
                        ? public_path('storage/'.$shop->image)
                        : null;
                @endphp

                @if($imagePath && file_exists($imagePath))
                    <img src="{{ $imagePath }}">
                @else
                    N/A
                @endif
            </td>

            <td>{{ $shop->shop_name ?? 'N/A' }}</td>
            <td>{{ $shop->email ?? 'N/A' }}</td>
            <td>{{ $shop->address ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
