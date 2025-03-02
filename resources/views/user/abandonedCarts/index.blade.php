@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=> __('Abandoned Carts')])
   <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.min.css">



@endsection
@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header border-0">
				<h3 class="mb-0">{{ __('Abandoned Carts') }}</h3>
			</div>
			<!-- Light table -->
			<div class="table-responsive">
				<table id='carts_table' class="table align-items-center table-flush">
					<thead class="thead-light">
						<tr>
							<th class="col-2">{{ __('Cart ID') }}</th>
							<th class="col-2">{{ __('Customer Name') }}</th>
							<th class="col-2">{{ __('Customer Phone') }}</th>
							<th class="col-2">{{ __('Total Amount') }}</th>
							<th class="col-2">{{ __('Sent at') }}</th>
							<th class="col-1 ">{{ __('Status') }}</th>
							<th class="col-1 ">{{ __('Created At') }}</th>
							<th class="col-1">{{ __('Source') }}</th>
							<th class="col-1">{{ __('Checkout URL') }}</th>
							
						</tr>
					</thead>
					@if(count($carts) != 0)
					
					<tbody class="list">
						@foreach($carts ?? [] as $cart)
						<tr>
							<td class="">
									{{ $cart->id }}
							
							</td>
							<td>
								{{ $cart->customer_name }}
							</td>
							<td>
								{{ $cart->customer_phone }}
							</td>

							<td class="text-center">
								{{ $cart->cart_total }}
							</td>
							
                            <td class="text-center">
								@if ($cart->sent_at == null)
									{{ __("N/A") }}
								@else

                                {{ \Carbon\Carbon::parse($cart->sent_at)->format('Y-m-d h:i:s') }}
								@endif
							</td>
							<td>
								{{ $cart->status }}
							</td>
							
							<td class="text-center">
								{{ \Carbon\Carbon::parse($cart->cart_created_at)->format('Y-m-d h:i:s') }}
							</td>
                            
							<td class="text-center">
                                {{ $cart->source }}
                            </td>
							<td>
                               <a target="__blank" href="{{ $cart->checkout_url }}">{{__("Check Cart")}}</a> 
								
								<!-- <div class="dropdown">
									<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-v"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										
										<a class="dropdown-item delete-confirm" href="#" data-action="{//{ route('user.carts.index') }}">Actions</a>
										
									</div>
								</div> -->
							</td>
						</tr>
						@endforeach
					</tbody>
					@endif
				</table>
				
			</div>
			<div class="card-footer py-4">
				<!-- @ //if ($request->all != 1)
				{//{ $transactions->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
				@//endif -->
				<!-- add a button to get all records on one page -->
				<!-- <a href="{{ route('admin.message-transactions.index',['all'=>true]) }}" class="btn btn-primary">{{ __('Get All Records') }}</a> -->
			</div>	
		</div>
	</div>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script>
	$(document).ready(function() {
		$('#carts_table').DataTable(
			{	
			"dom": 'Bfrtip', 
			paging: true,
			"searching": true,
			"lengthMenu": [ [10, 25, 50, "All"] ],
			// "layout" :{ 
			// 	    topStart: 'pageLength',
			// 		topEnd: 'search',
			// 		bottomStart: 'info',
			// 		bottomEnd: 'paging'
			// },
			language:{
                url: '/assets/datatables/lang/ar.json'
            },
			"buttons": [
                    {
                        "extend": 'excelHtml5', 
                        "text":"{{__('Export to Excel')}}",
                        "title":"{{__('Abandoned Carts')}}",
						
                    }
                ],
			"info": true,
			"columnDefs": [
				{
				"targets": [ 0, 1, 2,7 ],
				"orderable": false
				},
			]
			}
		);

	});
	
</script>
@endpush