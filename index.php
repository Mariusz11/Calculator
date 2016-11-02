<?php



?>

<html>
<head>
    <title>Calculator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>
<body>
<div class="container"><br><br>
    <div class="row">
        <div class="col-md-6">
            <h3>Wydatki</h3>
            <form class="form-inline" method="POST" action="login.php">
                <input type="text" class="form-control" name="description" placeholder="opis">
                <input type="number" step="0.01" class="form-control" name="cost" placeholder="0">
                <input type="submit" class="btn btn-default" name="add" value="Dodaj">
            </form>
        </div>
        <div class="col-md-6">
            <h3>Przychody</h3>
            <form class="form-inline" method="POST" action="login.php">
                <div class="form-group">
                    <input type="text" class="form-control" name="description" placeholder="opis"><br>
                    <input type="number" step="0.01" class="form-control" name="description" placeholder="0">
                    X <input type="number" class="form-control"  name="cost" placeholder="1">
                    <input type="submit" class="btn btn-default" name="add" value="Dodaj">
                </div>
            </form>
        </div>
    </div>


</div>

</body>
</html>