@extends('master.master')
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }
    </style>
    <h1>Users List</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td> {{ $product->name }}</td>
                    <td>
                        {{-- If the product has new price  --}}
                        @if ($product->newPrices->isNotEmpty())
                            <strong>New Price:</strong> {{ $product->newPrices->first()->newprice }}
                        @else
                        {{-- Else display the old price  --}}
                            <strong>Old Price:</strong> {{ $product->price }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
