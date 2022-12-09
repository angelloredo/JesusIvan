@extends('user')

@section('content')


    @include('partials.breadcrumb')

    <div class="faq-section shadow-bg">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-deposit">
                        <div class="card-header custom-header text-center">
                            <h4 class="card-title">@lang('Stripe Payment')</h4>
                        </div>
                        <div class="card-body text-center">

                            <div class="row justify-content-center">
                                <div class="col-md-4">

                                    <div class="card ">
                                        <div class="card-body card-body-deposit">
                                            <img src="{{asset('public/images/gateways/'. $deposit->gateway_currency()->image)}}" class="card-img-top w-80p" alt="payment" >
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group font-weight-bold">
                                        <li class="list-group-item">@lang('Amount') : {{formatter_money($deposit->amount,2)}} {{trans($basic->currency)}}</li>
                                        <li class="list-group-item">@lang('Charge') : {{formatter_money($deposit->charge,2)}} {{trans($basic->currency)}}</li>
                                        <li class="list-group-item">@lang('Rate') : {{formatter_money($deposit->rate,2)}} {{trans($deposit->method_currency)}}</li>
                                        <li class="list-group-item">@lang('Payable Amount') : {{formatter_money($deposit->final_amo,2)}} {{trans($deposit->method_currency)}}</li>

                                        <li class="list-group-item">
                                            <div id="paypal-button-container" ></div>
                                        </li>
                                    </ul>



                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




@endsection

@section('js')
    <script src="https://www.paypal.com/sdk/js?client-id={{$data->cleint_id}}&currency={{$data->currency}}"></script>
    <script>
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [
                        {
                            description: "{{ $data->description }}",
                            custom_id: "{{ $data->custom_id }}",
                            amount: {
                                currency_code: "{{trim($data->currency)}}",
                                value: "{{ $data->amount }}",
                                breakdown: {
                                    item_total: {
                                        currency_code: "{{trim($data->currency)}}",
                                        value: "{{ $data->amount }}"
                                    }
                                }
                            }
                        }
                    ]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    var trx = "{{ $data->custom_id }}";
                    window.location = '{{ route('g101')}}/' + trx + '/' + details.id
                });
            }
        }).render('#paypal-button-container');
    </script>
@stop


