@extends('layouts.app')
@section("page-css")
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }
    .header {
        background-color: #1976D2;
        color: #fff;
        padding: 20px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
    }
    .sidebar {
        background-color: #263238;
        color: #fff;
        padding-top: 20px;
    }
    .sidebar-heading {
        padding: 10px 20px;
    }
    .logout-btn {
        color: #fff;
        border: none;
        background: none;
        font-size: 16px;
        cursor: pointer;
    }
    .logout-btn:hover {
        text-decoration: underline;
    }
    .menu-item {
        padding: 10px 20px;
        color: #fff;
        transition: background-color 0.3s ease;
    }
    .menu-item:hover {
        background-color: #37474F;
    }
    .content {
        padding: 20px;
        min-height: calc(100vh - 80px); /* Adjust for footer height */
    }
    .order-list {
        background-color: #fff;
        border: 2px solid #c5e1a5;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .order-summary-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .order-summary-table th,
    .order-summary-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .order-summary-table th {
        background-color: #f2f2f2;
    }
    .footer {
        background-color: #1976D2;
        color: #fff;
        text-align: center;
        padding: 10px 0;
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    /* Responsive styles for order summary table */
    @media (max-width: 768px) {
        .order-summary-table {
            font-size: 14px;
        }
        .order-summary-table th,
        .order-summary-table td {
            padding: 5px;
        }
    }
</style>
@endsection
@section("content-header") Order List @endsection
@section('main-content')
<div class="order-list">
    <h2 style="margin-bottom: 20px;">Order Summary</h2>
    <form class="form-inline" method="get">
      <label for="email">From Date: &nbsp;&nbsp; </label>
      <input type="date" class="form-control" name="from_date" required value="{{$fromDate}}">
      <label for="pwd">&nbsp;&nbsp;To Date: &nbsp;&nbsp; </label>
      <input type="date" class="form-control" name="to_date" required value="{{$toDate}}" >
      &nbsp;&nbsp;<button type="submit" class="btn btn-primary">Search</button>
    </form>
    @if($fromDate and $toDate)
    <a class="btn btn-sm btn-primary" href="{{route('orderList')}}">Show All</a>
    @endif
    <div class="table-responsive">
        <table class="order-summary-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Total Items</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($orderList as $order)
               <tr>
                   <td>#{{$order->id}}</td>
                   <td>{{$order->customerInfo->name}}</td>
                   <td>{{$order->order_date}}</td>
                   <td>{{$order->total_items}}</td>
                   <td>{{$order->total_amount}}</td>
                   <td>
                        <a href="{{route('viewOrder',$order->id)}}">Details</a> 
                    </td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section("page-js")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection