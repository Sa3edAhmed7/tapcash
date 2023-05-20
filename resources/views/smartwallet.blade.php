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


<div class="modal applyModal fade" id="sendmoney" tabindex="-1" aria-labelledby="applyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="exampleModalLabel">Tranfer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('money_transaction.store')}}">
                    @csrf
                    <div class="col-lg-12 mb-4 pb-2">
                        <div class="form-group">
                            <!-- <p id="receive_account">omar</p> -->
                            <label for="" class="form-label">Your child Account</label>
                            <input type="text" class="form-control shadow-none" name="receive_account" id="receive_account">
                            <br>
                            <!-- <p style="margin-left: 17px; color: black;"  name="accountnumber" id="receive_account"></p> -->


                            <input type="hidden" name="process_name" value="transfer to my child">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 pb-2">
                        <div class="form-group">
                            <label for="process_type" class="form-label">Amount</label>
                            <input type="number" class="form-control shadow-none" name="process_type" id="process_type" placeholder="ex: 25000">
                            <input type="hidden" name="process_name" value="transfer">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary w-100">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


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


<div class="row">

    <div class="column">
        @if(count($transactions)>0)
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
        @else

        <h3 class="text-center" style="color: black;">no transactions</h3>
        @endif
    </div>


    <div class="column">
        @if($user->type==2 && count($children_account)>0)

        <table class="table ">
            <h5 class="text-center" style="color:#51B56D;">your children</h5>
            <thead>
                <tr>
                    <th style="color:black;" scope="col">#</th>
                    <th style="color:black;" scope="col">child_name</th>
                    <th style="color:black;" scope="col">child_account</th>
                    <th style="color:black;" scope="col">send_money</th>
                    <th style="color:black;" scope="col">child_detail</th>
                    <th style="color:black;" scope="col">time at</th>


                </tr>
            </thead>
            <tbody>
                @foreach($children_account as $child_account)
                <tr>
                    <th style="color:black;" scope="row">{{ $loop->iteration }}</th>
                    <td style="color:black;">{{$child_account->name}}</td>
                    <td style="color:black;">{{$child_account->account_number}}</td>
                    <td>
                        <a type="button" style="width: 60px; padding: 3px;"onclick="getText({{$child_account->account_number}})" value="{{$child_account->account_number}}" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#sendmoney">Send</a>
                    </td>


                    <td>
                        <a type="button" style="width: 70px; padding: 3px;" class="btn btn-primary" href="{{ route('child.show', $child_account)}}">details</a>
                    </td>
                    <td style="color:black;">{{$child_account->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


        @elseif($user->type==2||$user->type==1 )

        <h3 class="text-center" style="color: black;">no childeren</h3>
        @endif
    </div>
    @if(session('success')!= null)
    <div class="alert alert-success">
        <h3><strong>{{session('success')}}</strong></h3>
    </div>
    <br>
    @endif
</div>

<script>
    function getText(accountnumber) {
        document.getElementById("receive_account").innerHTML = accountnumber;
       
       
    }
</script>



@endsection