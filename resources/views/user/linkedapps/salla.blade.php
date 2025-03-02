@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=>__('Single Send')])
@endsection
@push('topcss')
    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/css/uikit.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
@endpush
@section('content')

<div class="row justify-content-center">
    <div class="d-none d-md-block col-md-9 col-sm-12 position-sticky top-10 special-section">
        <div class="d-flex justify-content-between">
            <h4 class="text-left">{{ __('Salla Configuration') }}</h4>
            <div class="collapse-menu cursor-pointer">
                <i class="fi fi-rs-chevron-double-down"></i>
            </div>
        </div>
        <ul class="d-flex flex-wrap justify-content-start list-unstyled">
            @foreach ($settings as $setting)
            <li class="border bg-secondary p-2 border-primary mb-2 mr-2">
                <div class="setting-links " href="#{{$setting['name']}}" >{{__($setting['name'])}}</div>
            </li>
            
            @endforeach

        </ul>
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="mt-4">
            <form id="ajax-form" >
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label>{{ __('Select Device') }}</label>
                                <!-- <select class="form-control" name="device" required="" data-toggle="select"> -->
                                <select class="form-control" name="device" required="">
                                    @foreach($devices as $device)
                                    <option value="{{ $device->id }}">{{ $device->name }} (+{{ $device->phone }})</option>
                                    @endforeach
                                </select>
                                        
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3>{{__('Templates')}}</h3>
                                <div id="owner_phone_number" class="mt-10"></div>
                                <div class="form-group mt-5">
                                    <div class="card border-primary ">
                                        <div class="card-header flex-wrap justify-content-between ">
                                            <h4>{{__('Owner phone number to recieve notfifcations')}}</h4>
                                            
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="owner_phone_number">{{__('Enter phone number')}} </label>
                                                <input type="text" class="form-control" id="owner_phone_number" name="owner_phone_number" value="{{$owner_phone_number}}" placeholder="{{__('Owner phone number to recieve notfifcations')}}" aria-invalid="false">
                                            </div>
                                            <div class="form-group errors err-owner_phone_number">
                                                <p></p>
                                            </div>
                                            <div>
                                                {{__('Note: if this field is empty, any notification destinated to the seller will not be sent')}}
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                @foreach($settings as $setting)
                                <div id="{{$setting['name']}}" class="mt-10"></div>
                                <div class="form-group mt-5">
                                    <div class="card border-primary ">
                                        <div class="card-header flex-wrap justify-content-between ">
                                            <h4>{{__($setting['description'])}}
                                                <span data-toggle="tooltip" data-placement="top" title="" data-original-title="يرجى استخدام العلامات التالية من اجل ادخال متغيرات في الرسالة:{{$setting['params']}}">
                                                    <i class="fi fi-rs-info text-info ml-2"></i>
                                                </span>
                                            </h4>
                                            <div class="card-header-action m-0">
                                                <div class="row">
                                                    <label class="mt-1" for="{{$setting['name']}}">
                                                        <h4>{{__('Enable')}}</h4>
                                                    </label>
                                                    <label class="custom-toggle custom-toggle-primary ml-2">
                                                    <input type="checkbox" name="{{$setting['name']}}" @if($setting['is_active']) checked @endif id="{{$setting['name']}}">
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="{{__('No')}}" data-label-on="{{__('Yes')}}"></span>
                                                    </label>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if ($setting['img_enabled'])
                                            <div class="form-group picture">
                                                <div>
                                                    <label for="{{$setting['name']}}_img">اختر صورة</label>
                                                    
                                                    <input type="file" class="form-control" id="{{$setting['name']}}_img" name="{{$setting['name']}}_img" >

                                                </div>
                                                @if ($setting['img'])
                                                    <img src="{{$setting['img']}}" alt="img" class="img-fluid mt-2">
                                                @endif
                                            </div>
                                            @endif

                                            @if ($setting['can_delay'])
                                            <div class="form-group">
                                                <label for="{{$setting['name']}}_delay">{{$setting['name'] !== '' ? __('Delay (in hours)') : __('Delay (in days)')}}</label>
                                                <input type="number" step="1" class="delay-input form-control" id="{{$setting['name']}}_delay" name="{{$setting['name']}}_delay" min="0"  value="{{$setting['delay']}}" placeholder="مدة التأجيل (بالساعة)" aria-invalid="false">
                                            </div>
                                            @endif

                                            <div class="form-group errors err-{{$setting['name']}}">
                                                <p></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="{{$setting['name'].'_message'}}">{{__('Enter text')}} </label>
                                                @if ($setting['message_template']) 
                                                    <textarea class="form-control" id="{{$setting['name'].'_message'}}" name="{{$setting['name'].'_message'}}" placeholder="{{__($setting['description'])}}" rows="4">{{$setting['message_template']}}</textarea>
                                                @else
                                                    <textarea class="form-control" id="{{$setting['name'].'_message'}}" name="{{$setting['name'].'_message'}}" placeholder="{{__($setting['description'])}}" rows="4"></textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col text-center mb-3">
                        <button type="submit" class="btn btn-outline-primary submit-button text-center">{{__('Save Settings')}}</button>
                       
                    </div>
                </div>
            </form>
           
        </div>

    </div>

