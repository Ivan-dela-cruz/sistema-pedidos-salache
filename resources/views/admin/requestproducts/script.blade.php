@section('scripts')
<script type="text/javascript">

	$(document).ready(function(){
		let company = {{$company}};
		let year = {{$request_year}};
		let month = {{$request_month}};

		$('#month_id').val(month);
		$('#year_id').val(year);
		$('#company_id').val(company);
	});

  
 </script>
@endsection
