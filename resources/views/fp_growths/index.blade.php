<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item active">Orders</li>
			</ol>
		</nav>
	</x-slot>
	<div class="intro-y box mt-5">
        {!! Form::open(['method' => 'get']) !!}
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
        {!! Form::close() !!}
		<div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>Support</th>
                            <th>Itemsets</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supportData as $data)
                            <tr>
                                <td>{{ number_format($data['support'], 6) }}</td>
                                <td>{{ $data['itemset'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
		</div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {!! H::indexLinks($orders, $filter) !!}
        </div>
	</div>

</x-midone.app-layout>
