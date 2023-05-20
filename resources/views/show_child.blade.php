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
<br>
<div class="card bg-c-lite-green update-card w-25 mx-auto">
    <div class="card-block">
        <div class="row align-items-end">
            <div class="col-8">
                <h5 class="text-white text-center">name , {{$child->name}}</h5>
            </div>
            <div class="col-4 text-right"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                <canvas id="update-chart-4" height="50" width="52" style="display: block; width: 52px; height: 50px;"></canvas>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Account Number : {{$child->account_number}}</p>
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>National : {{$child->national_id}}</p>
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>City : {{$child->city}}</p>
        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Deposite : {{$child->deposite}}</p>
    </div>
</div>

<br>

@if(count($child_transactions)>0)
        <table class="table w-50 mx-auto">
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
                @foreach($child_transactions as $child_transaction)
                <tr>
                    <th style="color:black;" scope="row">{{ $loop->iteration }}</th>
                    <td style="color:black;">{{$child_transaction->account_no}}</td>
                    <td style="color:black;">{{$child_transaction->process_type}}</td>
                    <td style="color:black;">{{$child_transaction->receive_account}}</td>
                    <td style="color:black;">{{$child_transaction->created_at}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @else

<h3 class="text-center" style="color: black;">your child haven't transactions</h3>
@endif
    </div>
    




@endsection