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
    .btn-action {
        background: inherit;
    }
    .btn-action:hover {
        background-color: #A1EFE2;
    }
    .filter input {
        line-height: 30px;
        min-width: 400px;
    }
    .badge {
        cursor: pointer;
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
        <div class="col-md-8">

            <div class="d-flex">
              <div class="mr-auto">
                  <form class="" action="/items/search" method="get">
                      <div class="input-group mb-3">
                          <div class="filter">
                              <input type="text" name="search" value="" placeholder="Press enter for searching">
                          </div>
                          <div class="input-group-prepend">
                              <button type="submit" class="input-group-text btn"><i class="fa fa-search"></i></button>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="pb-2">
                  <a href="/items/create" class="btn btn-light"><i class="fa fa-plus"></i></a>
              </div>
            </div>
            {!! $table->render() !!}
        </div>
    </div>
</div>
@endsection
