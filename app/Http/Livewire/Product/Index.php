<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $formVisible;
    public $formUpdate = false;
    public $paginate = 10;
    public $search;


    public function deletProduct($productId){

        $product = Product::find($productId);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        session()->flash('message', 'Your Product Was Deleted');
    }
    protected $listeners = [
        'formClose' => 'formCloseHandler',
        'productStored' => 'productStoredHandler',
        'productUpdated' => 'productUpdatedHandler'
    ];

    public function productUpdatedHandler(){
        $this->formVisible = false;
        session()->flash('message', 'Your Product Was Updated');

    }

    public function updateProduct($productId){
        $this->formVisible = true;
        $this->formUpdate = true;
        $product = Product::find($productId);
        $this->emit('updateProduct', $product);
    }



    public function productStoredHandler(){
        $this->formVisible = false;
        session()->flash('message', 'Your Product Was Stored');
    }
    public function formCloseHandler(){
        $this->formVisible = false;
    }

    public function render()
    {
        return view('livewire.product.index', [
            'products' => $this->search === null ?
                Product::latest()->paginate($this->paginate) :
                Product::latest()->where('title', 'like', '%' . $this->search . '%')
                    ->paginate($this->paginate)
        ]);
    }
}
