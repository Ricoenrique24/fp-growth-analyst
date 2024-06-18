<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Test</a></li>
                <li class="breadcrumb-item active">{{ $order->id }}</li>
			</ol>
		</nav>
	</x-slot>
	<div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Detail Test </h2>
                {!! H::deleteBtn('orders.destroy', $order->id) !!}
                {!! H::editBtn('orders.edit', $order->id) !!}
                {!! H::backBtn('orders.index') !!}
        </div>
        <div id="input" class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-hover table">
                    <tbody>
                        <tr>
                            <td width="10%">Code</td>
                            <td width="1%">:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ $order->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</x-midone.app-layout>
