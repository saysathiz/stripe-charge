<!DOCTYPE html>
<html lang="en">
<head>
  <title>Products</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

 
<div class="container">
  <div class="row">
    @foreach($products as $row)
    <div class="col-sm-4">
      <h3>{{ $row->name }}</h3>
      <h5>${{ $row->price }}</h5>
      <p>{{ $row->description }}</p>
      <a href="{{ url('charge/'.$row->id) }}" class="btn btn-info btn-sm">Buy Now</a>
    </div>
    @endforeach
  </div>
</div>

</body>
</html>
