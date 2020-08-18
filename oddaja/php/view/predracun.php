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

  <div class="container bootstrap snippets bootdeys">
<div class="row">
  <div class="col-sm-12">
	  	<div class="panel panel-default invoice" id="invoice">
		  <div class="panel-body">
			<div class="invoice-ribbon"></div>
		    <div class="row">
				<div class="col-sm-6 top-left">
						<h3 class="marginright">Predracun</h3>
						<span class="marginright mydate"></span>
			    </div>
			</div>
			<hr>
			<div class="row">

				<div class="col-md-4 from">
					<p class="lead marginbottom">From : EPOS</p>
					<p>Vecna Pot 113</p>
					<p>Ljubljana, Slovenia</p>
					<p>Phone: 415-767-3600</p>
					<p>Email: epos@gmail.com</p>
				</div>

				<div class="col-md-4 to">
					<p class="lead marginbottom" id="naslovnik">To : </p>
					<p id="naslov"></p>
					<p>Ljubljana, Slovenia</p>
					<p id="telefon">Phone: </p>
					<p id="mail">Email: </p>

			    </div>

			    <div class="col-md-4 text-right payment-details">
					<p class="lead marginbottom payment-info">Payment details</p>
					<p class="mydate"></p>
					<p>DDV: 22% </p>
					<p class="mytotal">Total Amount: </p>
					<p>Stevilka racuna: N/A</p>
			    </div>

			</div>

			<div class="row table-row">
				<table class="table table-striped">
			      <thead>
			        <tr>
			          <th class="text-center" style="width:5%">#</th>
			          <th style="width:50%">Item</th>
			          <th class="text-right" style="width:15%">Quantity</th>
			          <th class="text-right" style="width:15%">Unit Price</th>
			          <th class="text-right" style="width:15%">Total Price</th>
			        </tr>
			      </thead>
			      <tbody id="predracun">
			      </tbody>
			    </table>

			</div>

      <hr>
			<div class="row">
			<div class="col-xs-6 text-right pull-left invoice-total w-100">
					  <p id="subtotal">Subtotal : </p>
			      <p id="ddv">DDV (22%) : </p>
			      <p id="total">Total : $991 </p>
			</div>
			</div>

		  </div>
		</div>
	</div>
</div>
</div>

<div class="flex-column align-items-end" style="margin-top: 1.5rem;padding-right: 3.5rem;">
<button type="button" class="btn col-md-3 btn-primary float-md-right" onclick="zakljuciNakup()">Potrdi</button>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="scripts/predracun.js"></script>
<script src="scripts/navbar.js"></script>

</body>
</html>
