<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
      <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
     <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	 <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
</head>
<body>

<table id="alert_groups-table" class="table table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
    </tr>
    </thead>
</table>
<script>
    $(function () {
        $('#alert_groups-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: '/eloquent/array-data'
        });
    });
</script>
</body>
</html>
