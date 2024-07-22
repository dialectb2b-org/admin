<?php

namespace App\Http\Livewire\Accounts;

use Livewire\Component;
use App\Models\Ledger;
use App\Models\Branch;
use App\Models\Currency;
use App\Models\Company;
use App\Models\Voucher;

use App\Http\Livewire\Field;

class Receipt extends Component
{
    public $ledgers, $modes, $branches, $currencies, $ledger_id, $mode_id, $branch_id, $currency_id, $amount, $narration, $date, $voucher_no, $remarks, $main_narration;
    public $updateMode = false;
    public $inputs = [];
    public $i = 0;

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
        $this->ledgers = Ledger::whereNotIn('account_group_id', [16,17,19])->get();
        $this->modes = Ledger::whereIn('account_group_id', [16,17,19])->get();
        $this->branches = Branch::all();
        $this->currencies = Currency::all();
    }

    public function render()
    {
        return view('livewire.accounts.receipt');
    }

    private function resetInputFields(){
        $this->ledger_id = '';
        $this->amount = '';
        $this->narration = '';
    }

    protected $rules = [
        'mode_id' => ['required'],
        'date' => ['required'],
        'voucher_no' => ['required'],
        'currency_id' => ['required'],
        'branch_id' => ['required'],
        'remarks' => ['nullable'],
        'main_narration' => ['nullable'],
        'ledger_id.*' => 'required',
        'amount.*' => 'required',
        'narration.*' => 'required',
    ];

    protected $messages = [
        'ledger_id.*.required' => 'This ledger field is required.',
        'amount.*.required' => 'This amount field is required.',
        'narration.*.required' => 'This narration field is required.',
    ];


    public function store(){
        $data = $this->validate();
        dd($data);
        $company = Company::first();
        foreach ($this->ledger_id as $key => $value) {
            Voucher::create(['name' => $this->name[$key],
                             'phone' => $this->phone[$key],
                             'voucher_no' => $this->voucher_no,
                             'ledger_id' => $this->ledger_id[$key],
                             'opposite_ledger_id' => $this->mode_id,
                             'voucher_type' => 'RV',
                             'drcr' => 1,
                             'amount' => $this->amount[$key],
                             'narration' => $this->narration[$key],
                             'main_narration' => $this->main_narration,
                             'remarks' => $this->remarks,
                             'tr_type' => 1,
                             'mode_id' => $this->mode_id,
                             'currency_id' => $this->currency_id,
                             'fiscal_year_id' => $company->fiscal_year_id,
                             'branch_id' => $this->branch_id,
                             'ref_id' => '',
                             'status' => 1,
                            ]);
            Voucher::create(['name' => $this->name[$key],
                            'phone' => $this->phone[$key],
                            'voucher_no' => $this->voucher_no,
                            'ledger_id' => $this->mode_id,
                            'opposite_ledger_id' => $this->ledger_id[$key],
                            'voucher_type' => 'RV',
                            'drcr' => 2,
                            'amount' => $this->amount[$key],
                            'narration' => $this->narration[$key],
                            'main_narration' => $this->main_narration,
                            'remarks' => $this->remarks,
                            'tr_type' => -1,
                            'mode_id' => $this->mode_id,
                            'currency_id' => $this->currency_id,
                            'fiscal_year_id' => $company->fiscal_year_id,
                            'branch_id' => $this->branch_id,
                            'ref_id' => '',
                            'status' => 1,
                           ]);                
        }
    }
}
