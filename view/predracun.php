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
						<span class="marginright">14 April 2014</span>
			    </div>
			</div>
			<hr>
			<div class="row">

				<div class="col-md-4 from">
					<p class="lead marginbottom">From : Dynofy</p>
					<p>350 Rhode Island Street</p>
					<p>Suite 240, San Francisco</p>
					<p>California, 94103</p>
					<p>Phone: 415-767-3600</p>
					<p>Email: contact@dynofy.com</p>
				</div>

				<div class="col-md-4 to">
					<p class="lead marginbottom">To : John Doe</p>
					<p>425 Market Street</p>
					<p>Suite 2200, San Francisco</p>
					<p>California, 94105</p>
					<p>Phone: 415-676-3600</p>
					<p>Email: john@doe.com</p>

			    </div>

			    <div class="col-md-4 text-right payment-details">
					<p class="lead marginbottom payment-info">Payment details</p>
					<p>Date: 14 April 2014</p>
					<p>VAT: DK888-777 </p>
					<p>Total Amount: $1019</p>
					<p>Account Name: Flatter</p>
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
			      <tbody>
			        <tr>
			          <td class="text-center">1</td>
			          <td>Flatter Theme</td>
			          <td class="text-right">10</td>
			          <td class="text-right">$18</td>
			          <td class="text-right">$180</td>
			        </tr>
			        <tr>
			          <td class="text-center">2</td>
			          <td>Flat Icons</td>
			          <td class="text-right">6</td>
			          <td class="text-right">$59</td>
			          <td class="text-right">$254</td>
			        </tr>
			        <tr>
			          <td class="text-center">3</td>
			          <td>Wordpress version</td>
			          <td class="text-right">4</td>
			          <td class="text-right">$95</td>
			          <td class="text-right">$285</td>
			        </tr>
			         <tr class="last-row">
			          <td class="text-center">4</td>
			          <td>Server Deployment</td>
			          <td class="text-right">1</td>
			          <td class="text-right">$300</td>
			          <td class="text-right">$300</td>
			        </tr>
			       </tbody>
			    </table>

			</div>

      <hr>
			<div class="row">
			<div class="col-xs-6 text-right pull-left invoice-total w-100">
					  <p>Subtotal : $1019</p>
			          <p>Discount (10%) : $101 </p>
			          <p>VAT (8%) : $73 </p>
			          <p>Total : $991 </p>
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
<script src="scripts/trgovina.js"></script>
<script src="scripts/navbar.js"></script>

</body>
</html>
