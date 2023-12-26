
	function activeAir(){
		document.getElementById('airfrieght_form').style.display = "block";
		document.getElementById('seafreight_form').style.display = "none";
		document.getElementById('landfrieght_form').style.display = "none";
	}

	function activeSea(){
		document.getElementById('seafreight_form').style.display = "block";
		document.getElementById('airfrieght_form').style.display = "none";
		document.getElementById('landfrieght_form').style.display = "none";

	}
	function activeLand(){
		document.getElementById('landfrieght_form').style.display = "block";
		document.getElementById('seafreight_form').style.display = "none";
		document.getElementById('airfrieght_form').style.display = "none";
	}

	function activeBrokerage(){
				document.getElementById('brokerage_id').value=1;
	}

						function addOrUpdateCustomerInfo(){
							var name = document.getElementById('customerName').value;
							var email = document.getElementById('email').value;
							var phoneNumber = document.getElementById('phoneNumber').value;
							var companyName = document.getElementById('companyName').value;
							var countries = document.getElementById('countries').value;
							var city = document.getElementById('city').value;
							var address = document.getElementById('address').value;

							$.ajax({
								url:'backend/add_customer.php',
								method:'POST',
								data:{
									u_name:name,
									u_email:email,
									u_phoneNumber:phoneNumber,
									u_companyName:companyName,
									u_countries:countries,
									u_city:city,
									u_address:address,
								},
								success:function(response){
									if(response == 200){
										$('#customer_info').modal('hide');
										var customerName = document.getElementById('customerName').value;
										document.getElementById('customer_details').innerHTML = customerName;
									}
									else {
										Swal.fire({
										title: "Oops!",
										text: "Something Went Wrong",
										icon: "error",
										timer: 10000,
										timerProgressBar: true,
										showConfirmButton: true
										});
									}
								}
							});

						}


						function del_p(p_id){
							$.ajax({
								url:'backend/del_package.php',
								method:'POST',
								data:{
									pack_id:p_id
								},
								success:function(response){
									console.log(response);
									if(response == 200){
										$('#show_packages').load('ajax_pages/show_packages_table.php');
									}
									else {
										Swal.fire({
										title: "Oops!",
										text: "Something Went Wrong",
										icon: "error",
										timer: 10000,
										timerProgressBar: true,
										showConfirmButton: true
										});
									}
								}
							});
						}

						function add_package_details(){
							var p_qty = document.getElementById('p_qty').value;
							var p_l = document.getElementById('p_l').value;
							var p_w = document.getElementById('p_w').value;
							var p_h = document.getElementById('p_h').value;
							var p_we = document.getElementById('p_we').value;

							$.ajax({
								url:'backend/add_packages.php',
								method:'POST',
								data:{
									qty:p_qty,
									leng:p_l,
									width:p_w,
									height:p_h,
									weight:p_we
								},
								success:function(response){
									console.log(response);
									if(response == 200){
										$('#show_packages').load('ajax_pages/show_packages_table.php');
									}
									else if (response == 700) {
										Swal.fire({
										title: "Oops!",
										text: "You Need To Add The Customer First",
										icon: "error",
										timer: 10000,
										timerProgressBar: true,
										showConfirmButton: true
										});
									}
									else {
										Swal.fire({
										title: "Oops!",
										text: "Something Went Wrong",
										icon: "error",
										timer: 10000,
										timerProgressBar: true,
										showConfirmButton: true
										});
									}
								}
							});

						}

						function selectCity(cId){
							$('#city').load('ajax_pages/show_cities.php',{ c_id:cId });
						}

						function selectCityOrginAir(cId){
							$('#city_orgin_air').load('ajax_pages/show_cities.php',{ c_id:cId });
						}

						function selectCityDestiAir(cId){
							$('#city_desti_air').load('ajax_pages/show_cities.php',{ c_id:cId });
						}


						function selectAirportOrgin(aId){
							$('#airport_orgin').load('ajax_pages/show_airport.php',{ ap_id:aId });
						}

						function selectAirportDestination(aId){
							$('#airport_desti').load('ajax_pages/show_airport.php',{ ap_id:aId });
						}
						// start of sea
						function selectCityOrginSea(cId){
							$('#city_orgin_sea').load('ajax_pages/show_cities.php',{ c_id:cId });
						}

						function selectCityDestiSea(cId){
							$('#city_desti_sea').load('ajax_pages/show_cities.php',{ c_id:cId });
						}

						function selectSeaPortOrgin(cId){
								$('#seaport_sea_orgin').load('ajax_pages/show_seaport.php',{ id:cId });
						}

						function selectSeaPortDesti(cId){
								$('#seaport_sea_desti').load('ajax_pages/show_seaport.php',{ id:cId });
						}
						//end of sea
						// start of land
						function selectCityOrginLand(cId){
							$('#city_orgin_land').load('ajax_pages/show_cities.php',{ c_id:cId });
						}

						function selectCityDestiLand(cId){
							$('#city_desti_land').load('ajax_pages/show_cities.php',{ c_id:cId });
						}

						function selectBorderOrgin(cId){
								$('#border_orgin').load('ajax_pages/show_border.php',{ id:cId });
						}

						function selectBorderDesti(cId){
								$('#border_desti').load('ajax_pages/show_border.php',{ id:cId });
						}


				function activeShipping(){
					document.getElementById('shipping_page').style.display = "block";
					document.getElementById('warehouse_price').style.display = "none";
				}

				function activeWarehousing(){
					document.getElementById('warehouse_price').style.display = "block";
					document.getElementById('shipping_page').style.display = "none";
				}


				function openCustomerModal(){
					$('#customer_info').modal('show');
				}
				function openPackageAdd(){
					$('#add_packages').modal('show');
				}


		function toggleClass(element) {
				    // Remove the "shipping-main-option-active" class from all elements with class "shipping-main-option"
				    const shippingOptions = document.querySelectorAll('.shipping-main-option');
				    shippingOptions.forEach(option => {
				        option.classList.remove('shipping-main-option-active');
				    });

				    // Add the "shipping-main-option-active" class to the clicked element
				    element.classList.add('shipping-main-option-active');
			}

		function updateClock() {
				            const now = new Date();
				            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
				            const formattedDate = now.toLocaleDateString('en-US', options);

				            document.getElementById('clock').textContent = formattedDate;
	}

	 // Update the clock every second
	setInterval(updateClock, 1000);

	// Initial update
	updateClock();



				function activateOption(clickedElement) {
				    var optionBoxes = document.querySelectorAll('.main-option-box');

				    // Remove the active class from all option boxes
				    optionBoxes.forEach(function (box) {
				        box.classList.remove('main-option-box-active');
				    });

				    // Add the active class only to the clicked element
				    clickedElement.classList.add('main-option-box-active');
				}
