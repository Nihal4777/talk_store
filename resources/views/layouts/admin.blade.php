<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} - Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>


    @role('admin')
        <div class="navigation" id="sideBar">
            <ul>
                <li class="list {{ Request::segment(2) == 'categories' ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Categories</span>
                    </a>
                </li>
                <li class="list {{ Request::segment(2) == 'talks' && Request::segment(3) == '' ? 'active' : '' }}">
                    <a href="{{ route('talks.index') }}">
                        <span class="icon"><ion-icon name="chatbubbles-outline"></ion-icon></span>
                        <span class="title">View Scripts</span>
                    </a>
                </li>
                <li class="list {{ Request::segment(3) == 'create' ? 'active' : '' }}">
                    <a href="{{ route('talks.create') }}">
                        <span class="icon"><ion-icon name="chatbubbles-outline"></ion-icon></span>
                        <span class="title">Add Scripts</span>
                    </a>
                </li>
                <li class="list {{ Request::segment(2) == 'experts' ? 'active' : '' }}">
                    <a href="/admin/experts">
                        <span class="icon"><ion-icon name="cash-outline"></ion-icon></span>
                        <span class="title">Manage experts</span>
                    </a>    
                </li>
                <li class="list {{ Request::segment(2) == 'purchases' ? 'active' : '' }}">
                    <a href="/admin/purchases/talks">
                        <span class="icon"><ion-icon name="cash-outline"></ion-icon></span>
                        <span class="title">Talk Purchases Scripts</span>
                    </a>
                </li>
               
                <li class="list">
                    <a href="{{ route('logout') }}">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    @endrole
    @role('expert')
        <div class="navigation" id="sideBar">
            <ul>
                <li class="list {{ Request::segment(2) == 'liveChat' ? 'active' : '' }}">
                    <a href="/expert/liveChat">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Live Chat Support</span>
                    </a>
                </li>

                <li class="list">
                    <a href="{{ route('logout') }}">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    @endrole



    <div>
        <button id="toggleSideBar" class="btn btn-secondary" style="position:relative; margin-left: 20px;"
            onclick="sideNavResponsive()">
            <i class="bi bi-list text-white"></i>
        </button>
    </div>

    <div class="workspace">
        {{ $slot }}
        @if (Session::has('success'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast show fade bg-success" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header bg-success">
                        <strong class="me-auto text-white fw-bold">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-white">
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
                <div id="liveToast" class="toast fade show bg-danger" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header bg-danger">
                        <strong class="me-auto text-white fw-bold">Failure</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-white">
                        <p>{{ $error }}</p>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
</body>

</html>
