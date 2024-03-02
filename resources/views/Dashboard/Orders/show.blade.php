@extends('layouts.master', ['title' => 'Details Order'])

@section('content')
    <style>
        @media print {
            #print_Button {
                display: none !important;
            }
        }
    </style>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="bx bx-home-alt"></i></a>
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card" id="print">
            <div class="card-body">

                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <small style="text-align: right;">Date: {{ date('d/m/Y') }}</small>
                            </h4>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong> {{ auth('admin')->user()->name }}.</strong><br>
                                Phone: {{ $setting->phone }}<br>
                                Email: {{ $setting->email }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ $order->user->name }}</strong><br>
                                {{ $order->address }}<br>
                                {{ $order->address2 }}<br>
                                Phone: {{ $order->phone }}<br>
                                Email: {{ $order->user->email }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #{{ $order->id }}</b><br>
                            <br>
                            <b>Order ID:</b> {{ $order->id }}<br>
                            <b>Payment Due:</b> {{ date('d/m/Y', strtotime($order->created_at)) }}<br>
                            <b>Account:</b> 968-34567
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>${{ $product->pivot->price }}</td>
                                            <td>{{ $product->pivot->qty }}</td>
                                            <td>${{ $product->pivot->price * $product->pivot->qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6">
                            <p class="lead">Payment Methods:</p>
                            {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="../../dist/img/credit/american-express.png" alt="American Express">
                            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly
                                ning heekya handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                            </p> --}}
                        </div>

                        <div class="col-6">
                            <p class="lead">Amount Due {{ date('d/m/Y', strtotime($order->created_at)) }}</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>${{ $order->subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tax </th>
                                            <td>${{ $order->tax }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>Free</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>${{ $order->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="row no-print">
                        <div class="col-12">
                            <button class="btn btn-danger mt-3 mr-2" id="print_Button" onclick="printDiv()">
                                <i class="mdi mdi-printer ml-1"></i>Print</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@push('js')
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endpush
