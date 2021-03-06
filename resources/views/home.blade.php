@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="container">
        @if(Auth::user()->typeof=="student")

        <profile-component> <profile-component>

        @endif
      </div>
        @if(Auth::user()->typeof =='s_affairs')
        <student-affairs></student-affairs>
        @endif
        @if(Auth::user()->typeof =='security')
        <security-component></security-component>
        @endif
        @if(Auth::user()->typeof =='alumni')
        <alumni-component></alumni-component>
        @endif
        @if(Auth::user()->typeof =='library')
        <library-component></library-component>
        @endif
        @if(Auth::user()->typeof =='audit')
        <audit-component></audit-component>
        @endif
        @if(Auth::user()->typeof =='faculty')
        <faculty-component></faculty-component>
        @endif
    </div>
    @if(Auth::user()->typeof=="student")
    <!-- Button trigger modal -->
    <hr>
  <div class="container">
    <div class="container">
      <div class="col-md-4 offset-md-4">
        <!-- <div class="row"> -->
          <h4 class="text-center">Complete Payment</h4>
          <span class=" ml-4 mt-2 mr-2">
            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#alumni">
              Pay Alumni Fee
            </a>
          </span>
          <span class=" mt-3">
            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#convoc">
              Pay Convocation Fee
            </a>
          </span>
        <!-- </div> -->
      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="alumni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alumni Payment Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="{{ route('pay') }}" method="post">
          @csrf
          <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
          <input type="hidden" name="orderID" value="345">
          <input type="hidden" name="amount" value="65000"> {{-- required in kobo --}}
          <input type="hidden" name="quantity" value="3">
          <?php
          $reg_no =Auth::user()->reg_no;
          $phone = Auth::user()->phone;
          $fullname=Auth::user()->name;
          $type= 'alumni';
  $array = [ 'custom_fields' => [
     ['display_name' => "Registration Number", "variable_name" => "reg_no", "value" => "$reg_no"],
     ['display_name' => "Phone", "variable_name" => "phone", "value" => "$phone"],
     ['display_name'=>"Fullname", "variable_name"=>"student_name", "value"=>"$fullname"],
     ['display_name'=>"Type", "variable_name"=>"Type", "value"=>"$type"]
          ]
      ]
   ?>
          <input type="hidden" name="metadata" value="{{ json_encode($array = [
            'reg_no' => "$reg_no",'phone'=>"$phone",
          'student_name' => "$fullname",'type' => "$type"]) }}" >
<input type="hidden" name="key" value="{{ config('paystack.publicKey') }}"> {{-- required --}}
          <input type="text" name="" value="" placeholder="Your RRR Goes Here" class="form-control">
          <input type="submit" value="Pay Now">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="convoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Convocation Payment Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="{{ route('pay') }}" method="post">
          @csrf
          <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
          <input type="hidden" name="orderID" value="345">
          <input type="hidden" name="amount" value="1000000"> {{-- required in kobo --}}
          <input type="hidden" name="quantity" value="3">
          <?php
          $reg_no =Auth::user()->reg_no;
          $phone = Auth::user()->phone;
          $fullname=Auth::user()->name;
          $type= 'convocation';
  $array = [ 'custom_fields' => [
     ['display_name' => "Registration Number", "variable_name" => "reg_no", "value" => "$reg_no"],
     ['display_name' => "Phone", "variable_name" => "phone", "value" => "$phone"],
     ['display_name'=>"Fullname", "variable_name"=>"student_name", "value"=>"$fullname"],
     ['display_name'=>"Type", "variable_name"=>"Type", "value"=>"$type"]
          ]
      ]
   ?>
          <input type="hidden" name="metadata" value="{{ json_encode($array = [
            'reg_no' => "$reg_no",'phone'=>"$phone",
          'student_name' => "$fullname",'type' => "$type"]) }}" >

          <input type="hidden" name="key" value="{{ config('paystack.publicKey') }}"> {{-- required --}}
          <input type="text" name="" value="" placeholder="Your RRR Goes Here" class="form-control">
          <input type="submit" value="Pay Now">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    @endif
</div>
@endsection
