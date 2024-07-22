<?php

namespace App\Http\Livewire\Accounts;

use Livewire\Component;
use App\Models\Category;
use App\Models\Branch;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;
use App\Http\Requests\Account\PaymentRequest;

class Payment extends Component
{
    public $categories, $branches, $branch, $ledger, $amount, $narration;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function mount(){
        $this->categories = Category::all();
        $this->branches = Branch::all();
    }

    public function render()
    {
        return view('livewire.accounts.payment');
    }

    private function resetInputFields(){
        $this->ledger = '';
        $this->amount = '';
        $this->narration = '';
    }

    public function store(ReceiptRequest $request){
      
    }
    
}
