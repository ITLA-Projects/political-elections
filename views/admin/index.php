<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Admin Page</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootstrap.min.css" type="text/css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css" type="text/css">

</head>

<body>
    <!-- Header Include -->
    <?php require 'views/layouts/header.php' ?>
    <!-- -------------- -->
    <main role="main">

        <section class="text-center my-3">
            <div class="container">
                <h1 class="jumbotron-heading">Selection Panel</h1>
                <p class="lead text-muted">only for admins</p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                        <!-- CHECK IS THE CITIZEN ELECTED-->
                 
                            <div class="col-md-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Citizens (Ciudadanos)</h5>
                                        <p class="card-text">Manage The Citizens</p>
                                        <a href="<?php echo constant('URL') ?>citizens" class="btn btn-primary">Manage Citizens</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Political Parties (Partidos)</h5>
                                        <p class="card-text">Manage The Political Parties</p>
                                        <a href="<?php echo constant('URL') ?>politicalParties" class="btn btn-primary">Manage</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Candidates (Candidatos)</h5>
                                        <p class="card-text">Manage The Candidates</p>
                                        <a href="<?php echo constant('URL') ?>candidates" class="btn btn-primary">Manage Candidates</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Elective Positions (Puestos Electivos)</h5>
                                        <p class="card-text">Manage The Positions</p>
                                        <a href="<?php echo constant('URL') ?>electoralPositions" class="btn btn-primary">Manage Positions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Elections (Elecciones)</h5>
                                        <p class="card-text">Manage The Elections</p>
                                        <a href="<?php echo constant('URL') ?>elections" class="btn btn-primary">Manage Elections</a>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer Include -->
    <?php require 'views/layouts/footer.php' ?>
    <!-- -------------- -->
</body>

</html>