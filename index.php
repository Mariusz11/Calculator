<?php

include 'class/Expenses.php';
include 'class/Revenues.php';
include 'class/Calculate.php';
include 'class/Connect.php';


if(isset($_POST['addExpense'])) {

    $exp = new Expenses();
    $exp->setDescription(addslashes($_POST['description']));
    $exp->setCost(addslashes($_POST['cost']), $_POST['rate']);
    $exp->setDate(date('Y-m-d G-i-s'));
    $exp->saveToDb();
    header("Location: index.php");
}

if(isset($_POST['addRevenue'])) {

    $rev = new Revenues();
    $rev->setDescription(addslashes($_POST['description']));
    $rev->setPrice(addslashes($_POST['price']));
    $rev->setQuantity(addslashes($_POST['quantity']));
    $rev->setTotal(24);
    $rev->setDate(date('Y-m-d G-i-s'));
    $rev->saveToDb();
    header("Location: index.php");
}

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
            $( "#dateFrom, #dateTo" ).datepicker({
                dateFormat: "yy-mm-dd"});
        });
    </script>
</head>
<body>
<div class="container"><br><br>

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

            <form class="form-horizontal well" method="POST" action="index.php">
                <h3>Wydatki</h3>

                <div class="form-group">
                    <label class="control-label col-sm-3">Opis</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="description" placeholder="opis"><br>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Koszt $</label>
                    <div class="col-md-9">
                        <input type="number" step="0.01" class="form-control" name="cost" placeholder="0"><br>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Kurs $</label>
                    <div class="col-md-9">
                        <input type="number" step="0.01" class="form-control"  name="rate" placeholder="1">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-default" name="addExpense" value="Dodaj">
                    </div>
                </div>
            </form>

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

            <form class="form-horizontal well" method="POST" action="index.php">
                <h3>Przychody</h3>

                <div class="form-group">
                    <label class="control-label col-md-3">Opis</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="description" placeholder="opis"><br>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Cena zł</label>
                    <div class="col-md-9">
                        <input type="number" step="0.01" class="form-control" name="price" placeholder="0"><br>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Ilość</label>
                    <div class="col-md-9">
                        <input type="number" class="form-control"  name="quantity" placeholder="1">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9">
                        <input type="submit" class="btn btn-default" name="addRevenue" value="Dodaj">
                    </div>
                </div>
            </form>
            


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
