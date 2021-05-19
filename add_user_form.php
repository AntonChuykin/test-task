<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-sm mt-3 mb-3">
        <div class="add-user-header d-flex justify-content-between">
            <h4>Add User</h4>
            <div class="btn-group">
                <a href="index.php" class="btn btn-primary active" aria-current="page">Back</a>
                <a href="#" class="save-btn btn btn-primary">Save & Exit</a>
            </div>
        </div>
        <hr>
        <div class="user-information">
            <h5>User Information</h5>
            <div class="user-information-form">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">First Name</span>
                    <input type="text" class="first-name form-control" placeholder="Enter first name" aria-label="Enter first name" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Last Name</span>
                    <input type="text" class="last-name form-control" placeholder="Enter last name" aria-label="Enter last name" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input type="text" class="email form-control" placeholder="Enter email" aria-label="Enter email" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.save-btn', function () {
                let firstName = $('.first-name').val();
                let lastName = $('.last-name').val();
                let email = $('.email').val();
                $.ajax({
                    url: 'add_user.php',
                    method: 'POST',
                    data: {
                        first_name: firstName,
                        last_name: lastName,
                        email: email
                    },
                    success: function (data) {
                        window.location = 'index.php'
                    }
                });
            })
        });
    </script>
</body>
</html>