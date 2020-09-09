@section('scripts')

    <script src="js/jquery.passwordRequirements.js"></script>
    <script>
        /* trigger when page is ready */
        $(document).ready(function (){
            $(".pr-password").passwordRequirements({

            });
        });
    </script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
<script type="text/javascript">

$(document).ready(function(){

});



function getUsers(){
    let search = window.location.search;
    let page = search.split("=");
    let url = "users?page="+page[1];

    axios.get(url).then(function (response) {
        $('.table-users').empty();
                   $('.table-users').html(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
}

 $(document).on("click", ".btn_save", function (e) {
  let pass1 = $('#id_password').val();
  let pass2 = $('#id_password2').val();

  if(pass1.length >=8){
    if(pass1==pass2){
      $("#formenvio_1").submit();
    }else{
        $('#div_pass').removeAttr('hidden');
    }
    
  }
});

$(document).on("click", ".btn-delete-user", function(e) {
    event.preventDefault();
        let text = $(this).data('original-title');
        let id = $(this).data('id-user');
        let url = "{{route('deactivate-user')}}";
           Swal.fire({
               title: '¿Está seguro para '+text+'? ',
               text: "Tu podrás revertir está acción",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Aceptar',
               cancelButtonText:'Cancelar'
               }).then((result) => {
               if (result.value) {
                axios.put(url,{
                    'id': id
                }).then(function (response) {
                   getUsers();
                    Swal.fire(
                   'Desactivado!',
                   'El tarea se ha cumplido exitosamente.',
                   'success'
                   );
                }).catch(function (error) {
                    console.log(error);
                });


               }
           });
});


    </script>
@endsection
