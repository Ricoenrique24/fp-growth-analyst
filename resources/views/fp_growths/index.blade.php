<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item active">Fp Growths</li>
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
                    {!! H::createBtn('fp_growths.create') !!}
                </div>
            </div>
        {!! Form::close() !!}
		<div class="p-5">
            <div class="overflow-x-auto">
                <table class="table-sm table-bordered table-hover table">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="whitespace-nowrap">Code</th>
                            <th class="whitespace-nowrap">Name</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fp_growths as $fp_growth)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $fp_growth->code }}</td>
                                <td>{{ $fp_growth->name }}</td>
                                <td>
                                    {!! H::indexShowBtn('fp_growths.show', $fp_growth->id) !!}
                                    {!! H::indexEditBtn('fp_growths.edit', $fp_growth->id) !!}
                                    {!! H::indexDeleteBtn('fp_growths.destroy', $fp_growth->id) !!}
                                </td>
                            </tr>
                        @empty
                            @include('shared._no_data', ['col' => 4])
                        @endforelse
                    </tbody>
                </table>
            </div>
		</div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {!! H::indexLinks($fp_growths, $filter) !!}
        </div>
	</div>

</x-midone.app-layout>
