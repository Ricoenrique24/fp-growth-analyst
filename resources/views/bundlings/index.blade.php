<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item active">Orders</li>
			</ol>
		</nav>
	</x-slot>
	<div class="intro-y box mt-5">
       
		<div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>Antecedent</th>
                            <th>Consequent</th>
                            <th>Antecedent Support</th>
                            <th>Consequent Support</th>
                            <th>Support</th>
                            <th>Confidence</th>
                            <th>Lift</th>
                            <th>Leverage</th>
                            <th>Conviction</th>
                            <th>Zhang's Metric</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($associationRulesDescending as $rule)
                        {{-- {{ dd($rule) }} --}}
                        <tr>
                            <td>{{ $rule['antecedent'] }}</td>
                            <td>{{ $rule['consequent'] }}</td>
                            <td>{{ number_format($rule['antecedent_support'], 6) }}</td>
                            <td>{{ number_format($rule['consequent_support'], 6) }}</td>
                            <td>{{ number_format($rule['support'], 6) }}</td>
                            <td>{{ number_format($rule['confidence'], 6) }}</td>
                            <td>{{ number_format($rule['lift'], 6) }}</td>
                            <td>{{ number_format($rule['leverage'], 6) }}</td>
                            <td>{{ number_format($rule['conviction'], 6) }}</td>
                            <td>{{ number_format($rule['zhangs_metric'], 6) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
		</div>

        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>Antecedent</th>
                            <th>Consequent</th>
                            <th>Antecedent Support</th>
                            <th>Consequent Support</th>
                            <th>Support</th>
                            <th>Confidence</th>
                            <th>Lift</th>
                            <th>Leverage</th>
                            <th>Conviction</th>
                            <th>Zhang's Metric</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($associationRulesAscending as $rule)
                        {{-- {{ dd($rule) }} --}}
                <tr>
                    <td>{{ $rule['antecedent'] }}</td>
                    <td>{{ $rule['consequent'] }}</td>
                    <td>{{ number_format($rule['antecedent_support'], 6) }}</td>
                    <td>{{ number_format($rule['consequent_support'], 6) }}</td>
                    <td>{{ number_format($rule['support'], 6) }}</td>
                    <td>{{ number_format($rule['confidence'], 6) }}</td>
                    <td>{{ number_format($rule['lift'], 6) }}</td>
                    <td>{{ number_format($rule['leverage'], 6) }}</td>
                    <td>{{ number_format($rule['conviction'], 6) }}</td>
                    <td>{{ number_format($rule['zhangs_metric'], 6) }}</td>
                </tr>
            @endforeach
                    </tbody>
                </table>
            </div>
		</div>
        {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {!! H::indexLinks($orders, $filter) !!}
        </div> --}}
	</div>

</x-midone.app-layout>
