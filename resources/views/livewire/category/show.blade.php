<div class="container">
    <div class="row">
        <div class="col-md-12">

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" data-bs-dismiss="modal" wire:click.self="delete()"
                                class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif


                @include('livewire.category.create')

                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Name</th>
                            <th width="150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <button wire:click="edit('{{ $category->id }}')" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"
                                        data-backdrop="static" data-keyboard="false">Edit</button>
                                    <button wire:click="deleteId('{{ $category->id }}')" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

