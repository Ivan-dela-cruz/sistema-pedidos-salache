@section('scripts')
<script type="text/javascript">

	$(document).ready(function(){
		
	});
	let contador = 1;
	let var_img_product = "#";
	let detail = [];

	function agregarRegistro() {
          
            var name = $('#name').val();
            var description = $('#description').val();
            var price = $('#price').val();
            var category = $('#category').val();
            var url_image = var_img_product;

            var fila = '<tr class="product' + contador + '">' +
            	'<td class="name">' + name + '</td>' +
                '<td class="description">' + description + '</td>' +
                '<td class="price">' + price + '</td>' +
                '<td class="category">' + category + '</td>' +
                '<td class="url_image">'+
                '<img id="img_product" height="80" src="'+url_image+'">'+
                '</td>' +
                '<span class="table-remove">'+
                '<td><button onclick="eliminar(' + contador + ')" type="button" class="btn btn-danger btn-rounded btn-sm my-0">'+
                'Eliminar</button></span></td>';
            contador++;
            $('#table_request').append(fila);
            let fila = {
            	id:contador,
                name: name,
                description: description,
                price: price,
                category: category,
                url_image:url_image
            };
            detail.push(fila);
    }

    $(document).on("click", ".btn-save", function(e) {
    	agregarRegistro();
    });


    $('.btnGenerarOrden').click(function () {
            $(this).attr('disabled', 'disabled');
            //$('.btnCancelarOrden').attr('disabled', 'disabled');
            let materiales = [];
            var fechaval = $('#fecha_orden').val();
            var descripor = $('#orden_decrip').val();
            if (contador == 0 && fechaval == '' && descripor == '') {


            } else {
                if (descripor == '') {
                    $('#orden_decrip').addClass("border-danger");
                } else {

                    $('#orden_decrip').removeClass("border-danger");
                    document.querySelectorAll('#table_request tbody tr').forEach(function (e) {
                        let fila = {
                            name: e.querySelector('.serie').innerText,
                            description: e.querySelector('.marca').innerText,
                            price: e.querySelector('.modelo').innerText,
                            price: e.querySelector('.problema').innerText,
                            accesorios: e.querySelector('.accesorio').innerText,
                            fecha_salida: e.querySelector('.fecha_salida').innerText,
                            descripcion: e.querySelector('.descripccion').innerText,
                            tipo: e.querySelector('.tipo').innerText,
                        };
                        materiales.push(fila);
                    });
                    console.log(materiales);
                    $.ajax({
                        url: "generarOrden",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            data: {
                                materiales
                            },
                            id_p: $('#ordencliente').val(),
                            _token: "{{csrf_token()}}",
                            fecha_salida_re: $('#fecha_orden').val(),
                            observacion_problema_or: $('#orden_decrip').val(),
                            //CONTIENEN LA COLECCION DE DATOS DEL DETALLE D ELA ORDEN DE TRABAJO

                            _method: "POST",
                            contador: contador,
                        },
                        success: function (data) {
                            $('.btnGenerarOrden').attr('disabled', 'disabled');
                            $('.btnCancelarOrden').attr('disabled', 'disabled');
                            $('#orden_decrip').removeClass("border-danger");
                            location.href = 'listar-ordenes';
                        }
                    })
                    ;

                }


            }

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
	    	
	    }
	   
	}



    function readFileProduct() {

            if (this.files && this.files[0]) {

                var FR = new FileReader();

                FR.addEventListener("load", function (e) {
                    var_img_product = e.target.result;
					$('#image_product').removeAttr('hidden');
                    console.log('varibles  ' + var_img_product);
                    document.getElementById("image_product").src = e.target.result;

                    //document.getElementById("image_product").innerHTML = e.target.result;
                });

                FR.readAsDataURL(this.files[0]);

            }

    }
    document.getElementById("customFile").addEventListener("change", readFileProduct);




</script>
@endsection
