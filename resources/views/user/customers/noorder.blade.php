@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=> __('Customers With No Orders')])
   <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.min.css">



@endsection
@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header border-0">
				<h3 class="mb-0">{{ __('Customers with no orders') }}</h3>
			</div>
			<!-- Light table -->
			<div class="table-responsive">
				<table id='customers_table' class="table align-items-center table-flush">
					<thead class="thead-light">
						<tr>
							<th class="col-2">{{ __('Customer ID') }}</th>
							<th class="col-2">{{ __('Name') }}</th>
							<th class="col-2">{{ __('Phone') }}</th>
							<th class="col-2">{{ __('Email') }}</th>
							<th class="col-2">{{ __('Gender') }}</th>
							<th class="col-1 ">{{ __('Birth Date') }}</th>
							<th class="col-1 ">{{ __('Created At') }}</th>
							<th class="col-1 ">{{ __('Source') }}</th>

						</tr>
					</thead>
					@if(count($customers) != 0)
					<tbody class="list">
						@foreach($customers ?? [] as $customer)
						<tr>
							<td class="">
								{{ $customer->id }}
								
							</td>
							<td>
								{{ $customer->name }}
							</td>
							<td>
								{{ $customer->phone }}
							</td>

							<td class="text-center">
								{{ $customer->email }}
							</td>
							
							<td>
								{{ $customer->gender }}
							</td>
							
                            <td class="text-center">
                                @if ($customer->birth_date == null)
									{{ __("N/A") }}
								@else

                                {{ \Carbon\Carbon::parse($customer->birth_date)->format('Y-m-d h:i:s') }}
								@endif
                            </td>
							<td class="text-center">
								{{ \Carbon\Carbon::parse($customer->customer_created_at)->format('Y-m-d h:i:s') }}
							</td>
                            <td class="text-center">
                                {{ $customer->source }}
                            </td>
							<!-- <td>
								
								<div class="dropdown">
									<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-v"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										
										<a class="dropdown-item delete-confirm" href="#" data-action="{//{ route('user.customers.index') }}">Actions</a>
										
									</div>
								</div>
							</td> -->
						</tr>
						@endforeach
					</tbody>
					@endif
				</table>
				
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
		$('#customers_table').DataTable(
			{	
			"dom": 'Bfrtip', 
			paging: true,
			"searching": true,
			"lengthMenu": [ [10, 25, 50, "All"] ],
			language:{
                url: '/assets/datatables/lang/ar.json'
            },
			"buttons": [
                    {
                        "extend": 'excelHtml5', 
                        "text": "{{__('Export to Excel')}}",
                        "title": '{{__("Customers No Orders")}}',
						
                    }
                ],
			"info": true,
			"columnDefs": [
				{
				"targets": [ 0, 1, 2, 3, 4,7 ],
				"orderable": false
				},
			]
			}
		);

	});
	
</script>
@endpush