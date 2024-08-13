@include('partials.headers')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List</h3>
                <div class="card-tools">

                    <div class="margin">
                        <div class="btn-group">
                            <div class="input-group input-group-sm">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="btn-group">
                            <form action="/admin/user-add" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user-plus"></i>
                                    New
                                </button>
                            </form>
                        </div>
                    </div>
                      
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                
                
            </div>
        </div>
    </div>
</div>


@include('partials.footers')