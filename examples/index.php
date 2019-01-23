<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>HMRC API Examples</title>
    <style>
        body {
            margin-top: 10px;
        }
    </style>
</head>
<body class="container">
<h3>HMRC API Examples</h3>
<hr>
<div>
    <div class="row">
        <div class="col-sm">
            <input type="text" class="form-control" name="client_id" placeholder="Client ID" value="58Dvv2CAtfe8ZXq0nfCR5qPe7bUa">
        </div>
        <div class="col-sm">
            <input type="text" class="form-control" name="client_secret" placeholder="Client Secret" value="0833135d-b932-4557-bbdd-7dd8732ea009">
        </div>
        <div class="col-sm">
            <input type="text" class="form-control" name="server_token" placeholder="Server Token">
        </div>
    </div>
</div>
<hr>
<div>
    <h5>1. Hello world</h5>
    <a href="javascript:void(0)" onclick="openPage('/examples/hello/hello-world.php')">
        <button class="btn btn-sm btn-primary">Test</button>
    </a>
</div>
<hr>

<div>
    <h5>2. Hello world application <span class="badge badge-danger">Server Token</span></h5>
    <a href="javascript:void(0)" onclick="openPage('/examples/hello/hello-world-application.php')">
        <button class="btn btn-sm btn-primary">Test</button>
    </a>
</div>
<hr>

<div>
    <h5>3. Hello world user <span class="badge badge-danger">Client ID</span> <span class="badge badge-danger">Client Secret</span></h5>
    <a href="javascript:void(0)" onclick="openPage('/examples/hello/hello-world-user.php')">
        <button class="btn btn-sm btn-primary">Test</button>
    </a>
</div>
<hr>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    function openPage(link) {
        const clientId = $("input[name='client_id']").val();
        const clientSecret = $("input[name='client_secret']").val();
        const serverToken = $("input[name='server_token']").val();

        let query = [];

        if(clientId !== "") {
            query.push(`client_id=${clientId}`);
        }

        if(clientSecret !== "") {
            query.push(`client_secret=${clientSecret}`);
        }

        if(serverToken !== "") {
            query.push(`server_token=${serverToken}`);
        }

        const queryString = query.join('&');

        if(query.length) {
            location.href = link + '?' + queryString;
        } else {
            location.href = link;
        }
    }
</script>
</body>
</html>

