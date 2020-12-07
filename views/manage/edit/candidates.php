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
          <form enctype="multipart/form-data" action="<?php echo constant('URL') ?>candidates/edit" method="POST" class="bg-white p-4 rounded-lg shadow">
            <input type="hidden" name="id" value="<?php echo $this->entity->id ?>">
            <input type="hidden" name="photo" value="<?php echo $this->entity->photo ?>">
            <div class="form-group">
              <label for="firstname">Firstname</label>
              <input type="text" class="form-control" id="firstname" name="firstname" required value="<?php echo $this->entity->firstname ?>">
            </div>
            <div class="form-group">
              <label for="lastname">Lastname</label>
              <input type="text" class="form-control" id="lastname" name="lastname" required value="<?php echo $this->entity->lastname ?>">
            </div>
            <div class="form-group">
              <label for="photo">Photo</label>
              <input type="file" class="form-control" id="photo" name="photo">
            </div>

            <div class="form-group">
              <label for="politicalParty">Political Party</label>
              <select class="form-control" id="politicalParty" name="politicalParty">
                <?php foreach ($this->politicalPartyList as $key => $politicalEntity) :  ?>
                  <?php if ($this->entity->politicalParty == $politicalEntity->id) : ?>
                    <option selected value="<?php echo $politicalEntity->id ?>"><?php echo $politicalEntity->name ?></option>
                  <?php else : ?>
                    <option value="<?php echo $politicalEntity->id ?>"><?php echo $politicalEntity->name ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="electoralPosition">Electoral Position</label>
              <select class="form-control" id="electoralPosition" name="electoralPosition">
                <?php foreach ($this->electoralPositionList as $key => $eletoralEntity) :  ?>
                  <?php if ($this->entity->electoralPosition == $eletoralEntity->id) : ?>
                    <option selected value="<?php echo $eletoralEntity->id ?>"><?php echo $eletoralEntity->name ?></option>
                  <?php else : ?>
                    <option value="<?php echo $eletoralEntity->id ?>"><?php echo $eletoralEntity->name ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group form-check">
              <?php if ($this->entity->status) : ?>
                <input checked type="checkbox" class="form-check-input" id="status" name="status">
              <?php else : ?>
                <input type="checkbox" class="form-check-input" id="status" name="status">
              <?php endif; ?>

              <label class="form-check-label" for="status">Active?</label>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
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