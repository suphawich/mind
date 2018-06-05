@extends('layouts.app')

@push('style')
<style>
    .description {
        font-size: 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            +{{ session('status') }}
                        </div>
                    @endif
                </div>
            </div> --}}
            {!! $table->render() !!}
        </div>
    </div>
</div>
@endsection