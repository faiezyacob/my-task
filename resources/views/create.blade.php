@extends('layouts.app')

@section('content')
	 <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
	        	<ol class="breadcrumb">
	  				<li class="breadcrumb-item"><a href="/home">Back</a></li>
	  				<li class="breadcrumb-item active">Add Task</li>
				</ol>
			</div>
        </div>
        <create></create>   
    </div>
    
@endsection
