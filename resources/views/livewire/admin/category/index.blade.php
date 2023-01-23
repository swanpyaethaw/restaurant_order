<div>
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Category List</h3>
            <a href="{{ url('admin/categories/create') }}" class="btn btn-success">Create Category</a>
        </div><hr>
    </div>

    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td width="30%">
                            <a href="{{ url("admin/categories/$category->id/edit") }}" class="btn btn-primary">Edit</a>
                            <a wire:click="destroyCategory({{ $category->id }})" class="btn btn-danger">
                                <span wire:loading.remove wire:target = "destroyCategory({{ $category->id }})">Delete</span>
                                <span wire:loading wire:target = "destroyCategory({{ $category->id }})">...Deleting</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No Category Available</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
