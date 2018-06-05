@extends('layouts.app')

@push('style')
<style>
    .option {
        font-size: 15px;
        width: 50px;
    }
    .option-column {
        padding-top: 2px !important;
        padding-bottom: 2px !important;
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Setting</div>

                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#furniture">Furniture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
                       </li>
                     </ul>
                     <div class="tab-content">
                         <div id="furniture" class="container tab-pane active"><br>
                             <form class="" action="/setting_items/{{ $setting->id }}" method="post">
                                 @csrf
                                 @method('PUT')
                                 <div class="form-group row">
                                     <div class="col-md-2">
                                         <label>Unit</label>
                                     </div>
                                     <div class="col-md-10">
                                         <select name="unit">
                                             @foreach ($units as $key => $value)
                                                 @if ($value == $setting->unit)
                                                     <option value="{{ $value }}" selected>{{ $key }}</option>
                                                 @else
                                                     <option value="{{ $value }}">{{ $key }}</option>
                                                 @endif
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <div class="col-md-2">
                                         <label>Option</label>
                                     </div>
                                     <div class="col-md-10 option">
                                         <table class="table table-striped table-bordered table-sm">
                                             <tbody>
                                                 <tr>
                                                     <td class="option-column">a</td>
                                                 </tr>
                                                 <tr>
                                                     <td class="option-column">b</td>
                                                 </tr>
                                                 <tr>
                                                     <td class="option-column">c</td>
                                                 </tr>
                                                 <tr>
                                                     <td class="option-column">d</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                                 <div class="form-group row float-right">
                                     <input type="submit" class="btn btn-success mr-2" name="submit" value="Apply">
                                 </div>
                             </form>
                         </div>
                         <div id="menu1" class="container tab-pane fade"><br>
                             <h3>Menu 1</h3>
                             <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                         </div>
                         <div id="menu2" class="container tab-pane fade"><br>
                             <h3>Menu 2</h3>
                             <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
