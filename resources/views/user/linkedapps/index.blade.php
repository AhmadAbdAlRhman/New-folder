@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=> __('Linked Apps')])
@endsection
@section('content')
 


<div class="row">
	
	@foreach ($linkedApps as $key => $app)
        <div class="col-md-4 col-sm-6">
			<div class="card">
				<div class="card-body">
					<img class="img-responsive" src="{{asset($app['img'])}}">
					<h3 class="mt-3 text-center">{{__($app['name'])}}</h3>
					<p class="mb-4">{{__($app['desc'])}}</p>
					
						<div>
							<a class="btn btn-block  btn-neutral" href="{{route('user.linkedapps.show', ['app' => $app['app_name']])}}">
								<i class="fi fi-rs-link-horizontal"></i>
								{{__('Settings')}}
							</a>
						</div>
						<div class="mt-4">
							<p class="text-center">
								<span class="badge btn-block {{($app['status'] == 'connected') ? 'badge-success text-success' : 'badge-danger text-danger'}}">
									@if ($app['status'] == 'connected')
										{{__('Connected')}}
										
									@else
										{{__('Not Connected')}}

									@endif
								</span>
							</p>
						</div>
				</div>
			</div>

        </div>
    @endforeach
	
</div>
@endsection