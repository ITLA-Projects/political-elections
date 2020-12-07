<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Welcome - Political-Elections</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootstrap.min.css" type="text/css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css" type="text/css">

</head>

<body>
    <!-- Header Include -->
    <?php require 'views/layouts/header.php' ?>
    <!-- -------------- -->


    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <form class="form-signin" method="POST" action="<?php echo constant('URL'); ?>welcome/enter">
                    <div class="text-center mb-4">
                        <img class="mb-4" src="<?php echo constant('URL'); ?>public/images/misc/urn.png" alt="" width="105" height="105">
                        <h1 class="h3 mb-3 font-weight-normal">Digital Voting System</h1>
                        <p>Vote for your preferred candidates in the elections (an open election is required to vote, for more information consult the administrator)</p>
                    </div>

                    <?php if ($this->someError !== "") : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->someError; ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-label-group mb-4">
                        <input type="text" id="identificationCard" class="form-control" placeholder="Identity Document (ID)" name="identificationCard" required autofocus>
                        <label for="identificationCard">Please insert you ID (Cedula)</label>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Try to vote!</button>
                    <p class="mt-3 mb-3 text-muted text-center">&copy; 2020</p>
                </form>
            </div>
        </div>
    </div>


    <!-- Footer Include -->
    <?php require 'views/layouts/footer.php' ?>
    <!-- -------------- -->
</body>

</html>