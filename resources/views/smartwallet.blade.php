@extends('layouts.layout')
@section('content')




<style>
    * {
        box-sizing: border-box;
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
  
        background:#51B56D !important;
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
<br>
<div class="card bg-c-lite-green update-card w-25 mx-auto">
    <div class="card-block">
        <div class="row align-items-end">
            <div class="col-8">
                <h5 class="text-white text-center">Welcome , {{$user->name}}</h5>
            </div>
            <div class="col-4 text-right"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                <canvas id="update-chart-4" height="50" width="52" style="display: block; width: 52px; height: 50px;"></canvas>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Account Number : {{$user->account_number}}</p>
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>National : {{$user->national_id}}</p>
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>City : {{$user->city}}</p>
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Deposite : {{$user->deposite}}</p>
    </div>
</div>

<br>

@if(count($transactions)>0)
<div class="row">

    <div class="column">
        <table class="table">
            <h5 class="text-center" style="color:#51B56D;">Last Transaction</h5>
            <thead>
                <tr>
                    <th style="color:black;" scope="col">#</th>
                    <th style="color:black;" scope="col">Account Number</th>
                    <th style="color:black;" scope="col">Process Type</th>
                    <th style="color:black;" scope="col">Receive Account</th>
                    <th style="color:black;" scope="col">time at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <th style="color:black;" scope="row">{{ $loop->iteration }}</th>
                    <td style="color:black;">{{$transaction->account_no}}</td>
                    <td style="color:black;">{{$transaction->process_type}}</td>
                    <td style="color:black;">{{$transaction->receive_account}}</td>
                    <td style="color:black;">{{$transaction->created_at}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($user->type==2)
    <div class="column">

        <table class="table ">
            <h5 class="text-center" style="color:#51B56D;">your children</h5>
            <thead>
                <tr>
                    <th style="color:black;" scope="col">#</th>
                    <th style="color:black;" scope="col">child name</th>
                    <th style="color:black;" scope="col">child email</th>
                    <th style="color:black;" scope="col">child account</th>
                    <th style="color:black;" scope="col">time at</th>
                    <th style="color:black;" scope="col">child detail</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($children_account as $child_account)
                <tr>
                    <th style="color:black;" scope="row">{{ $loop->iteration }}</th>
                    <td style="color:black;">{{$child_account->name}}</td>
                    <td style="color:black;">{{$child_account->email}}</td>
                    <td style="color:black;">{{$child_account->account_number}}</td>
                    <td style="color:black;">{{$child_account->created_at}}</td>
                    <td><a class="btn btn-info me-3" style="width: 50px; padding: 3px;" href="{{ route('child.show', $child_account)}}">details</a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
       

        
    </div>
    @endif
</div>
@else

<h3 class="text-center" style="color: black;">no transactions</h3>
@endif



@endsection