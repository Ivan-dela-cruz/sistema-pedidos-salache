@section('scripts')
<script type="text/javascript">

	$(document).ready(function(){
		 $('.money2').mask("##0.00", {reverse: true});
		 $('.stock').mask("##0", {reverse: true});
		 @if (isset($merchant))
    		document.getElementById("image_product").src = "{{ asset('img/image.png')}}";
    	@endif
		 
	});
	let contador = 1;
	let var_img_product = "#";
	let detail = [];

	function agregarRegistro() {
          
            var name = $('#name').val();
            var description = $('#description').val();
            var price = $('#price').val();
            var category = $('#category').val();
            var stock = $('#stock').val();
            var url_image = var_img_product;
            if( validateForm(name,description,price,category,stock,url_image)){
            	updateList(name);
            	var fila = '<tr class="product' + contador + '">' +
	            	'<td class="name">' + name + '</td>' +
	                '<td class="description">' + description + '</td>' +
	                '<td class="price">' + price + '</td>' +
	                '<td class="category">' + category + '</td>' +
	                '<td class="stock">' + stock + '</td>' +
	                '<td class="url_image">'+
	                '<img id="img_product" height="80" src="'+url_image+'">'+
	                '</td>' +
	                '<span class="table-remove">'+
	                '<td><button onclick="eliminar(' + contador + ')" type="button" class="btn btn-danger btn-rounded btn-sm my-0">'+
	                'Eliminar</button></span></td>';
	           
	            $('#table_request').append(fila);
	            let item = {
	            	id:contador,
	                name: name,
	                description: description,
	                price: price,
	                category: category,
	                stock:stock,
	                url_image:url_image
	            };
	            detail.push(item);
	            contador++;
	            console.log(detail);
	            Swal.fire(
                            'Agregado!',
                            'El producto ha sido agregado a la lista.',
                            'success'
                        );
	            clean();
            }
           
    }
    function clean(){
    	$('#name').val("");
        $('#description').val("");
        $('#price').val("");
        $('#category').val("");
        $('#stock').val("");
        var_img_product = "#";
        $('#image_product').attr('hidden',true);

    }

    function updateList(name){
    	for (let i = 0; i < detail.length ; i++){
	    	if(detail[i].name==name){
	    		$('.product' + detail[i].id).remove();
	    		detail.splice(i, 1);
	    	}
	    }
    }

    function validateForm(name,description,price,category,stock,url_image){
    	if(name == ""){
    		Swal.fire(
                    'Nombre vacío',
                    'El producto de contener un nombre.',
                    'warning'
                );
    		return false;
    	}
    	if(description == ""){
    		Swal.fire(
                    'Descripción vacía',
                    'El producto de contener una descripción corta.',
                    'warning'
                );
    		return false;
    	}
    	if(price == ""){
    		Swal.fire(
                    'Precio vacío',
                    'El producto de contener un precio.',
                    'warning'
                );
    		return false;
    	}
    	if(category == ""){
    		Swal.fire(
                    'Categoría vacía',
                    'El producto de contener una categoría.',
                    'warning'
                );
    		return false;
    	}
    	if(stock == ""){
    		Swal.fire(
                    'Cantidad vacía',
                    'El producto de contener una cantidad.',
                    'warning'
                );
    		return false;
    	}
    	if(url_image == "#"){
    		console.log("img");
    		Swal.fire(
                    'Imagen vacía!',
                    'El producto de contener un imagen.',
                    'warning'
                );
    		return false;
    	}
    	console.log("paso todo ");
    	return true;
    }

    $(document).on("click", ".btn-save", function(e) {
    	agregarRegistro();
    });


    $('.btn-send').click(function () {
           // $(this).attr('disabled', 'disabled');
            //$('.btnCancelarOrden').attr('disabled', 'disabled');
            //let materiales = [];
            //var fechaval = $('#fecha_orden').val();
            //var descripor = $('#orden_decrip').val();
            var topic = "";
            var topic = $('#topic').val();
            var id = @if (isset($merchant)){{$merchant->id}}@else 0 @endif;
            if(topic==""){
                Swal.fire(
                            'El motivo esta vacío!',
                            'Ingrese un motivo porfavor para continuar.',
                            'warning'
                        );
                return false;
            }
            if (detail.length == 0 ) {
            		Swal.fire(
                            'Lista vacía!',
                            'La solicitud debe contener 1 o mas productos.',
                            'warning'
                        );

            } else {
            	Swal.fire({
                title: '¿Está seguro de enviar tu solicitud? ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    
                		$.ajax({
                        url: "send-request-product",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            data: {
                                detail
                            },
                            id:id,
                            topic:topic,
                            _token: "{{csrf_token()}}",
                            //fecha_salida_re: $('#fecha_orden').val(),
                            //observacion_problema_or: $('#orden_decrip').val(),
                            //CONTIENEN LA COLECCION DE DATOS DEL DETALLE D ELA ORDEN DE TRABAJO

                            _method: "POST",
                            contador: detail.length,

                        },
                        success: function (data) {
                        	if(data.success){
                        		Swal.fire(
		                            'Enviado!',
		                            'La solicitud se ha enviado exitosamente.',
		                            'success'
                        		);
                        		 clean();
                        		 $("#table_request > tbody").empty();
                        		 detail = [];
                        		 contador = 1;

                        	}else{

                        		Swal.fire(
		                            'Error!',
		                            'Se produjo un error al enviar la solicitud.',
		                            'error'
                        		);
                        	}
                           
                        	
                        },
                        error:function(data){
                        	Swal.fire(
	                            'Error!',
	                            'Se produjo un error al enviar la solicitud.',
	                            'error'
                        	);
                        }
                    }) ;

                }
            });

            
            }

    });
    $('.btn-cancel').click(function () {
           
            	Swal.fire({
                title: '¿Está seguro de cancelar tu solicitud? ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    
                		window.location.href = "{{route('solicitud-productos')}}";
                   

                }
            });

            
         

    });

   

    function validarName(name) {
            let products = [];
            var validar = 0;
            document.querySelectorAll('#table_request tbody tr').forEach(function (e) {
                let fila = {
                    name: e.querySelector('.name').innerText,
                };
                products.push(fila);
            });


            for (var i = 0; i < products.length; i += 1) {
                if (products[i]['serie'] == serie) {
                    console.log('son iguales' + serie + ' :  ' + products[i]['serie']);
                    validar++;
                }
            }
            return validar;
        }



    function eliminar(index) {
    
	    $('.product' + index).remove();
	    for (let i = 0; i < detail.length ; i++){
	    	if(detail[i].id==index){
	    		detail.splice(i, 1);
	    	}
	    }
	    console.log(detail);
	   // alert(detail.length);
	   
	}



    function readFileProduct() {

            if (this.files && this.files[0]) {

                var FR = new FileReader();

                FR.addEventListener("load", function (e) {
                    var_img_product = e.target.result;
					$('#image_product').removeAttr('hidden');
                   // console.log('varibles  ' + var_img_product);
                    document.getElementById("image_product").src = e.target.result;

                    //document.getElementById("image_product").innerHTML = e.target.result;
                });

                FR.readAsDataURL(this.files[0]);

            }

    }
    @if (isset($merchant))
    	document.getElementById("customFile").addEventListener("change", readFileProduct);
    @endif
    




</script>
@endsection
