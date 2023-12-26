
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


  // Email validation
function isValidEmail(email) {
    // Regular expression for basic email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

	function isValidPhoneNumber(phoneNumber) {
	    // Regular expression for phone number validation
	    // It allows an optional leading '+' character and requires at least 11 characters in total
	    const phoneRegex = /^(?:\+\d{10,}|[^\+]\d{11,})$/;

	    // Check if the phone number matches the regular expression
	    return phoneRegex.test(phoneNumber);
	}




function addOrUpdateCustomerInfo(){
  var name = document.getElementById('customerName').value;
  var email = document.getElementById('email').value;
  var phoneNumber = document.getElementById('phoneNumber').value;
  var companyName = document.getElementById('companyName').value;
  var countries = document.getElementById('countries').value;
  var city = document.getElementById('city').value;
  var address = document.getElementById('address').value;

	if (!isValidEmail(email)) {
	  Swal.fire({
	    title: "Oops!",
	    text: "Please enter a valid email address",
	    icon: "error",
	    timer: 10000,
	    timerProgressBar: true,
	    showConfirmButton: true
	  });
	  // You can also prevent the form submission here if needed
	  return false;
	}

	if (!isValidPhoneNumber(phoneNumber)) {
	  Swal.fire({
	    title: "Oops!",
	    text: "Please enter a valid phone number",
	    icon: "error",
	    timer: 10000,
	    timerProgressBar: true,
	    showConfirmButton: true
	  });
	  // You can also prevent the form submission here if needed
	  return false;
	}

	if (email == "") {
	  Swal.fire({
	    title: "Oops!",
	    text: "Email is required",
	    icon: "error",
	    timer: 10000,
	    timerProgressBar: true,
	    showConfirmButton: true
	  });
	  return;
	}

	if (name == "") {
	  Swal.fire({
	    title: "Oops!",
	    text: "Name is required",
	    icon: "error",
	    timer: 10000,
	    timerProgressBar: true,
	    showConfirmButton: true
	  });
	  return;
	}

	if (phoneNumber == "") {
	  Swal.fire({
	    title: "Oops!",
	    text: "Phone Number is required",
	    icon: "error",
	    timer: 10000,
	    timerProgressBar: true,
	    showConfirmButton: true
	  });
	  return;
	}

	if (countries == "") {
	  Swal.fire({
	    title: "Oops!",
	    text: "Please Select Your Country",
	    icon: "error",
	    timer: 10000,
	    timerProgressBar: true,
	    showConfirmButton: true
	  });
	  return;
	}


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
				$('#load').load('website_pages/service.php');
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
				p_qty = document.getElementById('p_qty').value="";
				p_l = document.getElementById('p_l').value="";
				p_w = document.getElementById('p_w').value="";
				p_h = document.getElementById('p_h').value="";
				p_we = document.getElementById('p_we').value="";
        $('#show_packages').load('ajax_pages/show_packages_table_mobile.php');
      }
      else if (response == 700) {
				p_qty = document.getElementById('p_qty').value="";
				p_l = document.getElementById('p_l').value="";
				p_w = document.getElementById('p_w').value="";
				p_h = document.getElementById('p_h').value="";
				p_we = document.getElementById('p_we').value="";
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
				p_qty = document.getElementById('p_qty').value="";
				p_l = document.getElementById('p_l').value="";
				p_w = document.getElementById('p_w').value="";
				p_h = document.getElementById('p_h').value="";
				p_we = document.getElementById('p_we').value="";
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

function add_package_detailsDesk() {
		var unit = document.getElementById('u_conv').value;

		var com_type = document.getElementById('com_type').value;
		var pack_type = document.getElementById('p_type').value;
		var cargoType = document.getElementById('CargoType').value;

    var p_qty = document.getElementById('p_qty').value;
    var p_l = parseFloat(document.getElementById('p_l').value);
    var p_w = parseFloat(document.getElementById('p_w').value);
    var p_h = parseFloat(document.getElementById('p_h').value);
    var p_we = document.getElementById('p_we').value;
		var unit_kl = document.getElementById('u_conv_kl').value;

		if (p_l=="" || p_w=="" || p_h == "" || p_we =="" ) {
			showError('Please enter valid dimensions for length, width,height and weight.');
			return;
		}

			if (cargoType == "") {
				showError('Please Select Cargo Type');
				return;
			}

			if (p_qty == "") {
				showError('Please Enter Quantity');
				return;
			}

			if (com_type == "") {
				showError('Please Enter The Commodity');
				return;
			}

		if(unit_kl == "lbs"){
			 p_we *= 0.453592;
		}

		// Perform unit conversion if needed
		if (unit === 'inch') {
				// Convert inches to centimeters (1 inch = 2.54 cm)
				p_l *= 2.54;
				p_w *= 2.54;
				p_h *= 2.54;
		} else if (unit === 'MM') {
				// Convert millimeters to centimeters (1 mm = 0.1 cm)
				p_l *= 0.1;
				p_w *= 0.1;
				p_h *= 0.1;
		}
		else if (unit === 'M') {
            // Convert meters to centimeters (1 m = 100 cm)
            p_l *= 100;
            p_w *= 100;
            p_h *= 100;
  }

    $.ajax({
        url: 'backend/add_packages.php',
        method: 'POST',
        data: {
            qty: p_qty,
            leng: p_l,
            width: p_w,
            height: p_h,
            weight: p_we,
						commo_type:com_type,
						pack_type:pack_type,
						cargo_type:cargoType
        },
        success: function (response) {
            console.log(response);
            if (response == 200) {
                $('#show_packages').load('ajax_pages/show_packages_table.php');
                // Clear input fields
                document.getElementById('p_qty').value = "";
                document.getElementById('p_l').value = "";
                document.getElementById('p_w').value = "";
                document.getElementById('p_h').value = "";
                document.getElementById('p_we').value = "";
            } else if (response == 700) {
                Swal.fire({
                    title: "Oops!",
                    text: "You Need To Add The Customer First",
                    icon: "error",
                    timer: 10000,
                    timerProgressBar: true,
                    showConfirmButton: true
                });
                // Clear input fields
                document.getElementById('p_qty').value = "";
                document.getElementById('p_l').value = "";
                document.getElementById('p_w').value = "";
                document.getElementById('p_h').value = "";
                document.getElementById('p_we').value = "";
            } else {
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
function showError(message) {
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: message,
  });
}
	function add_package_detailsDeskLand(){
		var unit = document.getElementById('u_conv').value;
    var p_qty = document.getElementById('p_qty').value;

		var com_type = document.getElementById('com_type').value;
		var pack_type = document.getElementById('p_type').value;
		var cargoType = document.getElementById('CargoType').value;

    var p_l = parseFloat(document.getElementById('p_l').value);
    var p_w = parseFloat(document.getElementById('p_w').value);
    var p_h = parseFloat(document.getElementById('p_h').value);
    var p_we = document.getElementById('p_we').value;

		var unit_kl = document.getElementById('u_conv_kl').value;

			if (p_l=="" || p_w=="" || p_h == "" || p_we =="" ) {
				showError('Please enter valid dimensions for length, width,height and weight.');
				return;
			}

				if (cargoType == "") {
					showError('Please Select Cargo Type');
					return;
				}

				if (p_qty == "") {
					showError('Please Enter Quantity');
					return;
				}

				if (com_type == "") {
					showError('Please Enter The Commodity');
					return;
				}

		if(unit_kl == "lbs"){
			 p_we *= 0.453592;
		}
				// Perform unit conversion if needed
		if (unit === 'inch') {
				// Convert inches to centimeters (1 inch = 2.54 cm)
				p_l *= 2.54;
				p_w *= 2.54;
				p_h *= 2.54;
		} else if (unit === 'MM') {
				// Convert millimeters to centimeters (1 mm = 0.1 cm)
				p_l *= 0.1;
				p_w *= 0.1;
				p_h *= 0.1;
		}
		else if (unit === 'M') {
            // Convert meters to centimeters (1 m = 100 cm)
            p_l *= 100;
            p_w *= 100;
            p_h *= 100;
  }

		$.ajax({
			url:'backend/add_packages.php',
			method:'POST',
			data:{
				qty: p_qty,
				leng: p_l,
				width: p_w,
				height: p_h,
				weight: p_we,
				commo_type:com_type,
				pack_type:pack_type,
				cargo_type:cargoType
			},
			success:function(response){
				console.log(response);
				if(response == 200){
					if(!document.getElementById('clear_data_pack_land').checked){
						p_qty = document.getElementById('p_qty').value="";
						p_l = document.getElementById('p_l').value="";
						p_w = document.getElementById('p_w').value="";
						p_h = document.getElementById('p_h').value="";
						p_we = document.getElementById('p_we').value="";
					}
					$('#show_packages_land').load('ajax_pages/show_packages_table_land.php');
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
	function add_package_detailsDeskSea(){
		var unit = document.getElementById('u_conv').value;
    var p_qty = document.getElementById('p_qty').value;

		var com_type = document.getElementById('com_type').value;
		var pack_type = document.getElementById('p_type').value;
		var cargoType = document.getElementById('CargoType').value;

    var p_l = parseFloat(document.getElementById('p_l').value);
    var p_w = parseFloat(document.getElementById('p_w').value);
    var p_h = parseFloat(document.getElementById('p_h').value);
    var p_we = document.getElementById('p_we').value;

		var unit_kl = document.getElementById('u_conv_kl').value;

		if (p_l=="" || p_w=="" || p_h == "" || p_we =="" ) {
			showError('Please enter valid dimensions for length, width,height and weight.');
			return;
		}

			if (cargoType == "") {
				showError('Please Select Cargo Type');
				return;
			}

			if (p_qty == "") {
				showError('Please Enter Quantity');
				return;
			}

			if (com_type == "") {
				showError('Please Enter The Commodity');
				return;
			}

		if (p_l=="" || p_w=="" || p_h == "" || p_we =="" ) {
			showError('Please enter valid dimensions for length, width,height and weight.');
			return;
		}

			if (cargoType == "") {
				showError('Please Select Cargo Type');
				return;
			}

			if (p_qty == "") {
				showError('Please Enter Quantity');
				return;
			}

			if (com_type == "") {
				showError('Please Enter The Commodity');
				return;
			}

		if(unit_kl == "lbs"){
			 p_we *= 0.453592;
		}
				// Perform unit conversion if needed
		if (unit === 'inch') {
				// Convert inches to centimeters (1 inch = 2.54 cm)
				p_l *= 2.54;
				p_w *= 2.54;
				p_h *= 2.54;
		} else if (unit === 'MM') {
				// Convert millimeters to centimeters (1 mm = 0.1 cm)
				p_l *= 0.1;
				p_w *= 0.1;
				p_h *= 0.1;
		}
		else if (unit === 'M') {
            // Convert meters to centimeters (1 m = 100 cm)
            p_l *= 100;
            p_w *= 100;
            p_h *= 100;
  }

	    $.ajax({
	      url:'backend/add_packages.php',
	      method:'POST',
	      data:{
	        qty:p_qty,
	        leng:p_l,
	        width:p_w,
	        height:p_h,
	        weight:p_we,
					commo_type:com_type,
					pack_type:pack_type,
					cargo_type:cargoType
	      },
	      success:function(response){
	        console.log(response);
	        if(response == 200){
						if(!document.getElementById('clear_data_pack_sea').checked){
							p_qty = document.getElementById('p_qty').value="";
							p_l = document.getElementById('p_l').value="";
							p_w = document.getElementById('p_w').value="";
							p_h = document.getElementById('p_h').value="";
							p_we = document.getElementById('p_we').value="";
						}
	          $('#show_packages_sea').load('ajax_pages/show_packages_table_sea.php');
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

function del_p_desktop(p_id){
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

function del_p_desktopLand(p_id){
	$.ajax({
    url:'backend/del_package.php',
    method:'POST',
    data:{
      pack_id:p_id
    },
    success:function(response){
      console.log(response);
      if(response == 200){
        $('#show_packages_land').load('ajax_pages/show_packages_table_land.php');
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
function del_p_desktopSea(p_id){
	$.ajax({
    url:'backend/del_package.php',
    method:'POST',
    data:{
      pack_id:p_id
    },
    success:function(response){
      console.log(response);
      if(response == 200){
        $('#show_packages_sea').load('ajax_pages/show_packages_table_sea.php');
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
        $('#show_packages').load('ajax_pages/show_packages_table_mobile.php');
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
function alertWarehouse(){
  Swal.fire({
  title: "Request Sent",
  text: "One Of Our Agent Will Contact You Shortly",
  icon: "success",
  timer: 10000,
  timerProgressBar: true,
  showConfirmButton: true
  });
}

function shippingSubmit(id,b_id){
	$.ajax({
		url:'backend/check_package.php',
		method:'POST',
		success:function(response){
			if(response == 200){
				$('#load').load('website_pages/shipping.php',{ show_id:id,back_id:b_id });
			}
            else if(response == 1001){
                $('#load').load('website_pages/brokerage.php',{ show_id:id,back_id:b_id });
            }
			else {
				Swal.fire({
				title: "Oops!",
				text: "You Must Enter At Least 01 package",
				icon: "error",
				timer: 10000,
				timerProgressBar: true,
				showConfirmButton: true
				});
			}
		}
	});

}

function selectService(sid){

	if(sid == 1){
		brok_st.value =0;
	    $('#load').load('website_pages/shipping_service.php');
  }
	else if(sid == 3){
		$('#load').load('website_pages/shipping_service.php',{bst:1});
	}
  else if (sid == 2) {
    $('#load').load('website_pages/warehouse.php');
  }
}

function selectShipping(shipId) {
    if(shipId == 1){
        $('#load').load('website_pages/air_packages.php');
    }
    else if (shipId == 2) {
        $('#load').load('website_pages/sea_packages.php');
    }
    else if (shipId == 3) {
        $('#load').load('website_pages/land_packages.php');
    }
}

function goBack(id){
	if(id == 1){
		$('#load').load('website_pages/customer.php');
	}
	else if (id == 2) {
		$('#load').load('website_pages/service.php');
	}
	else if (id == 3) {
		$('#load').load('website_pages/shipping_service.php');
	}
	else if (id == 4) {
		$('#load').load('website_pages/air_packages.php');
	}
	else if (id == 5) {
		$('#load').load('website_pages/sea_packages.php');
	}
	else if (id == 6) {
		$('#load').load('website_pages/land_packages.php');
	}
}

function dontAllowMinus(inputElement){
	let value = parseInt(inputElement.value, 10);

	if (isNaN(value) || value < 1) {
		inputElement.value = '';
	}
}
function selectAir(val){
    if(val == 1){
      document.getElementById('desti_air').style.display = "block";
      document.getElementById('orgin_air').style.display = "none";
    }
    else if(val == 2){
      document.getElementById('desti_air').style.display = "none";
      document.getElementById('orgin_air').style.display = "block";
    }
		else {
			document.getElementById('desti_air').style.display = "none";
			document.getElementById('orgin_air').style.display = "none";
		}
  }

	function selectSea(val){
	    if(val == 1){
	      document.getElementById('desti_sea').style.display = "block";
	      document.getElementById('orgin_sea').style.display = "none";
	    }
	    else if(val == 2){
	      document.getElementById('desti_sea').style.display = "none";
	      document.getElementById('orgin_sea').style.display = "block";
	    }
			else {
				document.getElementById('desti_sea').style.display = "none";
				document.getElementById('orgin_sea').style.display = "none";
			}
	  }

		function selectLand(val){
				if(val == 1){
					document.getElementById('desti_land').style.display = "block";
					document.getElementById('orgin_land').style.display = "none";
				}
				else if(val == 2){
					document.getElementById('desti_land').style.display = "none";
					document.getElementById('orgin_land').style.display = "block";
				}
				else {
					document.getElementById('desti_land').style.display = "none";
					document.getElementById('orgin_land').style.display = "none";
				}
			}
