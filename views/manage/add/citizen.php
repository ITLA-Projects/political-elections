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

        <div class="row justify-content-center text-center">
          <!-- CHECK IS THE CITIZEN ELECTED-->
          <form action="<?php echo constant('URL') ?>citizens/add" method="POST" class="bg-white p-4 rounded-lg shadow">
            <div class="form-group">
              <label for="identificationCard">Identification Card</label>
              <input type="text" class="form-control" id="identificationCard" name="identificationCard" required>
            </div>
            <div class="form-group">
              <label for="firstname">Firstname</label>
              <input type="text" class="form-control" id="firstname" name="firstname" required >
            </div>
            <div class="form-group">
              <label for="lastname">Lastname</label>
              <input type="text" class="form-control" id="lastname" name="lastname" required >
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required >
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>

        </div>
      </div>
    </div>

  </main>

  <!-- Footer Include -->
  <?php require 'views/layouts/footer.php' ?>
  <!-- -------------- -->
</body>

</html>