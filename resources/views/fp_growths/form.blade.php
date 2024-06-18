<x-midone.app-layout>
	<x-slot name="breadcrumb">
		<nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
			<ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="{{ route('fp_growths.index') }}">Fp Growth</a></li>
                @if($fp_growth->exists)
                    <li class="breadcrumb-item active">Edit</li>
                @else
                    <li class="breadcrumb-item active">Tambah</li>
                @endif
			</ol>
		</nav>
	</x-slot>
	<div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Fp Growth </h2>
                @if($fp_growth->exists)
                    {!! H::deleteBtn('fp_growths.destroy', $fp_growth->id) !!}
                @endif
                {!! H::backBtn('fp_growths.index') !!}
        </div>
        <div id="input" class="p-5">
            @if($fp_growth->exists)
                {!! Form::model($fp_growth, ['route' => ['fp_growths.update', $fp_growth->id], 'method'=>'PATCH', 'role' => 'form']) !!}
            @else
                {!! Form::model($fp_growth, ['route' => ['fp_growths.store'], 'role' => 'form']) !!}
            @endif
            <div class="preview">
                {!! Form::luxText('code', 'Code', $fp_growth->code, [
                    'placeholder' => 'Code . e.g. 101',
                    'required' => 'required',
                    'class' => 'mt-2',
                    'autofocus' => 'autofocus'
                    ])
                !!}

                {!! Form::luxText('name', 'Name', $fp_growth->name, [
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
