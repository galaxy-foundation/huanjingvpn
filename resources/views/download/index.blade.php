@extends('layouts.extra')
@section('page', __('app.title'))

@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-12 text-center">
			<h1>Resource download</h1>
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr>
                        <td></td>
                        <td><a href="{{ route('download.file',['name'=>$file->getFilename()]) }}">{{ $file->getFilename() }}</a></td>
                        <td>{{ App\Helper::getSizeText($file->getSize()) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection