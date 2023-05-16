<?php

namespace App\Http\Livewire;

use App\Models\Categories;
use App\Models\Products as ModelsProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Products extends Component
{
    public $products, $name, $pid, $category_id, $categories, $deleteId;
    public $updateMode = false;

    public function render()
    {
        $this->categories = Categories::where("user_id", Auth::user()->id)->whereNull("deleted_at")->get();

        $this->products  = ModelsProducts::join("categories", "categories.id", "=", "category_id")->where("categories.user_id", Auth::user()->id)->whereNull("products.deleted_at")->whereNull('categories.deleted_at')->select(["products.*", "categories.name as categ_name"])->get();
        return view('livewire.product.show');
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
            'category_id' => 'required|exists:categories,id'
        ]);

        $validatedDate["user_id"] = Auth::user()->id;
        ModelsProducts::create($validatedDate);

        session()->flash('message', 'Product created successfully.');

        $this->resetInputFields();
        $this->dispatchBrowserEvent('Inserted');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->category_id = '';
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $this->updateMode = true;

        $categ = ModelsProducts::where("id", $id)->first();
        if (empty($categ)) {
            session()->flash('message', 'Product Doesnt Exists.');
            return false;
        }
        $this->pid = $id;
        $this->name = $categ->name;
        $this->category_id = $categ->category_id;
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
            'name' => 'required|unique:products,name,' . $id,
            'category_id' => 'required|exists:categories,id'
        ]);

        $post = ModelsProducts::find($this->pid);
        $post->update([
            'name' => $this->name,
            'category_id' => $this->category_id
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Product Updated Successfully.');
        $this->dispatchBrowserEvent('Inserted');

        $this->resetInputFields();
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete()
    {

        ModelsProducts::find($this->deleteId)->delete();
        session()->flash('message', 'Product deleted successfully.');
    }
}
