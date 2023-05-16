<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"
    data-backdrop="static" data-keyboard="false">
    Create
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  wire:ignore.self>
    <div class="modal-dialog">
        @if ($updateMode)
            <input type="hidden" wire:model="id">
        @endif
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if ($updateMode)
                        Update
                    @else
                        Create
                    @endif
                </h5> Category
                <button type="button" class="btn-close" id="ssclose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ((!isset($this->cid) || empty($this->cid)) && $updateMode)
                    <div class="alert alert-success">
                        Category Doesnt exists
                    </div>
                @else
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Title" {{ $updateMode ? 'value="' . $name . '"' : 'none' }}
                                wire:model="name" wire:model.defer>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group mt-2">
                            <button type="button"
                                @if ($updateMode) wire:click.prevent="update('{{ $cid }}')"
                    @else wire:click.prevent="store()" @endif
                                class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    wire:click.prefetch="cancel()" id="categModal">Close</button>

            </div>
        </div>
    </div>
</div>
