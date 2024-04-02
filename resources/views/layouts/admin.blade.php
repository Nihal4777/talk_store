
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Bar</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="navigation">
        <ul>
            <li class="list active">
                <a href="./index.html">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title">Add script</span>
                </a>
            </li>
            <li class="list">
                <a href="./manage-scripts.html">
                    <span class="icon"><ion-icon name="chatbubbles-outline"></ion-icon></span>
                    <span class="title">Manage Scripts</span>
                </a>
            </li>
            <li class="list">
                <a href="./manage-subscription.html">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="title">Manage Subscription</span>
                </a>
            </li>
            <li class="list">
                <a href="./manage-users.html">
                    <span class="icon"><ion-icon name="chatbubbles-outline"></ion-icon></span>
                    <span class="title">Manage Users</span>
                </a>
            </li>
            <!-- <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                    <span class="title">Setting</span>
                </a> -->
            <!--    </li> <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
                    <span class="title">Help</span>
                </a>
            </li> <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <span class="title">Password</span>
                </a>
            </li> <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="title">Sign Out</span>
                </a>
            </li> -->
        </ul>
    </div>
    <div class="workspace">
        <div class="heading">
            Add Script
        </div>
        <!-- <div class="d-flex flex-column my-5 flex-wrap"> -->

        <div class="row mb-3">
            <div class="col-md-6 col-12">
                <select class="form-control">
                    <option value="default" selected disabled>--Select Category--</option>
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                </select>
            </div>
            <div class="col-md-6 col-12">
                <input type="text" name="" class="form-control" placeholder="Add title of the script" id="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 col-12">
                <input type="text" class="form-control" placeholder="Person 1 name" name="" id="">
            </div>
            <div class="col-md-3 col-12">
                <input type="text" class="form-control" placeholder="Person 2 name" name="" id="">
            </div>
            <div class="form-group col-md-6 col-12">

                <textarea class="form-control" id="" placeholder="Enter script"></textarea>
            </div>
        </div>


        <!-- </div> -->
        <div>
            <div class="btn btn-warning font-weight-bold">Add Script</div>
        </div>
        <div class="mt-5">
            <table class="table table-hover">

                <tbody>
                    <tr>
                        <th scope="row">Person 1</th>
                        <td>Dialogue 1</td>
                        <td data-toggle="modal" data-target="#scriptEditModal" data-bs-target="#staticBackdrop">
                            <div class="btn btn-success">Edit</div>
                        </td>
                        <td>
                            <div class="btn btn-danger">Delete</div>
                        </td>

                    </tr>
                    <tr>
                        <th scope="row">Person 2</th>
                        <td>Dialogue 2</td>

                        <td data-toggle="modal" data-target="#scriptEditModal" data-bs-target="#staticBackdrop">
                            <div class="btn btn-success">Edit</div>
                        </td>
                        <td>
                            <div class="btn btn-danger">Delete</div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"> Person 3</th>
                        <td> Dialogue 3</td>
                        <td data-toggle="modal" data-target="#scriptEditModal" data-bs-target="#staticBackdrop">
                            <div class="btn btn-success">Edit</div>
                        </td>
                        <td>
                            <div class="btn btn-danger">Delete</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Edit Dialouge Modal -->
    <div class="modal fade" id="scriptEditModal" tabindex="-1" role="dialog" aria-labelledby="scriptEditModal"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Dialogue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="mb-3">
                            <select class="form-control">
                                <option value="default" selected disabled>--Select Role--</option>
                                <option value="1">Person One</option>
                                <option value="2">Person Two</option>
                            </select>

                        </div>
                        <div>
                            <div class="form-group">
                                <textarea class="form-control" id="" placeholder="Enter script" rows="3"
                                    cols="50"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update Dialogue</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Dialouge Modal -->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>