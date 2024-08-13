@include('partials.headers')

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-clipboard-user"></i>
                    Account Information
                </h3>
            </div>

            <form action="/execute/user-add" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control " placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control " placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control " placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control " placeholder="Confirm Password">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-hard-drive"></i>
                            Update
                        </button>

                        <a href="/admin/users" class="btn btn-danger">
                            <i class="fa-solid fa-rotate-left"></i>
                            Back To List
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


@include('partials.footers')