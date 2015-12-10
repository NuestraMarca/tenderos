/*
 *  Document   : AppShopkeeper.js
 *  Author     : andrestntx
 *  Description: Custom javascript code used in AppShopkeeper Page 
 *  use 	   : AppServices.js
 */

var AppShopkeeper = function() {

	var saveButtomId = '#save-btn';
	var classProductItems = '.newProduct';
	var token 	= $('#formProduct').data('token');
	var lat 	= $('#formProduct').data('lat');
	var lng 	= $('#formProduct').data('lng');

	var newModalProductionItem = function (productName, months) {
		var item =
			'<tr class="animation-fadeInQuick2">' + 
				'<td>' + 
					'<h4><strong>' + productName + '</strong></h4>';

		$.each(months, function( index, month ) {
			item += '<span class="label label-primary">' + month + '</span> ';  
		});

		item +=
				'</td>' + 
			'</tr>'; 

		return item;
	};

	var newProductItem = function (product, shoppingInterest) {
		return $(
			'<tr class="animation-fadeInQuick2" id="' + shoppingInterest.id + '">' +
	            '<td><a href="#" class="productEditable editable editable-click" data-value="' + product.id + ' data-pk="' + shoppingInterest.id + '">' + product.name + '</a></td>' +
	            '<td class="text-center"><a href="#" class="amountEditable editable editable-click" data-pk="' + shoppingInterest.id + '">' + shoppingInterest.amount + '</a></td>' +
	            '<td class="text-center"><a href="#" class="unitEditable editable editable-click" data-value="' + shoppingInterest.unit + '" data-pk="' + shoppingInterest.id + '">' + shoppingInterest.unit + '</a></td>' +
	        	'<td class="text-center text-danger"><a href="#" class="text-danger" title="Borrar" data-product-id="' + shoppingInterest.id + '" onclick="AppShopkeeper.postDeleteProduct(this)"><i class="gi gi-bin"></i></a></td>' +
	        '</tr>'
		);
	};

	var newProducerItem = function (producer) {
			item = 
				"<div class='col-sm-6 col-md-4'>" +
					"<a href='#modal-fade' data-producer='" + JSON.stringify(producer) + "' data-toggle='modal' class='widget'>" +
						"<div class='widget-content text-right clearfix'>" +
							"<img src='/images/placeholders/avatars/avatar9.jpg' alt='avatar' class='img-circle img-thumbnail img-thumbnail-avatar pull-left'>" +
							"<h3 class='widget-heading h4'><strong>" +  producer.name + "</strong></h3>" +
							"<span class='text-muted'><i class='gi gi-iphone_shake'></i> " +  producer.tel + "</span>" +
						"</div>" +
					"</a>" +
				"</div>" ;

			return item;
	};

	var newProducerItems = function (producers) {
		htmlProducers = '';

		if (typeof producers !== 'undefined' && ! $.isEmptyObject(producers)) {
		    $.each(producers, function( index, producer ) {
				htmlProducers += newProducerItem(producer);  
			});
		}
		else {
			htmlProducers = '<h3 class="text-center">No se encontraron Productores</h3>';
		}

		return htmlProducers;
	}

	var newModalProductionItems = function (producer) {
		htmlProductions = '';

		if (typeof producer.productions !== 'undefined' && ! $.isEmptyObject(producer.productions)) {
		    $.each(producer.productions, function( index, production ) {
				htmlProductions += newModalProductionItem(production.product.name, production.months_names_array);  
			});
		}
		else {
			htmlProductions = '<h3 class="text-center">No hay Producción</h3>';
		}


		return htmlProductions;
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

	var getSearchProducers = function (productId, subregion, months) {

		$.ajax({
	        url: 'services/producers',
	        data: {'_token': token, 'product_id': productId, 'subregion': subregion, 'months': months},
	        dataType:'json',
	        method:'GET',
	        success:function(data) {
	            if(data.success) {
	            	var htmlProducers = newProducerItems(data.producers);
	                $("#producers_found").html(htmlProducers);
	                $("#producers_found").toggle();
	                $("#producers_found").toggle( "slow" );

	                $("#producers_found_paginate").html('');
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
		
		$('.amountEditable').editable({
			url: 'products',
			name: 'amount',
			type: 'number',
			emptytext: 'Cantidad a la semana',
		    validate: function(v) {
		    	if(!v) return 'Debe escribir la cantidad';
		    	if(!$.isNumeric(v)) return 'La cantidad debe ser númerica';
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

		$('.productEditable').editable({
			url: 'products',
			type: 'select2',
			emptytext: 'Seleccione un Producto',
			name: 'product_id',
	        source: '/services/products',
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

	    $('.unitEditable').editable({
	    	url: 'products',
	    	type: 'select2',
	    	emptytext: 'Seleccione la Unidad de Medida',
	    	name: 'unit',
	        source: '/services/units',
	        select2: {
	            width: 200,
	            placeholder: 'Seleccionar Unidad',
	        },
	        validate: function(v) {
		    	if(!v) return 'Debe seleccionar una Unidad';
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
		       	url: 'products', 
		       	ajaxOptions: {
			    	type: 'POST',
			    	dataType: 'json'
				},
				data: {_token: token},
		       	success: function(data, config) {
		            if(data && data.product) {  //record created, response like {"id": 2}
		               $('#users').append(newProductItem(data.product, data.shoppingInterest));
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

	var initSearchProducers = function() {
		$("form").submit(function() {
			var productId 	= $("#product-search").val();
			var subregion 	= $("#subregion").val();
			var months 		= $("#months").val();

			getSearchProducers (productId, subregion, months);
			
			return false;
		});
	}

	var initSelectProducts = function () {
		$("#product-search").select2({
    		placeholder: "Seleccione el Producto de interés",
    		dataType: 'json',
    		ajax: {
			    url: "/services/shopping-interests",
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

	var initModal = function (){
		$('#modal-fade').on('shown.bs.modal', function (e) {
			producer = $(e.relatedTarget).data('producer');
			$("#modal-producer-name").html(producer.name);
			$("#modal-producer-email").html(producer.email);
			$("#modal-producer-tel").html(producer.tel);
			$("#modal-producer-address").html(producer.address);
			$("#modal-producer-municipality").html(producer.municipality.name);
			$("#modal-producer-productions").html(newModalProductionItems(producer));
    		initMap(producer.lat, producer.lng, producer.address);
		})
	};

	return {
		init: function () {
			initEditable();
			initSaveEvent();
			initSearchProducers();
			initSelectProducts();
			initModal();
		},
		postDeleteProduct: function (productElement) {
			var productId 	= $(productElement).data('product-id');
			var url 		= '/products/product/' +  productId;

			postDelete(productId, url);
		}
	}

}();




		   
		 
		