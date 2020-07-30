<html>
<header>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</header>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="trgovina.php">EPOS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup"></div>
  </nav>

  <div class="container">
        <div class="card card-signin my-5">
          <div class="card-body">

          <h5 class="card-title text-left disabled">Profil</h5>
              <form class="form-signin" id="profil">
                <div class="form-label-group">
                  <label for="firstName">Ime</label>
                  <input type="firstName" id="ime" class="form-control" placeholder="" required autofocus disabled>
                </div>

                <div class="form-label-group">
                  <label for="firstName">Priimek</label>
                  <input type="lastName" id="priimek" class="form-control" placeholder="" required autofocus disabled>
                </div>

                <div class="form-label-group">
                  <label for="firstName">Vloga</label>
                  <input type="lastName" id="vloga" class="form-control" placeholder="" required autofocus disabled>
                </div>


                <div class="form-label-group">
                  <label for="firstName">Naslov</label>
                  <input type="firstName" id="naslov" class="form-control" placeholder="" required autofocus disabled>
                </div>

                <div class="form-label-group">
                  <label for="firstName">Telefonska stevilka</label>
                  <input type="lastName" id="telefon" class="form-control" placeholder="" required autofocus disabled>
                </div>

                <div class="form-label-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" id="email" class="form-control" placeholder="" required autofocus disabled>
                </div>

                <div class="form-label-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" id="geslo" class="form-control" placeholder="" required disabled>
                </div>
                </br></br></br>

                <div class="row justify-content-end">
                  <div class="col-md-2">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Posodobi</button>
                  </div>
                </div>
              </form>
          </div>
        </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="scripts/profil.js"></script>
<script src="scripts/navbar.js"></script>

</body>
</html>
