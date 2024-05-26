<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> My Account
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" id="account-detail-tab" data-bs-toggle="tab"
                                                href="#account-detail" role="tab" aria-controls="account-detail"
                                                aria-selected="true"><i class="fi-rs-user mr-10"></i>Account
                                                Informations</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>My Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"
                                                onclick="event.preventDefault();document.getElementById('acc_logout').submit()"><i
                                                    class="fi-rs-sign-out mr-10"></i>Logout</a>
                                            <form action="{{ route('logout') }}" method="POST" id="acc_logout">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">

                                    <div class="tab-pane fade active show" id="account-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Informations</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" wire:submit.prevent="updateProfile">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>Name <span
                                                                    class="required text-danger">*</span></label>
                                                            <input required="" class="form-control square"
                                                                wire:model="name" type="text">
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Phone <span
                                                                    class="required text-danger">*</span></label>
                                                            <input required="" class="form-control square"
                                                                wire:model="phone">
                                                            @error('phone')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Email Address <span
                                                                    class="required text-danger">*</span></label>
                                                            <input required="" class="form-control square"
                                                                wire:model="email" type="email">
                                                            @error('email')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>New Password </label>
                                                            <input class="form-control square" wire:model="password"
                                                                type="password">
                                                            @error('password')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Confirm Password </label>
                                                            <input class="form-control square"
                                                                wire:model="password_confirmation" type="password">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                                name="submit" value="Submit">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel"
                                        aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Your Orders</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Products</th>
                                                                <th>Discount</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td>{{ $order->id }}</td>
                                                                    <td>
                                                                        {{ date('F d, Y', strtotime($order->created_at)) }}
                                                                    </td>
                                                                    <td><span
                                                                            class="badge {{ $order->status->badge() }}">{{ $order->status->order() }}</span>
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($order->products as $product)
                                                                            <p>{{ $product->name }}
                                                                                <span>{{ $product->pivot->qty }} x
                                                                                    {{ $product->pivot->price }}</span>
                                                                            </p>
                                                                        @endforeach
                                                                    </td>
                                                                    <td>${{ $order->discount }} </td>
                                                                    <td>${{ $order->total }} </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
