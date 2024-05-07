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
@section("content-header") WELCOME @endsection
@section('main-content')
<div class="order-list">
    <h2 class="text-center" style="margin-bottom: 20px;">ASSALAMU ALAIKUM</h2>
</div>
@endsection
