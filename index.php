<?php

use classes\Users;

require_once __DIR__ . '/vendor/autoload.php';
$users = new Users();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-sm">
        <div class="d-flex justify-content-end">
            <a class="btn btn-danger mt-3 mb-3" href="add_user_form.php" role="button">Add User</a>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Live Search</span>
            <input id="search" type="text" class="form-control" placeholder="Enter any data you want to search" aria-label="Enter any data you want to search" aria-describedby="basic-addon1">
        </div>
        <table id="table" class="table table-striped"></table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.column_name', function () {
                let idValue = $(this).attr('id');
                let order = $(this).data('order');
                $.ajax({
                    url: 'sorter.php',
                    method: 'POST',
                    data: {
                        id: idValue,
                        order: order
                    },
                    success: function (data) {
                        $('#table').html(data);
                    }
                });
            });

            loadData();

            function loadData(query) {
                $.ajax({
                    url: 'find_data.php',
                    method: 'POST',
                    data: {query: query},
                    success: function (data) {
                        $('#table').html(data);
                    }
                });
            }

            $('#search').keyup(function () {
                let search = $(this).val();
                if (search){
                    loadData(search);
                } else {
                    loadData();
                }
            });
        });
    </script>
</body>
</html>