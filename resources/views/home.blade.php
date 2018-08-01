@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> LEAD SYSTEM</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   
              
                   
                <h3> Wellcome {{ Auth::user()->name }} To the LEAD SYSTEM </h3>
                 <a href="{{ URL::to('importexport') }}"><button style="background-color:#a6468c !important;border-color:#a6468c !important;" class="btn btn-success">Import/Export</button></a>
			   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
