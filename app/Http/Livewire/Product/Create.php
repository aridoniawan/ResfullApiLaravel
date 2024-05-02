<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $image;

    public function store(){
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'numeric',
            'image' => 'max:4096'
        ]);

        $imageName = '';
        if($this->image){
            $imageName = \Str::slug($this->title, '-')
                . '-'
                . uniqid()
                . '.' . $this->image->getClientOriginalExtension();
        
            $this->image->storeAs('public', $imageName, 'local');
        }

        $userId = Auth::id();

        Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $imageName,
            'user_id' => $userId
        ]);

        $this->emit('productStored');
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
