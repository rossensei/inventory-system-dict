<!DOCTYPE html>
<html>
<head>
    <title>{{ $employee->fname }} {{ $employee->lname }} Inventory</title>

    <style>
        * {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif';
            font-size: 10pt;
        }

        h1 {
            font-size: 18pt;
        }

        table {
            width: 100%;
        }

        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
        }

        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            line-height: 0;
        }

        #total-count {
            font-size: 25px;
        }

        #header-text {
            font-size: 12pt;
            text-transform: uppercase;
            font-style: bold;
        }
    </style>
</head>
<body>


    <header style="text-align: center;">
        <img src="{{ public_path('images/Logo.png') }}" style="width: 80px; margin-top: 15px;" alt="dict-logo">
        <p>Department of Information</p>
        <p>Communications Technology</p>
        <p id="header-text" style="margin-top: 25px;">LIST OF PROPERTIES/ASSETS</p>
    </header>

    <main>
        <p>
        Employee: {{ $employee->fname }} {{ $employee->lname }} <br>
        Date Generated: {{ $date_generated }} <br>
        Total count: {{ $properties->count() }}  
        </p>
        
        <table class="table table-bordered">
            <thead>
                <th>PROPERTY NO.</th>
                <th>ITEM/BRAND/MODEL</th>
                <th>DESCRIPTION</th>
                <th>SERIAL NO.</th>
                <th>CATEGORY</th>
                <th>MEASUREMENT UNIT</th>
                <th>UNIT VALUE</th>
                <th>OFFICE</th>
                <th>ACQUISITION TYPE</th>
                <th>ACQUISITION DATE</th>
                <th>RECEIVED FROM</th>
                <th>RECEIVED BY</th>
                <th>PERSON ACCOUNTABLE</th>
                <th>STATUS</th>
            </thead>
            <tbody>
                @foreach($properties as $data)
                    <tr>
                        <td>{{ $data->property_no }}</td>
                        <td>{{ $data->item_name }}</td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->serial_no }}</td>
                        <td>{{ $data->category->getPath() }}</td>
                        <td>{{ $data->measurement_unit }}</td>
                        <td>{{ $data->unit_value }}</td>
                        <td>{{ $data->office->office_name }}</td>
                        <td>{{ $data->acquisition->name }}</td>
                        <td>{{ $data->date_acquired }}</td>
                        <td>{{ $data->received_from }}</td>
                        <td>{{ $data->receivedBy->fname }} {{ $data->receivedBy->lname }}</td>
                        <td>{{ $data->assignedTo->fname }} {{ $data->assignedTo->lname }}</td>
                        <td>{{ $data->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </main>
</body>
</html>