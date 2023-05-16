<?php

namespace App\Http\Livewire;

use App\Models\Categories as ModelsCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Categories extends Component
{

    public $categories, $name, $cid, $deleteId;
    public $updateMode = false;

    public function render()
    {
        $this->categories  = ModelsCategories::where("user_id", Auth::user()->id)->whereNull("deleted_at")->get();
        return view('livewire.category.show');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store(Request $request)
    {
        $validatedDate = $this->validate([
            'name' => 'required',
        ]);

        $validatedDate["user_id"] = Auth::user()->id;
        ModelsCategories::create($validatedDate);

        session()->flash('message', 'Post Created Successfully.');
        $this->dispatchBrowserEvent('Inserted');

        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->name = '';
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function edit($id)
    {
        $this->updateMode = true;
        $categ = ModelsCategories::where("id", $id)->first();
        if (empty($categ)) {
            session()->flash('message', 'Category Doesnt Exists.');
            return false;
        }
        $this->cid = $id;
        $this->name = $categ->name;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update($id)
    {
        $validatedDate = $this->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $post = ModelsCategories::find($this->cid);
        $post->update([
            'name' => $this->name,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Category Updated Successfully.');
        $this->resetInputFields();
        $this->dispatchBrowserEvent('Inserted');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete()
    {
        ModelsCategories::find($this->deleteId)->delete();
        session()->flash('message', 'Category deleted successfully.');
    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }
}
