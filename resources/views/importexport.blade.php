
@extends('layouts.app')
@include('flash')
@section('content')
						@if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            
                            </div>
                        @endif
<!-- <div>You need to Login to perfrom some actions</div> -->
<div class="container">
    <a href="http://localhost/exceldata/public/home" style="background-color:#a6468c !important; border-color:#a6468c !important; color:white !important;" class="btn btn-default">HOME PAGE</a>
	<br/><br/>
	@if (Auth::check()) 
	  
		
			<a href="{{ URL::to('downloadexcel/xls') }}"><button style="background-color:#a6468c !important;border-color:#a6468c !important;" class="btn btn-success">Download Excel xls</button></a>
			<a href="{{ URL::to('downloadexcel/xlsx') }}"><button style="background-color:#a6468c !important;border-color:#a6468c !important;" class="btn btn-success">Download Excel xlsx</button></a>

	
			<a href="{{ URL::to('downloadexcel/csv') }}"><button style="background-color:#a6468c !important; border-color:#a6468c !important;" class="btn btn-success">Download CSV</button></a>
		
			<form style="border: 5px solid #a6468c;margin-top: 15px;padding: 15px;" action="{{ URL::to('importexcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			
			<label>Please choose a CSV file</label>
				<input type="file" name="import_file" style="background-color:#a6468c !important; border-color:#a6468c !important;" class="btn btn-success"/>
				<br/>
				<button style="background-color:#a6468c !important; border-color:#a6468c !important;" class="btn btn-success">Import File</button>
			</form>
		</div>
	@else
	
		<div>You need to Login to perfrom some actions</div>
	
	@endif
	
    @endsection