<?php

namespace App\Http\Controllers\Property;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Expense;
use App\Http\Model\WorkOrder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Datatables;

class ExpenseController extends Controller
{
    //

    public function getData($id) {
        return Datatables::of(Expense ::select(array('expense_id','entry_date','amount','tax','tax_2','payee')))
            ->where('work_order_id',$id)
            ->addColumn('operations',
                '<ul class="no_style">
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$expense_id}}" data-url="{{ URL("expense/remove/".$expense_id)}}">
                         <i class="fa fa-remove" title=""></i> </a>
                         </li>
                         <li><a class="pop" data-url="{{ URL("building/edit/".$expense_id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         <li><a class="pop" title="Units Detail" href="{{ URL("unit/".$expense_id)}}">
                         <i class="fa fa-square-o"></i> </a>
                         </li>
                         </ul>')
            ->make(true);
    }

    public function getAdd($work_order_id) {
        $work_order = WorkOrder::find($work_order_id)->first();
        $heading = "Expenses for ".$work_order->name;

        return view('property.expense.add',[
            'heading' => $heading,
            'work_order_id' => $work_order_id,
            'ActionURL' => URL('expense/add'),
        ]);
    }

    public function Add(Request $request){
        $validate =array();
        $name =array();
        //$validate ['name'] = 'required|max:109';

        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            $expense = new Expense();
            $expense->work_order_id = $request->work_order_id;
            $expense->entry_date = $request->entry_date;
            $expense->reference = $request->reference;
            $expense->amount = $request->amount;
            $expense->tax = $request->tax;
            $expense->tax_2 = $request->tax_2;
            $expense->payee = $request->payee;
            $expense->payee = $request->payee;
            $expense->description = $request->description;
            $expense->memo = $request->memo;

            $expense->save();
            Session::flash('success_message', ' Expense Has Been Added to Work Order. !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }

}
