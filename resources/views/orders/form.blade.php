<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Order</a></li>
                @if($order->exists)
                    <li class="breadcrumb-item active">Edit</li>
                @else
                    <li class="breadcrumb-item active">Tambah</li>
                @endif
			</ol>
		</nav>
	</x-slot>
	<div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Order </h2>
                @if($order->exists)
                    {!! H::deleteBtn('orders.destroy', $order->id) !!}
                @endif
                {!! H::backBtn('orders.index') !!}
        </div>
        <div id="input" class="p-5">
            @if($order->exists)
                {!! Form::model($order, ['route' => ['orders.update', $order->id], 'method'=>'PATCH', 'role' => 'form']) !!}
            @else
                {!! Form::model($order, ['route' => ['orders.store'], 'role' => 'form']) !!}
            @endif
            <div class="preview">
                {!! Form::luxText('code', 'Code', $order->code, [
                    'placeholder' => 'Code . e.g. 101',
                    'required' => 'required',
                    'class' => 'mt-2',
                    'autofocus' => 'autofocus'
                    ])
                !!}

                {!! Form::luxText('name', 'Name', $order->name, [
                    'placeholder' => 'Name . e.g. 101',
                    'required' => 'required',
                    'class' => 'mt-2',
                    ])
                !!}
                <div class="mt-2">
                    {!! Form::luxSubmit('Save') !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
	</div>
</x-midone.app-layout>
