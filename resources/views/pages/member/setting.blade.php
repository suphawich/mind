@extends('layouts.app')

@push('style')
<style>
    .option {
        font-size: 15px;
    }
    .option-column {
        padding-top: 2px !important;
        padding-bottom: 2px !important;
    }
    .recommented {
        font-size: 12px;
        color: #7FC0F4;
    }
    .btn-sub {
        font-size: 12px;
        padding: 3px 5px 3px 5px !important;
        margin-right: 7px;
        color: #B18862;
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
                            <a class="nav-link active" data-toggle="tab" href="#furniture">Items</a>
                        </li>
                        <li class="nav-item" style="display:none;">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Display</a>
                        </li>
                        <li class="nav-item" style="display:none;">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Account</a>
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
                                     <div class="col-md-5 option">
                                         <div class="row">
                                             <table class="table table-striped table-bordered table-sm mb-1">
                                                 <tbody>
                                                     @foreach ($options as $option)
                                                         <tr>
                                                             @if (!$option)
                                                                 <td><input type="checkbox" value="" disabled></td>
                                                                 <td class="recommented">{{ __('<No option, please add more option.>') }}</td>
                                                             @else
                                                                 @if ($option->status)
                                                                     <td><input type="checkbox" name="options[]" value="{{ $option->id }}" checked></td>
                                                                 @else
                                                                     <td><input type="checkbox" name="options[]" value="{{ $option->id }}"></td>
                                                                 @endif
                                                                 <td>{{ $option->name }}</td>
                                                             @endif
                                                         </tr>
                                                     @endforeach
                                                 </tbody>
                                             </table>
                                         </div>
                                         <div class="row float-right">
                                             <button type="button" name="add_option" class="btn btn-sub" data-toggle="modal" data-target="#modalAddOption"><i class="fa fa-plus"></i></button>
                                             <button type="button" name="add_option" class="btn btn-sub" data-toggle="modal" data-target="#modalDeleteOption"><i class="fa fa-minus"></i></button>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group row float-right">
                                     <input type="submit" class="btn btn-success mr-2" name="submit" value="Apply">
                                 </div>
                             </form>
                         </div>
                         <div id="menu1" class="container tab-pane fade"><br>
                             <h3>Display</h3>
                             <p></p>
                         </div>
                         <div id="menu2" class="container tab-pane fade"><br>
                             <h3>Account</h3>
                             <p></p>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalAddOption">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New option</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="" action="/setting_item_option_check" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name option') }}</label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="setting_item_id" value="{{ $setting->id }}">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDeleteOption">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New option</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="" action="/setting_item_option_check" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="form-group row">
                                    <label for="option_id" class="col-md-4 col-form-label text-md-right">{{ __('Option') }}</label>
                                    <div class="col-md-6">
                                        <select name="option_id">
                                            @foreach ($options as $option)
                                                @if ($option != false)
                                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit" onClick="return confirm('Do you want to delete this option ?');">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
