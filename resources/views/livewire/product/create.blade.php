<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" href="#"
    data-backdrop="static" data-keyboard="false">
    Create
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
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
                </h5> Products
                <button type="button" class="btn-close" id="ssclose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ((!isset($this->pid) || empty($this->pid)) && $updateMode)
                    <div class="alert alert-success">
                        Product Doesnt exists
                    </div>
                @else
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name:</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Enter Title" {{ $updateMode ? 'value="' . $name . '"' : 'none' }}
                                wire:model="name" wire:model.defer autocomplete="off">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Categories:</label>
                            <select wire:model="category_id" name="category_id" id="category_id" class="form-control"
                                wire:model.defer>
                                <option value="" wire:key="">Select Categories</option>
                                @foreach ($categories as $g)
                                    <option value="{{ $g->id }}" wire:key="{{ $g->id }}"
                                        {{ $this->category_id == $g->id ? ' selected' : '' }}>
                                        {{ $g->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">

                            <button type="button"
                                @if ($updateMode) wire:click.prevent="update('{{ $pid }}')"
                        @else wire:click.prevent="store()" @endif
                                class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    wire:click.prevent="cancel()" id="categModal">Close</button>

            </div>
        </div>
    </div>
</div>
