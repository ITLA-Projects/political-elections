<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Select your Position</title>

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
                <p class="lead text-muted">Here you can select your candidates depending on the position you choose, remember that you can only vote once per selective position, be careful!</p>
                <p>
                    <a href="#" class="btn btn-outline-success my-2">Finish Selections</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    <?php foreach ($this->positionList as $key => $position) : ?>
                        <!-- CHECK IS THE CITIZEN ELECTED-->
                        <?php 

                        $coincidence = false;
                        
                        foreach ($this->alreadyVotedByCitizen as $key => $value) {
                            if($value->electoralPosition === $position->id){
                                $coincidence = true;
                            }
                        }

                        ?>

                       


                        <?php if ($position->status) : ?>
                            <div class="col-md-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?php echo constant('URL') . 'public/images/electoral_positions/' . $position->photo; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $position->name ?></h5>
                                        <p class="card-text"><?php echo $position->description ?></p>
                                        <a href="<?php echo constant('URL') . 'vote?id=' . $position->id; ?>" class="btn btn-primary">Select Your Candidate</a>
                                    </div>
                                    <?php if ($coincidence) : ?>
                                    <div class="position-absolute w-100 h-100 selected-card">
                                        <img src="<?php echo constant('URL') ?>public/images/misc/voted.png" alt="" width="100%">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>



                        <?php endif; ?>
                        <!-- CHECK IS THE CITIZEN ELECTED-->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer Include -->
    <?php require 'views/layouts/footer.php' ?>
    <!-- -------------- -->
</body>

</html>