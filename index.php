<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KHM Travel Developer Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 pt-5">
                <form action="insert-data.php" method="post" class="text-center">
                    <h1 class="display-6 mb-3">Best televison show of all time:</h1>
                    <input type="text" name="tv-show" class="form-control mb-3" placeholder="Input the TV show here...">
                    <input type="submit" name="submit" class="btn btn-primary align-center" value="Save to database">
                </form>
            </div>
        </div>
    </div>

</body>

</html>