</div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit-icons.min.js"></script>
<script>

    const  hideErrors = () => {
        $('.errors').each(function (error) {
            $(error).hide();
        });
    }
    $(document).ready(function () {
        hideErrors();
        $('.delay-input').on('input', function () {
            // check if the value is a number
            console.log($(this).val() === '');
            if (isNaN($(this).val()) || $(this).val() === '') {
                $(this).val(0);
            }
            if ($(this).val() <0) {
                $(this).val(0);
            }
        });
        $('.collapse-menu').click(function () {
            $('.special-section ul').toggleClass('ul-special-section-collapse');
        });
        $('.setting-links').click(function () {
            var id = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(id).offset().top -250
            }, 1000);
            $('.special-section ul').toggleClass('ul-special-section-collapse');
        });
        $('#ajax-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('user.linkedapps.savesettings','salla') }}",
                data: new FormData($('#ajax-form')[0]), 
                contentType: false,  
                processData: false, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    hideErrors();
                    $('#ajax-form button.submit-button').attr('disabled', false);
                    $('#ajax-form button.submit-button').html('{{__("Save Settings")}}');
                    Swal.fire({
                        title: response.message,
                        text: "{{ __('Your settings are saved successfully') }}",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '{{__("Okay")}}',
                    }).then((result) => {
                        console.log('hello')
                    });

                },
                //handle on click to disable buttons
                beforeSend: function () {
                    $('#ajax-form button.submit-button').attr('disabled', true);
                    $('#ajax-form button.submit-button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> {{__("Saving...")}}');
                },
                error: function (xhr, status, error) {
                    console.log(Object.keys(xhr.responseJSON.errors))
                    $('#ajax-form button.submit-button').attr('disabled', false);
                    $('#ajax-form button.submit-button').html('{{__("Save Settings")}}');
                    hideErrors();
                    if (xhr.responseJSON) {
                        let elm = null;
                        $.each(Object.keys(xhr.responseJSON.errors), function (ind, key) {
                            if (ind ==0) {
                                elm = key;
                            }
                            $.each(xhr.responseJSON.errors[key], function (ind,value) {
                                console.log(value);
                                $('.err-' + key).show();
                                $('.err-' + key + ' p').text(value);
                            });
                            
                        });
                        $('html, body').animate({
                            scrollTop: $('.err-' + elm).offset().top - 250
                        }, 1000);
                    }
                    Swal.fire({
                        title: "{{__('Error while saving settings')}}",
                        text: "{{ __('Please correct the errors then submit again') }}",
                        icon: 'danger',
                        showCancelButton: false,
                        confirmButtonColor: '#880808',
                        confirmButtonText: '{{__("Okay")}}',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function (key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key).closest('.form-group').append('<div class="invalid-feedback">' + value + '</div>');
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush