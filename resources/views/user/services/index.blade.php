@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',[
'title'   => __('Marketing Services')
])
@endsection
@section('content')
<div class="row">
@if(Session::has('saas_error'))
 <div class="col-sm-12">
   <div class="alert bg-gradient-danger text-white alert-dismissible fade show" role="alert">
     <span class="alert-icon"><i class="fi  fi-rs-info"></i></span>
     <span class="alert-text"><strong>{{ __('!Opps ') }}</strong> {{ Session::get('saas_error') }}</span>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
</div>
@endif
	@foreach($services as $service)
	<div class="col-sm-4 text-center">
		<div class="card">
			<div class="card-body">
				<div class="cover" style="margin-bottom:15px">
					<img src="{{ $service->imagePath }}" alt="{{ $service->title }}" class="img-fluid">
                </div>
				<h2 class="pricing-green">{{ $service->title }}</h2>
                <p style="margin-bottom: 20px;">{{$service->description}}</p>
				<h1>{{ amount_format($service->price) }}</h1>
				<hr>
				
				<a class="btn btn-block  btn-neutral" href="{{ route('user.services.show',$service->id) }}">
						<i class="fa fa-plus-circle " ></i>
                        {{__('Buy Now')}}
				</a>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection