/*
 *  Document   : AppProducer.js
 *  Author     : andrestntx
 *  Description: Custom javascript code used in AppProducer Page 
 *  use 	   : AppServices.js
 */

var AppProducer = function() {

	var saveButtomId = '#save-btn';
	var classProductItems = '.newProduct';
	var token 	= $('#formProduct').data('token');
	var lat 	= $('#formProduct').data('lat');
	var lng 	= $('#formProduct').data('lng');

	var newModalShoppingInterestItem = function (productName, amount, unit) {
		var item =
			'<tr class="animation-fadeInQuick2">' + 
				'<td>' + 
					'<h4><strong>' + productName + '</strong></h4>' +
				'</td>' + 
				'<td>' +
					'<span class="label label-primary">' + amount + ' ' + unit + '</span> ' +
				'</td>' +
			'</tr>'; 

		return item;
	};

	var newProductItem = function (production) {
		return $(
			'<tr class="animation-fadeInQuick2" id="' + product.id + '">' +
	            '<td><a href="#" class="productEditable editable editable-click" data-value="' + production.id + ' data-pk="' + production.id + '">' + production.product.name + '</a></td>' +
	            '<td class="text-center"><a href="#" class="unitEditable editable editable-click" data-value="' + production.months + '" data-pk="' + production.id + '">' + production.months + '</a></td>' +
	        	'<td class="text-center text-danger"><a href="#" class="text-danger" title="Borrar" data-product-id="' + production.id + '" onclick="AppProducer.postDeleteProduct(this)"><i class="gi gi-bin"></i></a></td>' +
	        '</tr>'
		);
	};

	var newShopkeeperItem = function (shopkeeper) {
			item = 
				"<div class='col-sm-6 col-md-4'>" +
					"<a href='#modal-fade' data-shopkeeper='" + JSON.stringify(shopkeeper) + "' data-toggle='modal' class='widget'>" +
						"<div class='widget-content text-right clearfix'>" +
							"<img src='/images/placeholders/avatars/avatar9.jpg' alt='avatar' class='img-circle img-thumbnail img-thumbnail-avatar pull-left'>" +
							"<h3 class='widget-heading h4'><strong>" +  shopkeeper.name + "</strong></h3>" +
							"<span class='text-muted'><i class='gi gi-iphone_shake'></i> " +  shopkeeper.tel + "</span>" +
						"</div>" +
					"</a>" +
				"</div>" ;

			return item;
	};

	var newShopkeeperItems = function (shopkeepers) {
		
		htmlShopkeepers = '';

		if (typeof shopkeepers !== 'undefined' && ! $.isEmptyObject(shopkeepers)) {
		    $.each(shopkeepers, function( index, shopkeeper ) {
				htmlShopkeepers += newShopkeeperItem(shopkeeper);  
			});
		}
		else {
			htmlShopkeepers = '<h3 class="text-center">No se encontraron Tenderos</h3>';
		}

		return htmlShopkeepers;
	}

	var newModalShoppingInterestItems = function (shopkeeper) {

		console.log(shopkeeper);
		console.log(shopkeeper.shopping_interests);
		
		htmlShoppingInterests = '';

		if (typeof shopkeeper.shopping_interests !== 'undefined' && ! $.isEmptyObject(shopkeeper.shopping_interests)) {
		    $.each(shopkeeper.shopping_interests, function( index, product ) {
				htmlShoppingInterests += newModalShoppingInterestItem(product.name, product.pivot.amount, product.pivot.unit);  
			});
		}
		else {
			htmlShoppingInterests = '<h3 class="text-center">No hay Compras</h3>';
		}


		return htmlShoppingInterests;
	}

	var deleteProduct = function (questionId) {
		$("#" + questionId).fadeOut(400, function() {
	        $("#" + questionId).remove();
	    });
	};

	var postDelete = function (productId, url) {

		$.ajax({
	        url: url,
	        data: {'_token': token},
	        dataType:'json',
	        method:'DELETE',
	        success:function(data) {
	            if(data['success']) {
	                deleteProduct(productId);
	                AppServices.notification('info', data['message']);
	            }
	            else{
	            	AppServices.notification('danger', data['message']);
	            }
	        },
	        error:function(){
	            alert('fallo la conexion');
	        }
	    });
	};

	var getSearchShopkeepers = function (productId, communes) {

		$.ajax({
	        url: '/admin/services/shopkeepers',
	        data: {'_token': token, 'product_id': productId, 'communes': communes},
	        dataType:'json',
	        method:'GET',
	        success:function(data) {
	            if(data.success) {
	            	
	            	var htmlShopkeepers = newShopkeeperItems(data.shopkeepers);
	                $("#shopkeepers_found").html(htmlShopkeepers);
	                $("#shopkeepers_found").toggle();
	                $("#shopkeepers_found").toggle( "slow" );

	                $("#shopkeepers_found_paginate").html('');
		        }  
	            else{
	            	AppServices.notification('danger', data['message']);
	            }
	        },
	        error:function(){
	            alert('fallo la conexion');
	        }
	    });
	};

	var clearEditable = function () {
		$(classProductItems).editable('setValue', null)  		//clear values
        					.editable('option', 'pk', null) 	//clear pk
	};

	var initEditable = function () {

		$('.productEditable').editable({
			url: '/admin/productions',
			type: 'select2',
			emptytext: 'Seleccione un Producto',
			name: 'product_id',
	        source: '/admin/services/products',
	        select2: {
	            width: 300,
	            placeholder: 'Seleccionar Producto',
	        },
	        validate: function(v) {
		    	if(!v) return 'Debe serleccionar un Producto';
			},
			ajaxOptions: {
			    type: 'PUT',
			    dataType: 'json'
			},
			params: {_token: token},
		    success: function(data) {

		        /* actions on success */
		    },
		    error: function(data) {
		        /* actions on validation error (or ajax error) */
		        var msg = '';
		        if(data.errors) {              //validation error
		            $.each(data.errors, function(k, v) { msg += k+": "+v+"<br>"; });  
		        } else if(data.responseText) {   //ajax error
		            msg = data.responseText; 
		        }

		        AppServices.notification('danger', msg);
		    }
	    });  

	    $('.monthsEditable').editable({
	    	url: '/admin/productions',
	    	type: 'select2',
	    	emptytext: 'Seleccione los Meses del Año',
	    	name: 'months',
	        source: [{"id":1,"text":"Enero"},{"id":2,"text":"Febrero"},{"id":3,"text":"Marzo"},{"id":4,"text":"Abril"},{"id":5,"text":"Mayo"},{"id":6,"text":"Junio"},{"id":7,"text":"Julio"},{"id":8,"text":"Agosto"},{"id":9,"text":"Septiembre"},{"id":10,"text":"Octubre"},{"id":11,"text":"Noviembre"},{"id":12,"text":"Diciembre"}],
	        select2: {
	            width: 200,
	            placeholder: 'Seleccionar Meses',
	            multiple: 'multiple'
	        },
	        validate: function(v) {
		    	if(!v) return 'Debe seleccionar los Meses de Producción';
			},
			ajaxOptions: {
			    type: 'PUT',
			    dataType: 'json'
			},
			params: {_token: token},
		    success: function(data) {
		        /* actions on success */
		    },
		    error: function(data) {
		        /* actions on validation error (or ajax error) */
		        var msg = '';
		        if(data.errors) {              //validation error
		            $.each(data.errors, function(k, v) { msg += k+": "+v+"<br>"; });  
		        } else if(data.responseText) {   //ajax error
		            msg = data.responseText; 
		        }

		        
		    }

	    });
	};

	var initSaveEvent = function () {
		
		$(saveButtomId).click(function() {
		    $(classProductItems).editable('submit', { 
		       	url: '/admin/productions', 
		       	ajaxOptions: {
			    	type: 'POST',
			    	dataType: 'json'
				},
				data: {_token: token},
		       	success: function(data, config) {
		            if(data && data.production) {  //record created, response like {"id": 2}
		               console.log(data.production);
		               $('#users').append(newProductItem(data.production));
		               initEditable();
		               clearEditable();

		               AppServices.notification('info', data.msg);

		           } else if(data && data.errors){ 
		               //server-side validation error, response like {"errors": {"username": "username already exist"} }
		               config.error.call(this, data.errors);
		           }               
		       	},
		       	error: function(errors) {
		           var msg = '<ul/>';
		           if(errors && (errors.responseText || errors.status)) { //ajax error, errors = xhr object
		               alert('falló la conexión');
		           } else { //validation error (client-side or server-side)
		               $.each(errors, function(k, v) { msg += "<li>" + v + "</li>"; });
		               AppServices.notification('danger', msg);
		           } 
		       }
		   });
		});
	};

	var initSearchShopkeepers = function() {
		$("form").submit(function() {
			var productId 			= $("#product-search").val();
			var communes 			= $("#communes").val();

			getSearchShopkeepers (productId, communes);
			
			return false;
		});
	};

	var initMap = function (lat, lng, title) {
		new GMaps({
            div: '#gmap-markers',
            lat: lat,
            lng: lng,
            zoom: 11,
            scrollwheel: false
        }).addMarkers([
            {lat: lat, lng: lng, title: title, animation: google.maps.Animation.DROP, infoWindow: {content: '<strong>' + title + '</strong>'}},
		]);
	};


	var initSelectProducts = function () {
		$("#product-search").select2({
    		placeholder: "Seleccione el Producto de interés",
    		dataType: 'json',
    		ajax: {
			    url: "/admin/services/production-products",
			    results: function (data) {
		            var myResults = [];
		            $.each(data, function (index, item) {
		                myResults.push({
		                    'id': item.id,
		                    'text': item.text
		                });
		            });
		            return {
		                results: myResults
		            };
        		}
			}
    	});
	};

	var initModal = function (){
		$('#modal-fade').on('shown.bs.modal', function (e) {
			shopkeeper = $(e.relatedTarget).data('shopkeeper');
			console.log('initModal');
			console.log(shopkeeper);
			$("#modal-shopkeeper-name").html(shopkeeper.name);
			$("#modal-shopkeeper-email").html(shopkeeper.email);
			$("#modal-shopkeeper-tel").html(shopkeeper.tel);
			$("#modal-shopkeeper-address").html(shopkeeper.address);
			$("#modal-shopkeeper-commune").html(shopkeeper.commune);
			$("#modal-shopkeeper-municipality").html(shopkeeper.municipality.name);
			$("#modal-shopkeeper-shoppingInterests").html(newModalShoppingInterestItems(shopkeeper));
    		initMap(shopkeeper.lat, shopkeeper.lng, shopkeeper.address);
    		var edit = "/admin/tenderos/" + shopkeeper.id + "/edit";
    		$("#modal-shopkeeper-id").attr('href', edit);
    		var shopping = "/admin/tenderos/" + shopkeeper.id + "/shopping";
    		$("#modal-shopkeeper-shopping").attr('href', shopping);
		})
	};

	return {
		init: function () {
			initEditable();
			initSaveEvent();
			initSearchShopkeepers();
			initSelectProducts();
			initModal();
		},
		postDeleteProduct: function (productElement) {
			var productionId 	= $(productElement).data('production-id');
			var url 		= '/admin/productions/product/' +  productionId;

			postDelete(productionId, url);
		}
	}

}();
