<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
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

                @include('livewire.product.create')

                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Name</th>
                            <th>Category Name</th>
                            <th width="150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->categ_name }}</td>

                                <td>
                                    <button wire:click="edit('{{ $product->id }}')" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal2" href="#"
                                        data-backdrop="static" data-keyboard="false">Edit</button>
                                    <button wire:click="deleteId('{{ $product->id }}')" class="btn btn-danger btn-sm"
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

