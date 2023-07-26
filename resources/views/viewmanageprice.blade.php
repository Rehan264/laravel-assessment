@extends('master.master')
@section('content')
    <style>
        /* Style for the outer container with the rounded corners */
        .rounded-box {
            background-color: #e1e1e1;
            padding: 10px;
            border: 1px solid #999;
            border-radius: 10px;
            box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.5);
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #000000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .price-row {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group .form-control {
            flex: 1;
            margin-right: 10px;
        }

        .removeRowPrice {
            background-color: rgb(134, 2, 2);
            color: white;
            border: none;
            cursor: pointer;
        }

        /* Basic button styling */
        #addRow {
            background-color: #4CAF50;
            /* Green background color */
            color: white;
            /* Text color */
            padding: 10px 20px;
            /* Top and bottom padding of 10px, left and right padding of 20px */
            border: none;
            /* Remove default button border */
            border-radius: 5px;
            /* Rounded corners */
            cursor: pointer;
            /* Change cursor to a pointer on hover */
            font-size: 16px;
            /* Font size of the text */
        }

        /* Style the button on hover */
        #addRow:hover {
            background-color: #45a049;
            /* Darker green background color */
        }
    </style>
    <form action="{{ route('price.manage') }}" method="POST" enctype="multipart/form-data">
        @if (session('success'))
            <div class="alert alert-success" style="color: green;">
                {{ session('success') }}
            </div>
        @endif
        @csrf
        <div class="rounded-box">
            <p>Click on 'Manage more' to add dynamic fields</p>
            <div class="row">
                <div class="col-md-12">
                    <div id="inputFormRowPrices"></div>
                    <br>
                    <button id="addRow" type="button">Manage more</button>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div>
            <button type="submit" style="background-color: rgb(134, 134, 134)">Submit</button>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $("#addRow").click(function() {
            var html = '';
            html += '<div class="price-row">'; // Start a container for the row
            html += '<div class="input-group mb-3">';
            // Adding the select tag input for product
            html += '<select name="product[]" class="form-control m-input" title="Choose Product" required>';
            html += '<option value="" disabled selected>Select product</option>';
            @foreach ($products as $product)
                html += '<option value="{{ $product['id'] }}">{{ $product['name'] }}</option>';
            @endforeach
            html += '</select>';
            // Adding the select tag input for user
            html += '<select name="user[]" class="form-control m-input" title="Choose user" required>';
            html += '<option value="" disabled selected>Select user</option>';
            @foreach ($users as $user)
                html += '<option value="{{ $user['id'] }}">{{ $user['name'] }}</option>';
            @endforeach
            html += '</select>';
            //New Price input
            html +=
                '<input type="number" name="price[]" class="form-control m-input" value="" placeholder="Enter New Price" required>';
            html += '<button type="button" class="removeRowPrice" style="backgroundcolor:red">Remove</button>';
            html += '</div>';
            html += '<br>';
            html += '</div>';
            $('#inputFormRowPrices').append(html);
        });
        // Remove row
        $(document).on('click', '.removeRowPrice', function() {
            $(this).closest('.price-row').remove(); // Remove the entire row container
        });
    </script>
@endsection
