<?php

include 'class/Expenses.php';
include 'class/Revenues.php';
include 'class/Calculate.php';
include 'class/Connect.php';

if(isset($_POST['idExp'])){
    $delExp = new Expenses();
    $delExp->deleteExpense(addslashes($_POST['idExp']));
    header("Location: index.php");
}

if(isset($_POST['idRev'])){
    $delRev = new Revenues();
    $delRev->deleteRevenue(addslashes($_POST['idRev']));
    header("Location: index.php");
}
?>

<html>
<head>
    <title>Calculator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#dateFrom, #dateTo" ).datepicker();
        });
    </script>
</head>
<body>
<div class="container"><br><br>

    <a href="index.php">Wróć</a>

    <div class="row">

        <div class="col-md-6">
            <h3>Bilans:
                <?php
                $total = new Calculate();
                echo $total->total();
                ?> zł
            </h3>
        </div>

        <div class="col-md-6">
            <form class="form-inline" method="POST" action="showByDate.php">
                od: <input type="date" id="dateFrom" />
                do: <input type="date" id="dateTo" />
                <input type="submit" value="Pokaż">
            </form>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 jumbotron">

            <h4 class="well">Twoje łączne wydatki to:
                <?php
                $sumExp = new Calculate();
                echo $sumExp->sumAllExpenses();
                ?> zł
            </h4>


            <table class="table well">
                <?php
                $allExp = new Expenses();
                $allExp->loadAllExpenses();
                ?>
            </table>
        </div>



        <div class="col-md-6 jumbotron">

            <h4 class="well">Twoje łączne przychody to:
                <?php
                $sumRev = new Calculate();
                echo $sumRev->sumAllRevenues();
                ?> zł
            </h4>

            <table class="table well">
                <?php
                $allRev = new Revenues();
                $allRev->loadAllRevenues();
                ?>
            </table>
        </div>
    </div>


</div>

</body>
</html>