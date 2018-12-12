<?php

namespace App\Http\Controllers;

use App\AccountsChart;
use App\Cashbox;
use App\CurrentAccount;
use Illuminate\Http\Request;
use App\Card;
use App\Http\Controllers\CreditController;

class TerminalController extends Controller
{
    public function index()
    {
        return view('terminal');
    }

    public function checkAutorization(Request $request)
    {
        $card = Card::where('card_num', $request->input('card_number'))->where('pin', $request->input('pin_code'))->get();
        return count($card);
    }

    public function getMoneyFromCredit(Request $request)
    {
        try {
            $cashboxes = Cashbox::all();
            foreach ($cashboxes as $cashbox) {
                $sum = $cashbox->debit;
            }
            if ($request->input('sum') > $sum){
                $result = 'Something went wrong.';
            } else {
                $currentsAccounts = CurrentAccount::where('account_number', $request->input('card_num'))->get();
                foreach ($currentsAccounts as $currentsAccount) {
                    $currentsAccountId = $currentsAccount->id;
                }
                $accountCharts = AccountsChart::where('current_accounts_id', $currentsAccountId)->get();
                foreach ($accountCharts as $accountChart) {
                    $user_info_id = $accountChart->user_informations_id;
                }
                $sum = $sum-$request->input('sum');
                $creditController = new  CreditController();
                $creditController->getLoan($sum, $user_info_id);
                $result = 'Get your money.';
            }
        } catch (\Exception $exception){
            $result = 'Something went wrong.';
        }
        return $result;
    }

    public function getAccountBalance(Request $request){
        try {
            $currentsAccounts = CurrentAccount::where('account_number', $request->input('card_num'))->get();
            foreach ($currentsAccounts as $currentsAccount) {
                $credit = $currentsAccount->credit;
                $debit = $currentsAccount->debit;
            }
            $balance = $debit - $credit;
            $result = 'Balance your account is '.$balance;
        } catch (\Exception $exception){
            $result = 'Something went wrong.';
        }
        return $result;
    }
}
