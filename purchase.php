<?php 
	include_once 'book_sc_fns.php';
	include_once 'output_fns.php';

	session_start(); 

	//header
	do_html_header("Purchase");

	// create short variable names
	$name = $_POST['name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$phonenum = $_POST['phonenum'];
	$state = $_POST['province'];
	$country = $_POST['country'];

	// if filled out
	if (($_SESSION['cart']) && ($name) && ($address) && ($city) && ($phonenum)  && ($state) && ($country)) {

		// able to insert into database
		


		if(insert_order($_POST) != false ) {

			//display cart, not allowing changes and without pictures
			display_cart($_SESSION['cart'], false, 0);
			display_shipping(calculate_shipping_cost());

			//get credit card details
			display_card_form($name);
			display_button("process.php", "purchase", "Purchase");
			display_button("show_cart.php", "continue-shopping", "Continue Shopping");
			
		} else {

			echo "<p>Could not store data, please try again.</p>";
			display_button('checkout.php', 'back', 'Back');

		}

	} else {

	echo "<p>You did not fill in all the fields, please try again.</p><hr />";
	display_button('checkout.php', 'back', 'Back');

	}

	// footer
	do_html_footer();
 ?>