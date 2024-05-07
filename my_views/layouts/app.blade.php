<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Job</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('page-css')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h2 class="sidebar-heading">Menu</h2>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link menu-item" href="{{route('home')}}">Dashboard</a></li>
                    <li class="nav-item">
                        <a class="nav-link menu-item" href="{{route('productEntry')}}">Product Entry</a>
                    </li>
                    <li class="nav-item"><a class="nav-link menu-item" href="{{route('pointOfSale')}}">Pos</a></li>
                    <li class="nav-item"><a class="nav-link menu-item" href="{{route('orderList')}}">Order List</a></li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <div class="header">
                    @yield("content-header")
                    <button class="logout-btn float-right" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
                </div>
                <div>
                    @if(session('successMessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{session('successMessage')}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @if(session('dangerMessage'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>{{session('dangerMessage')}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @yield("main-content")
                </div>
            </div>
        </div>
    </div>
    <div>
        @yield("page-js")
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    <footer class="footer">
        <div class="container">
            &copy; 2024 Point of Sale
        </div>
    </footer>
</body>
</html>