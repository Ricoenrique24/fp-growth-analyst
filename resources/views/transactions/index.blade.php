<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item active">Transaction</li>
			</ol>
		</nav>
	</x-slot>
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box zoom-in">
            <div class="box p-5">
                <div class="flex">
                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i>
                    <div class="ml-auto">
                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="100% Higher than last month">
                            33% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                        </div>
                    </div>
                </div>
                <div class="text-3xl font-medium leading-8 mt-6">{{ $count }}</div>
                <div class="text-base text-slate-500 mt-1">Total Transaksi</div>
            </div>
        </div>
    </div>
	<div class="intro-y box mt-5">
        {{-- {!! Form::open(['method' => 'get']) !!}
            <div class="flex flex-col border-b border-slate-200/60 p-5 sm:flex-row">
                <div class="basis-auto px-1">
                    {!! Form::luxFilterText('code', 'Code', $filter) !!}
                </div>
                <div class="basis-auto px-1">
                    {!! Form::luxFilterText('name', 'Name', $filter) !!}
                </div>
                <div class="basis-auto px-1 grow">
                    {!! Form::luxFilterBtn() !!}
                </div>
                <div class="basis-auto px-1 text-right">
                    {!! H::createBtn('orders.create') !!}
                </div>
            </div>
        {!! Form::close() !!} --}}
		<div class="p-5">
            <div>
                3 Bulan
            </div>
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="whitespace-nowrap">Tanggal</th>
                            <th class="whitespace-nowrap">No Transaksi</th>
                            <th class="whitespace-nowrap">Pelanggan</th>
                            <th class="whitespace-nowrap">Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($three_bulan as $three)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $three->tanggal }}</td>
                                <td>{{ $three->no_transaksi }}</td>
                                <td>{{ $three->pelanggan }}</td>
                                <td>{{ $three->produk }}</td>
                            </tr>
                        @empty
                            @include('shared._no_data', ['col' => 4])
                        @endforelse
                    </tbody>
                </table>
            </div>
		</div>

        <div class="p-5">
            <div>
                1 Tahun
            </div>
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="whitespace-nowrap">Tanggal</th>
                            <th class="whitespace-nowrap">No Transaksi</th>
                            <th class="whitespace-nowrap">Pelanggan</th>
                            <th class="whitespace-nowrap">Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->tanggal }}</td>
                                <td>{{ $order->no_transaksi }}</td>
                                <td>{{ $order->pelanggan }}</td>
                                <td>{{ $order->produk }}</td>
                            </tr>
                        @empty
                            @include('shared._no_data', ['col' => 4])
                        @endforelse
                    </tbody>
                </table>
            </div>
		</div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {!! H::indexLinks($transactions, $filter) !!}
        </div>
	</div>

</x-midone.app-layout>
