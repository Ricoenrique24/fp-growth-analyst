<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="{{ route('bundlings.index') }}">Bundling</a></li>
                @if($bundling->exists)
                    <li class="breadcrumb-item active">Edit</li>
                @else
                    <li class="breadcrumb-item active">Tambah</li>
                @endif
			</ol>
		</nav>
	</x-slot>
	<div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Bundling </h2>
                @if($bundling->exists)
                    {!! H::deleteBtn('bundlings.destroy', $bundling->id) !!}
                @endif
                {!! H::backBtn('bundlings.index') !!}
        </div>
        <div id="input" class="p-5">
            @if($bundling->exists)
                {!! Form::model($bundling, ['route' => ['bundlings.update', $bundling->id], 'method'=>'PATCH', 'role' => 'form']) !!}
            @else
                {!! Form::model($bundling, ['route' => ['bundlings.store'], 'role' => 'form']) !!}
            @endif
            <div class="preview">
                {!! Form::luxText('code', 'Code', $bundling->code, [
                    'placeholder' => 'Code . e.g. 101',
                    'required' => 'required',
                    'class' => 'mt-2',
                    'autofocus' => 'autofocus'
                    ])
                !!}

                {!! Form::luxText('name', 'Name', $bundling->name, [
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
