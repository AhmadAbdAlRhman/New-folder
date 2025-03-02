@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=> __('Morsal')])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.min.css">

@endsection
@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<!-- Card header -->
			<div class="card-header border-0 row d-flex justify-content-between">
				<h3 class="mb-0">{{ __('App Logs') }}</h3>
                <div class="btn-group " 
                @if ($current_title == 'Orders')
                    style="padding-left:30px"
                @endif
                
                >
                    <button class="btn btn-primary" id="bulkResend" data-message="{{$data_message}}" style="display:none" onclick="resend(this, true);">{{__('Bulk resend')}}</button>
                    <button class="btn btn-default dropdown-toggle waves-effect waves-float waves-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{__($current_title)}}
                    </button>
                    <div class="dropdown-menu pages" aria-labelledby="dropdownMenuButton">
                        @foreach ($links as $link)
                            @if ($link[0] == $current_title)
                                @continue
                            @endif
                            <a class="dropdown-item" href="{{ $link[1] }}" data-result="html" data-content="column-two">{{__($link[0])}}</a>
                        @endforeach
                    </div>
                </div>
			</div>
			<!-- Light table -->
			<div class="table-responsive">
				<table id='data_table' class="table align-items-center table-flush">
					<thead class="thead-light">
						<tr>
                            <!-- head to select all -->
                            <th class="col-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="check-all" type="checkbox">
                                    <label class="custom-control-label" for="check-all"></label>
                                </div>
                            </th>
							@foreach($columns as $column)
                                <th class="col-2">{{ __($column['title']) }}</th>
                            @endforeach
                            <th class="col-2">{{ __('Actions') }}</th>
						</tr>
					</thead>
					@if(count($data) != 0)
                    
					
					<tbody class="list">
						@foreach($data ?? [] as $elmnt)
						<tr>
                            <!-- select this row -->
                             <td>
                                <div class="custom-control custom-checkbox">
                                    <input name="ids[]" value="{{$elmnt['id']}}" class="custom-control-input selectRow" id="check-{{$elmnt['id']}}" type="checkbox">
                                    <label class="custom-control-label" for="check-{{$elmnt['id']}}"></label>
                                </div>
                            </td>
                            @foreach($columns as $column)
                                <td>
                                     
                                    @if ($column['type'] == 'date')
                                        @if ($prefixed)
                                            {{ \Carbon\Carbon::parse($elmnt['abandonedcart'][$column['accosseor_name']])->format('Y-m-d h:i:s') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($elmnt[$column['accosseor_name']])->format('Y-m-d h:i:s') }}
                                        @endif
                                    @elseif ($column['type'] == 'url')
                                        @if ($prefixed)
                                            <a href="{{ $elmnt['abandonedcart'][$column['accosseor_name']] }}" > {{__('Check Cart')}} </a>
                                        @else
                                            <a href="{{ $elmnt[$column['accosseor_name']] }}" > {{__('Check')}} </a>
                                        @endif
                                    @else 
                                        @if ($prefixed)
                                            {{  $elmnt['abandonedcart'][$column['accosseor_name']] }}
                                        @else 
                                            {{  $elmnt[$column['accosseor_name']] }}
                                        @endif

                                    @endif
                                </td>
                            @endforeach
							
							<td>
                                <div class="btn-group">

                                    <button data-rowid="{{$elmnt['id']}}" data-message="{{$data_message}}"
                                    onclick="resend(this)" class="btn btn-primary btn-sm"
                                    >{{__("Resend")}}</button> 
                                </div>
								
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
<div class="modal fade" id="subs-modal" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="resend-form" method="POST">
                <input type="hidden" name="row_ids" id="row_ids" />
                <input type="hidden" name="type" value="{{ $resend_type }}" />
                <input type="hidden" name="bulk" value="on" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="custom_message">الرسالة</label>
                        <textarea class="form-control" id="custom_message" required name="custom_message" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary actionMultiItem">إرسال الآن</button>
                </div>
            </form>
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
		$('#data_table').DataTable(
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
            // language: {
            //     info: 'إظهار النتائج من _PAGE_ إلى _PAGES_',
            //     infoEmpty: 'لا يوجد نتائج',
            //     infoFiltered: '(تمت الفلترة من _MAX_ نتيجة)',
            //     lengthMenu: 'إظهار _MENU_ نتيجة في الصفحة',
            //     zeroRecords: 'لم نجد أي شيئ'
            // },
            language:{
                url: '/assets/datatables/lang/ar.json'
            },
			"buttons": [
                    {
                        "extend": 'excelHtml5', 
                        "text": "{{__('Export to Excel')}}",
                        "title": "{{__($current_title)}}",
						
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

        function updateActionsButton() {
            var selectedRowsCount = $('input.selectRow:checked').length;
            if (selectedRowsCount >= 2) {
                $('#bulkResend').show();
            } else {
                $('#bulkResend').hide();
            }
        }
        updateActionsButton();
        // Handle select all checkbox change
        $("#check-all").change(function() {
            const isCheck = $(this).is(":checked");
            $('input.selectRow').prop('checked', isCheck);
            updateActionsButton();
        });

        // Handle row checkbox change
        $(document).on('change', 'input.selectRow', function() {
            var allChecked = $('input.selectRow').length === $('input.selectRow:checked').length;
            $('.selectAll').prop('checked', allChecked);
            updateActionsButton();
        });
        $("#resend-form").submit(function(e) {
                e.preventDefault();
                let form_data = $(this).serialize();
                $(".actionMultiItem").prop('disabled', true);
                $.ajax({
                    context: this,
                    type: 'POST',
                    url: "{{ route('user.applicationLogs.resend') }}",
                    data: form_data,
                    dataType: 'json',
                    success: function(response) {
                        $(".actionMultiItem").prop('disabled', false);
                        if (response.success) {
                            ToastAlert('success', response.message);
                            $('#subs-modal').modal('hide');
                        } else {
                            ToastAlert('error', response.message);
                        }
                    },
                    error: function(response) {
                        $(".actionMultiItem").prop('disabled', false);
                        ToastAlert('error', response.responseJSON.message);
                    }
                });
            });

	});
	function resend(el, bulk = false) {
        let msg = '';
        if (bulk) {
            var ids = $('input[name="ids[]"]').map(function() {
                if ($(this).is(':checked')) {
                    return $(this).val();
                }
            }).get();
            $('#subs-modal input[name=\'bulk\']').val('on');
            let msg = $('#bulkResend').data('message');
            $('#subs-modal #row_ids').val(ids);
            if(msg != '') {
                $('#subs-modal #custom_message').val(msg);
            }
        } else {
            let ids = $(el).data('rowid');
            let msg = $(el).data('message');
            $('#subs-modal input[name=\'bulk\']').val('off');

            $('#subs-modal #row_ids').val(ids);
            $('#subs-modal #custom_message').val(msg);
        }
        $('#subs-modal').modal('show');
    }
</script>
@endpush