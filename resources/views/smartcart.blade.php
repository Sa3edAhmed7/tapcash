@extends('layouts.layout')
@section('content')


<style>
  * {
    box-sizing: border-box;
  }

  .rounded {
    border-radius: .25rem !important
  }


  .row {
    display: flex;
  }

  .column {
    flex: 50%;
    padding: 5px;
  }

  .update-card {
    color: #fff;
  }

  .bg-c-lite-green {

    background: #51B56D !important;
  }

  .card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px;
  }

  .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
  }
</style>

<div class="modal applyModal fade" id="apply" tabindex="-1" aria-labelledby="applyLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h4 class="modal-title" id="exampleModalLabel">Tranfer</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('smartcart.store')}}">
          @csrf
          <div class="col-lg-6 mb-4 pb-2">
            <div class="form-group">
              <label for="process_type" class="form-label">Amount</label>
              <input type="number" class="form-control shadow-none" name="amount_money" id="process_type" placeholder="ex: 25000">
              <!-- <input type="hidden" name="amount_money" > -->
            </div>
          </div>
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary w-100">Make cart</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal applyModal fade" id="inc_money" tabindex="-1" aria-labelledby="incLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h4 class="modal-title" id="exampleModalLabel">Increase Your Cart Money</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('smartcart.inc_money')}}">
          @csrf
          <div class="col-lg-6 mb-4 pb-2">
            <div class="form-group">
              <label for="process_type" class="form-label">Amount</label>
              <input type="number" class="form-control shadow-none" name="inc_money" id="inc_money" placeholder="ex: 25000">
            </div>
          </div>
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary w-100">Increase Your Cart Money</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal applyModal fade" id="dec_money" tabindex="-1" aria-labelledby="incLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h4 class="modal-title" id="exampleModalLabel">decrease Your Cart Money</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('smartcart.dec_money')}}">
          @csrf
          <div class="col-lg-6 mb-4 pb-2">
            <div class="form-group">
              <label for="process_type" class="form-label">Amount</label>
              <input type="number" class="form-control shadow-none" name="dec_money" id="dec_money" placeholder="ex: 25000">
            </div>
          </div>
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary w-100">decrease Your Cart Money</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal buyModal fade" id="buy" tabindex="-1" aria-labelledby="buyLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h4 class="modal-title" id="exampleModalLabel">buy</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('purchases.store')}}">
          @csrf
          <div class="col-lg-12 mb-4 pb-2">
            <div class="form-group">
              <label for="receive_account" class="form-label">buy a</label>
              <input type="text" class="form-control shadow-none" name="purchase_name" id="receive_account">
            </div>
          </div>
          <br>
          <div class="col-lg-6 mb-4 pb-2">
            <div class="form-group">
              <label for="process_type" class="form-label">Amount</label>
              <input type="number" class="form-control shadow-none" name="amount_money" id="process_type" placeholder="ex: 25000">
              <!-- <input type="hidden" name="amount_money" > -->
            </div>
          </div>
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary w-100">Buy</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@if($check_smartcart)
<br>
<div class="card bg-c-lite-green update-card w-25 mx-auto">
  <div class="card-block">
    <div class="row align-items-end">
      <div class="row" style="padding-top: 20px; padding-left: 30px;">
        <div class="col" >
          <h5 class="text-white">Balance : {{$check_smartcart->deposite}} </h5>
        </div>
        <div class="col" style="margin-left: 50px;">
          <a style="background-color: #9dd895; width: 60px; padding: 0px; " type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#inc_money">+</a>
          <a style="background-color: #9dd895; width: 60px; padding: 0px; " type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#dec_money">-</a>
        </div>
      </div>
     
    </div>
  </div>
  <div class="card-footer">
    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Cart Number : {{$check_smartcart->Cart_number}}</p>
    <!-- <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>National : {{$check_smartcart->Cart_number}}</p> -->
  </div>
</div>
<!-- <div class="py-3 d-flex align-items-center justify-content-center">
  <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#inc_money">increase Cart Balance </a>
</div> -->


@if(session('success')!= null)
<div class="alert alert-success text-center"><strong>{{session('success')}}</strong></div>
<br>
@endif
@else
<div class="py-5 d-flex align-items-center justify-content-center">
  <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#apply">Make Cart </a>
</div>
@endif




<div class="container rounded" style="background-color: #9dd895  ; height: 70px; width: 450px;">
  <div class="row">
    <div class="col">
      <img class=" rounded" src="{{asset('assets/images/btech.png')}}" style="width: 100px;height: 60px; margin-top: 5px;" alt="">
      <a type="button" href="#" data-bs-toggle="modal" data-bs-target="#buy" style="color:#4C3D3D; font-size: 20px; margin-left: 190px;">buy now <span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span></a>
    </div>

  </div>
</div>
<br>
<br>
<div class="container rounded" style="background-color: #9dd895; height: 70px; width: 450px;">
  <div class="row">
    <div class="col">
      <img class="rounded" src="{{asset('assets/images/amazon.png')}}" style="width: 100px;height: 60px; margin-top: 5px;" alt="">
      <a type="button" href="#" data-bs-toggle="modal" data-bs-target="#buy" style="color:#4C3D3D; font-size: 20px; margin-left: 190px;">buy now <span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span></a>

    </div>
  </div>
</div>
<br>
<br>

<div class="container rounded" style="background-color: #9dd895; height: 70px; width: 450px;">
  <div class="row">
    <div class="col">
      <img class="rounded" src="{{asset('assets/images/carrefour.png')}}" style="width: 100px;height: 60px; margin-top: 5px;" alt="">
      <a type="button" href="#" data-bs-toggle="modal" data-bs-target="#buy" style="color:#4C3D3D; font-size: 20px; margin-left: 190px;">buy now <span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span></a>

    </div>
  </div>
</div>
<br>
<br>

<div class="container rounded" style="background-color: #9dd895; height: 70px; width: 450px;">
  <div class="row">
    <div class="col">
      <img class="rounded" src="{{asset('assets/images/vezeeta.jpg')}}" style="width: 100px;height: 60px; margin-top: 5px;" alt="">
      <a type="button" href="#" data-bs-toggle="modal" data-bs-target="#buy" style="color:#4C3D3D; font-size: 20px; margin-left: 190px;">buy now <span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span></a>
    </div>

  </div>
</div>
<br>
<br>










@endsection