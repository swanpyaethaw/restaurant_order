<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Table</h5>
            <button type="button" wire:click="resetInput" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="addTable">
                <div class="modal-body">
                    <label for="table_no">Table No</label>
                    <input type="text" wire:model.defer="table_no" class="form-control">
                    @error('table_no')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                <button type="button" wire:click="resetInput" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editTableModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Table</h5>
            <button type="button" wire:click="resetInput" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateTable">
                    <div class="modal-body">
                        <label for="table_no">Table No</label>
                        <input type="text" wire:model.defer="table_no" class="form-control">
                        @error('table_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                    <button type="button" wire:click="resetInput" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>



        </div>
        </div>
    </div>




    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Tables List</h3>
            <a  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tableModal">Create Table</a>
        </div><hr>
    </div>

    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Table No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tables as $table)
                    <tr>
                        <td>{{ $table->id }}</td>
                        <td>{{ $table->table_no }}</td>
                        <td width="30%">
                            <a class="btn btn-warning" wire:click="editTable({{ $table->id }})" data-bs-toggle="modal" data-bs-target="#editTableModal">Edit</a>
                            <a class="btn btn-danger"  wire:click="deleteTable({{ $table->id }})">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No Table Available</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        {{ $tables->links() }}
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
               $('#tableModal').modal('hide')
               $('#editTableModal').modal('hide')
        })
    </script>

@endpush
