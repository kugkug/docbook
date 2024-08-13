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
                
                <table class="table table-hovered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Question</th>
                            <th>Order</th>
                            <th>Status</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($intakes as $intake)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $intake['code'] }}</td>
                            <td>{{ $intake['question'] }}</td>
                            <td>{{ $intake['sort_order'] }}</td>
                            <td>{{ ($intake['status'] == 1) ? "Active" : "Disabled" }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true"></button>
                                    <div class="dropdown-menu" style="position: absolute; transform: translate3d(-89px, 38px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start">
                                        <a class="dropdown-item text-info" href="/admin/view-intake">
                                            <i class="fa-regular fa-eye"></i>
                                            View
                                        </a>
                                        <a class="dropdown-item text-success" href="/admin/edit-intake">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);">
                                            <i class="fa-solid fa-ban"></i>
                                            Deactivate
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="expandable-body">
                            <td colspan="5" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th class="w-50">Answer</th>
                                                    <th class="w-10">Order</th>
                                                    <th>Next Code</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-bottom">
                                            @foreach ($intake['answers'] as $answers)
                                                <tr>
                                                    <td> {{ $answers['answer'] }} </td>
                                                    <td> {{ $answers['order'] }} </td>
                                                    <td> {{ $answers['next_question_code'] }} </td>
                                                    <td> {{ ($answers['status']) ? "Active" : "Disabled" }} </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                </div>
                            </td>
                          </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


@include('partials.footers')