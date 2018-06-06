@extends('layouts.app')

@push('style')
<style>
    .description {
        font-size: 15px;
    }
    .btn-sub {
        padding: 3px 7px 3px 7px !important;
        margin-right: 7px;
        color: #B18862;
        border-radius: 50%;
    }
    .btn-sub-times {
        padding: 3px 10px 3px 10px !important;
        margin-right: 7px;
        color: #B18862;
        border-radius: 50%;
    }
</style>
@endpush

@push('script')
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
      trigger: 'focus'
    })
});
</script>
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
            <div class="d-flex justify-content-end">
                <a href="/items/create" class="btn btn-light"><i class="fa fa-plus"></i></a>
            </div>
            {!! $table->render() !!}
        </div>
    </div>
</div>
@endsection
