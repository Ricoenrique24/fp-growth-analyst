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
            <h1 class="text-xl" style="font-size: 2em; margin-top: 5px" class="mb-5">Frequent Itemset</h1>
        </div>
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Itemsets</th>
                            <th>Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($supportData as $data)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $data->itemsets }}</td>
                                <td>{{ $data->support }}</td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="intro-y box mt-5">
        <div class="p-5">
            <h1 class="text-xl" style="font-size: 2em; margin-top: 5px" class="mb-5">Hasil Association Rules</h1>
            <h3 class="text-m italic">Produk paling Laku</h3>
        </div>
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th colspan="2" style="text-align: center;">Rules</th>
                            <th style="text-align: center;">Support</th>
                            <th style="text-align: center;">Confidence</th>
                            <th style="text-align: center;">Lift</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($produkLaku as $data)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $data->antecedent }}</td>
                                <td>{{ $data->consequent }}</td>
                                <td>{{ $data->support }}</td>
                                <td>{{ $data->confidence }}</td>
                                <td>{{ $data->lift }}</td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="intro-y box mt-5">
        <div class="p-5">
            <h1 class="text-xl" style="font-size: 2em; margin-top: 5px" class="mb-5">Hasil Association Rules</h1>
            <h3 class="text-m italic">Produk yang Kurang Laku</h3>
        </div>
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th colspan="2" style="text-align: center;">Rules</th>
                            <th style="text-align: center;">Support</th>
                            <th style="text-align: center;">Confidence</th>
                            <th style="text-align: center;">Lift</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($produkRugi as $data)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $data->antecedent }}</td>
                                <td>{{ $data->consequent }}</td>
                                <td>{{ $data->support }}</td>
                                <td>{{ $data->confidence }}</td>
                                <td>{{ $data->lift }}</td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</x-midone.app-layout>
