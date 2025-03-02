 <div id="price" class="tp-price__area tp-price__border pt-120 pb-90 ">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-6 col-10">
            <div class="tp-price__section text-center pb-60 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
               <h3 class="tp-section-title-sm pb-20">{{ __('Pricing to suite all size of business') }}</h3>
               <span>{{ __('*We help companies of all sizes') }}</span>
            </div>
         </div>
      </div>
      <div class="row g-0 align-items-end align-items-lg-center" >
         @foreach($plans ?? [] as $plan)
         <div class="plan col-xl-4 col-lg-4 col-md-6 mb-30 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s" >
            <div class="tp-price__item tp-price__active z-index"  style="{{ $plan->is_recommended == 1 ? 'background-color: #017EFA !important;color: white;border-radius: 24px;display: flex;flex-direction: column;justify-content: space-between;' : ''}} border: 0.5px solid var(--tp-common-sky);">
               <div class="tp-price__icon d-flex justify-content-between align-items-center" style="margin-bottom: 17px;width:100%;">
                  <span style="{{$plan->is_recommended == 1 ? 'color:white;' : ''}} font-size:18px">{{ $plan->title }} </span>
                  @if ($plan->is_recommended == 1)
                  <div style="background-color: white;border-radius: 8px;color: #017EFA;padding: 8px;">الاكثر طلباً</div>
                  @endif
               </div>
               <h3 class="tp-price__title" style="{{$plan->is_recommended == 1 ? 'color: white;text-align: right;' : ''}}">{{ amount_format($plan->price,'icon') }} <small class="tp-price__small_title">{{ '/' . ($plan->days == 30 ? __('month') : __('year')) }}</small></h3>
               <div class="tp-price__list {{$plan->is_recommended == 1 ? 'plan-active' : ''}}">
                  <ul>
                     @foreach($plan->data ?? [] as $key => $data)
                     <li class="{{ planData($key,$data)['value'] == false && planData($key,$data)['is_bool'] == true ? 'd-none' : '' }}">
                        <img style="width: 25px;height: 25px;color: white;" src="/assets/img/check-icon.svg">
                        {{ ucfirst(__(str_replace('_',' ',planData($key,$data)['title']))) }}
                     </li>
                     @endforeach
                  </ul>
               </div>
               <div class="tp-price__btn {{$plan->is_recommended == 1 ? 'plan-active' : ''}}">
                  <a class="tp-btn-border" href="{{ url('/register',$plan->id) }}"><span>{{ $plan->is_trial == 1 ? __('Free '.$plan->trial_days.' days trial') : __('Sign Up Now') }}</span></a>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>
<style>
    .plan {
        padding: 15px;
    }
    .plan .tp-price__item {
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items:start; 
        padding: 35px 45px;
        border-radius: 24px;
    }
    .tp-price__list ul li::before {
       content : none !important; 
    }
    .tp-price__title {
        padding-bottom:8px;
    }
    .tp-price__list ul li {
       padding-right: 0px;
       margin-right: 0;
       margin-bottom: 7px;
       
    }
    .tp-price__list {
        margin-bottom: 14px;
    }
     .tp-price__list.plan-active ul li img {
        
        filter: grayscale(100%) brightness(500%);
     }
     .plan-active.tp-price__btn a  {
         background-color: white !important;
        color: #017EFA !important;
     }
     .tp-price__btn a {
         background-color: #017EFA !important;
        color: #fff !important;
     }
     .tp-price__btn {
         width: 100%;
     }
     @media (min-width: 1200px) {
       .plan {
           width: 33%;
       }  
     }
</style>
