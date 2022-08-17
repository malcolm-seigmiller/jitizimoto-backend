<?php
//
require_once "jiziconf.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>welcome to Jitzimoto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Jitzimoto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            </ul>
        </div>
    </nav>
    <!--  end of nav start of first fluid row  -->
    <div class="row fluid justify-content-center">
        <div class="col-md-6 main text-center">
            <h2 class="display-4">welcome to Jitzimoto</h2>
            <p>please enter the kind of business you are looking for.</p>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($cccode_err)) ? 'has-error' : ''; ?>">
                    <label>cccode</label>
                    <input type="cccode" name="cccode" class="form-control" value="<?php echo $cccode; ?>">
                    <span class="help-block"><?php echo $cccode_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                <p>Already have an account? <a href="login">Login here</a>.</p>
            </form>

        </div>
    </div>
</body>