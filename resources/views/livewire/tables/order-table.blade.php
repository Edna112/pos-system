<div class="container-fluid">
    <div class="card w-100">
        <div class="card-header">
            <div>
                <h3 class="card-title">
                    {{ __('Orders') }}
                </h3>
            </div>

            <div class="card-actions">
                <x-action.create route="{{ route('orders.create') }}" />
            </div>
        </div>

        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-secondary">
                    Show
                    <div class="mx-2 d-inline-block">
                        <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    entries
                </div>
                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>

        <x-spinner.loading-spinner/>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice No</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center">{{ $order->invoice_no }}</td>
                            <td class="align-middle">{{ $order->customer->name }}</td>
                            <td class="align-middle text-center">{{ $order->order_date->format('d-m-Y') }}</td>
                            <td class="align-middle text-center">{{ $order->payment_type }}</td>
                            <td class="align-middle text-center">{{ Number::currency($order->total, 'XAF') }}</td>
                            <td class="align-middle text-center">
                                <span class="badge 
                                    {{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'bg-success' : 
                                       ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $order->order_status->label() }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-info btn-sm rounded-circle" title="View Order">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('order.downloadInvoice', $order) }}" class="btn btn-success btn-sm rounded-circle" title="Download Invoice">
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">
                Showing <span>{{ $orders->firstItem() }}</span> to <span>{{ $orders->lastItem() }}</span> of <span>{{ $orders->total() }}</span> entries
            </p>

            <ul class="pagination m-0 ms-auto">
                {{ $orders->links() }}
            </ul>
        </div>
    </div>
</div>
