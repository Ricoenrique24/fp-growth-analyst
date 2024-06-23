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
            <h1 class="text-xl" style="font-size: 2em; margin-top: 5px" class="mb-5">Bundling</h1>
            <h3 class="text-m italic">Produk yang Laku</h3>
        </div>
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($bundlingLaku as $rule)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $rule->antecedent . ', ' . $rule->consequent }}</td>
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
            <h1 class="text-xl" style="font-size: 2em; margin-top: 5px" class="mb-5">Bundling</h1>
            <h3 class="text-m italic">Produk yang Kurang Laku</h3>
        </div>
        <div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Antecedent, Consequent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($bundlingRugi as $rule)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $rule->antecedent . ', ' . $rule->consequent }}</td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-midone.app-layout>
