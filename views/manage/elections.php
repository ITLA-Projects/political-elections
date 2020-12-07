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
            <?php if (!$this->exists) : ?>
                <div>
                    <a href="<?php echo constant('URL') ?>admin" class="btn btn-outline-warning">Go Back</a>
                    <a href="<?php echo constant('URL') ?>elections/initialize" class="btn btn-outline-primary">Initialize Elections</a>
                </div>
            <?php endif; ?>

            <div>
                <?php if ($this->message !== "") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->message; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    <!-- CHECK IS THE CITIZEN ELECTED-->
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->list as $entity) : ?>
                                <tr>
                                    <th scope="row"><?php echo $entity->id; ?></th>


                                    <th><?php echo $entity->name; ?></th>
                                    <th><?php echo $entity->date ?></th>

                                    <?php if ($entity->status) : ?>
                                        <th>Active</th>
                                        <th><a href="<?php echo constant('URL') . 'elections/terminate?id=' . $entity->id ?>" class="btn btn-danger">Finish Elections</a></th>
                                    <?php else : ?>
                                        <th>Inactive</th>
                                        <th><a href="<?php echo constant('URL') . 'results?id=' . $entity->id ?>" class="btn btn-primary">Get Results</a></th>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </main>

    <!-- Footer Include -->
    <?php require 'views/layouts/footer.php' ?>
    <!-- -------------- -->
</body>

</html>