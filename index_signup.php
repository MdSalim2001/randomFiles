
<!DOCTYPE html>

<head>
    <title>Prisoner - Registration</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Flat lay login form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <!-- CSS and Bootsrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="web/css/prisoner-sign-up.css">
</head>

<body>
<?php include('HM/newheader.php') ?>

<!-------------- Content --------------->
<div class="container">
  
  <div class="col lg-6 sign-up">
      <div class="form">
        <form action="prisoner_backend/signup.inc.php" method="POST" class="register-form">
          <p class="message-sign-up">PRISONER REGISTRATION</p>
          <input type="text" placeholder="Prisoner ID" name="username">
          <input type="text" placeholder="First Name" name="f_name">
          <input type="text" placeholder="Last Name" name="l_name">

          <select class="custom-select prisoner-text" name="gender">
                    <option selected>Gender</option>
                    <option value="1">Male</option>
                    <option value="0">Female</option>
          </select>

          <input type="text" placeholder="Sentence" name="year">
            </input> 

            <select class="custom-select prisoner-text" name="crime">
                    <option selected>Crime</option>
                    <option value="Theft & Robbery">Theft & Robbery</option>
                    <option value="Homicide">Homicide</option>
                    <option value="Kidnapping">Kidnapping</option>
                    <option value="Substance Abuse">Substance Abuse</option>
                    <option value="Domestic Abuse">Domestic Abuse</option>
                    <option value="Others">Others</option>
             </select>

          <input type="text" placeholder="Mobile" name="mobile">
          <input type="password" placeholder="Password" name="password">
          <input type="password" placeholder="Re-Enter Password" name="confpassword">
          <button type="submit" name="signup-prisoner">Register Prisoner</button>
        </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
