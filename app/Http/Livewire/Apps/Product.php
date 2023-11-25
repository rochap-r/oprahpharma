<?php

namespace App\Http\Livewire\Apps;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product as Products;

class Product extends Component
{
    use WithPagination;
    public $product_name,$product_description,$unit_price,$unit_id;
    public $selected_id;

    public $perPage = 8;
    public $updateProductMode=false;

    public function mount()
    {
        $this->resetPage();
    }


    protected $listeners=[
        'resetForm',
        'deleteProductAction'
    ];

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->updateProductMode=false;
        $this->product_name=$this->product_description=$this->unit_price=$this->unit_id=null;

    }
    public function addProduct()
    {
        $this->validate([
            'product_name'=>'required|unique:products,product_name',

            'unit_price' => 'required|numeric|min:0',
            'unit_id' => 'required',
        ], [
            'product_name.required'=>'le nom du produit est obligatoire',
            'product_name.unique'=>'Ce libéllé de produit existe déjà veuillez réessayez un autre!',

            'unit_price.required' => 'Le prix d\'achat unitaire est obligatoire.',
            'unit_price.numeric' => 'Le prix d\'achat unitaire doit être un nombre.',
            'unit_price.min' => 'Le prix d\'achat unitaire ne peut pas être négatif.',

            'unit_id.required' => 'sélectionnez l\'unité de mésure.',
        ]);
        $product=new Products();
        $product->product_name=$this->product_name;
        $product->product_description=$this->product_description;
        $product->unit_price=$this->unit_price;
        $product->unit_id=$this->unit_id;
        $result=$product->save();
        if ($result){
            $this->dispatchBrowserEvent('hideProductModal');
            $this->product_name=$this->product_description=$this->unit_price=$this->unit_id=null;
            $this->showToastr('Un nouveau Produit a  été enregistré avec succès!','success');
        }else{
            $this->showToastr('Oups! Quelque chose n\'a pas bien fonctionné!','error');
        }

    }

    public function editProduct(int $id)
    {
        $product=Products::findOrFail( $id);
        $this->selected_id=$product->id;
        $this->product_name=$product->product_name;
        $this->product_description=$product->product_description;
        $this->unit_price=$product->unit_price;
        $this->unit_id=$product->unit_id;
        $this->updateProductMode=true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditProductModal');
    }

    public function updateProduct()
    {
        if ($this->selected_id){
            $this->validate([
                'product_name'=>'required|unique:products,product_name,'.$this->selected_id,
                'unit_price' => 'required|numeric|min:0',
                'unit_id' => 'required',
            ], [
                'product_name.required'=>'le nom du produit est obligatoire',
                'product_name.unique'=>'Ce produit existe déjà veuillez réessayez un autre!',

                'unit_price.required' => 'Le prix d\'achat unitaire est obligatoire.',
                'unit_price.numeric' => 'Le prix d\'achat unitaire doit être un nombre.',
                'unit_price.min' => 'Le prix d\'achat unitaire ne peut pas être négatif.',
                'unit_id.required' => 'L\'unité de mésure est obligatoire.',
            ]);

            $product=Products::findOrFail($this->selected_id);
            $product->product_name=$this->product_name;
            $product->product_description=$this->product_description;
            $product->unit_price=$this->unit_price;
            $product->unit_id=$this->unit_id;
            //$category->slug=Str::slug($this->name);
            $result=$product->save();
            if ($result){
                $this->dispatchBrowserEvent('hideProductModal');
                $this->updateProductMode=false;
                $this->product_name=$this->product_description=$this->unit_price=null;
                $this->showToastr('Le nouveau produit a bien été mis à jour!','success');
            }else{
                $this->showToastr('Oups! Quelque chose n\'a pas bien fonctionné!','error');
            }

        }
    }


    public function showToastr($message,$type){
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function deleteProductAction(int $id)
    {
        $product=Products::find($id);
        if ($product){
            $product->delete();
            $this->showToastr("le produit a été supprimé avec succès.", 'info');
        }else{
            $this->showToastr("Il est impossible de supprimer ce produit, qui est configurée par defaut.", 'error');
        }

    }

    public function deleteProduct(int $id)
    {
        $product=Products::find($id);
        $this->dispatchBrowserEvent('deleteProduct',[
            'title'=>'Etes-vous vraiment sure de supprimer ce produit?',
            'html'=>"Suppression du produit: ".$product->product_name,
            'id'=>$product->id

        ]);
    }

    public function render()
    {
        return view('livewire.apps.product',[
            'products' => Products::latest()->orderBy('id', 'asc')->withCount('orderItems', 'supplies','unit')->paginate($this->perPage),
        ]);
    }
}
