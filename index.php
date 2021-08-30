<?php

$con = mysqli_connect('localhost','root','','smrusqsn_store');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container text-center mt-5">
        <h2 class="pt-5 pb-5 mb-5"> Download DataBase into Excel or PDF</h2>
        
        <form action="download.php" method="post" class="form-inline d-flex justify-content-center">
            <select name="tabName" required class="form-control col-md-4 mr-3">
                <option>Select a Table</option>
                <option>Brands</option>
                <option>Categories</option>
                <option>Orders</option>
                <option>Order Item</option>
                <option>Product</option>
                <option>Users</option>
            </select>
            <select name="format" class="form-control col-md-2" required>
                <option>Select File Format</option>
                <option>Excel</option>
                <option>PDF</option>
            </select>
            <input type="submit" name="submit" value="Download Table" class="btn btn-primary ml-4">
        </form>



    </div>
</body>
</html>