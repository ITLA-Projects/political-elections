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
                <h1 class="jumbotron-heading">Position Selected: <?php echo $this->selectedPosition->name ?></h1>
                <p class="lead text-muted"><?php echo $this->selectedPosition->description ?></p>
                <p>
                    <a href="<?php echo constant('URL') ?>selection" class="btn btn-warning my-2">Go back</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">

                    <?php foreach ($this->candidateList as $key => $candidate) : ?>
                        <?php if ($candidate->status) : ?>
                            <div class="col-md-4 mb-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?php echo constant('URL') . 'public/images/candidates/' . $candidate->photo; ?>" class="card-img-top" alt="..." width="100px">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $candidate->firstname . " " . $candidate->lastname ?></h5>
                                        <p class="card-text"><?php echo $this->politicalPartyRepo->GetById($candidate->politicalParty)->name ?></p>
                                        <img src="<?php echo constant('URL') . 'public/images/logos/' . $this->politicalPartyRepo->GetById($candidate->politicalParty)->logo; ?>" alt="" width="50" height="50">
                                       
                                        <form action="<?php echo constant('URL') ?>vote/try" method="POST">
                                        <input id="candidate" name="candidate" type="hidden" value="<?php echo $candidate->id ?>">
                                        <input id="electoralPosition" name="electoralPosition" type="hidden" value="<?php echo $this->selectedPosition->id ?>">

                                        <button class="btn btn-primary">Select This Candidate</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
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