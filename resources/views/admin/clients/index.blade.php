@include('partials.headers')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->title }}</td>
                            <td>{{ $client->firstname }}</td>
                            <td>{{ $client->lastname }}</td>
                            <td>{{ $client->gender }}</td>
                            <td>{{ $client->contact_number }}</td>
                            <td>{{ $client->email }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true"></button>
                                    <div class="dropdown-menu" style="position: absolute; transform: translate3d(-89px, 38px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start">
                                        <a class="dropdown-item text-info" href="/admin/view-client">
                                            <i class="fa-solid fa-users-viewfinder"></i>
                                            View
                                        </a>
                                        <a class="dropdown-item text-success" href="/admin/edit-client">
                                            <i class="fa-solid fa-user-pen"></i>
                                            Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="/admin/remove-client">
                                            <i class="fa-solid fa-user-slash"></i>
                                            Remove
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $clients->links()}}
            </div>
        </div>
    </div>
</div>


@include('partials.footers')