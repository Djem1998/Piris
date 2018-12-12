<?php

namespace App\Http\Controllers;

use App\BankFund;
use App\CurrentAccount;
use App\InterestAccount;
use App\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\UserInformation;
use App\DepositType;
use App\AccountsChart;
use App\Cashbox;
use App\Card;

class CreditController extends Controller
{
    public function index()
    {
        $users = UserInformation::all();
        $result = array();
        $i = 0;
        foreach ($users as $user) {
            $result[$i] = array('id' => $user->id, 'first_name' => $user->first_name, 'last_name' => $user->last_name, 'father_name' => $user->father_name);
            $i++;
        }
        return view('credit')->with([
            'users' => $result,
        ]);
    }

    public function getName()
    {
        try {
            $result = array();
            $i = 0;
            $depositTypes = DepositType::where('type', 'credit')->get();
            foreach ($depositTypes as $depositType) {
                $result[$i] = $depositType->name;
                $i++;
            }
        } catch (\Exception $exception) {
            $result = 'Something went wrong';
        }
        return $result;
    }

    public function getCurrency()
    {
        try {
            $result = array();
            $i = 0;
            $depositTypes = DepositType::where('type', 'credit')->get();
            foreach ($depositTypes as $depositType) {
                $result[$i] = $depositType->currency;
                $i++;
            }
        } catch (\Exception $exception) {
            $result = 'Something went wrong';
        }
        return $result;
    }

    public function getDuration($currency, $depositName)
    {
        try {
            $result = array();
            $i = 0;
            $depositTypes = DepositType::where('currency', $currency)->where('name', $depositName)->where('type', 'credit')->get();
            foreach ($depositTypes as $depositType) {
                $result[$i] = $depositType->duration;
                $i++;
            }
        } catch (\Exception $exception) {
            $result = 'Something went wrong';
        }
        return $result;
    }

    public function getPercent($currency, $depositName, $duration)
    {
        try {
            $result = array();
            $i = 0;
            $depositTypes = DepositType::where('currency', $currency)->where('name', $depositName)->where('duration', $duration)->where('type', 'credit')->get();
            foreach ($depositTypes as $depositType) {
                $result[$i] = $depositType->percent;
                $i++;
            }
        } catch (\Exception $exception) {
            $result = 'Something went wrong';
        }
        return $result;
    }

    public function getCountAccounts($id)
    {
        $counts = AccountsChart::where('user_informations_id', $id)->get();
        $i = count($counts);
        return $i;
    }

    private function initCashbox()
    {
        $account_number = '10109834659';
        $cashbox = new Cashbox();
        $cashbox->account_number = $account_number;
        $cashbox->debit = 0;
        $cashbox->credit = 0;
        $cashbox->balance = 0;
        $cashbox->save();
    }

    private function initBankFund()
    {
        $account_number = '73279834659';
        $bank_fund = new BankFund();
        $bank_fund->account_number = $account_number;
        $bank_fund->debit = 0;
        $bank_fund->credit = 100000000000;
        $bank_fund->balance = 100000000000;
        $bank_fund->save();
    }

    private function initCurrentAccount($account_number)
    {
        $current_account = new CurrentAccount();
        $current_account->account_number = $account_number;
        $current_account->debit = 0;
        $current_account->credit = 0;
        $current_account->balance = 0;
        $current_account->save();
    }

    private function initInterestAccount($account_number)
    {
        $interest_account = new InterestAccount();
        $interest_account->account_number = $account_number;
        $interest_account->debit = 0;
        $interest_account->credit = 0;
        $interest_account->balance = 0;
        $interest_account->save();
    }

    private function checkCurrency($sum, $currency)
    {
        if ($currency == 'USD') {
            $result = (float)$sum * 2.135;
        } elseif ($currency == 'EUR') {
            $result = (float)$sum * 2.535;
        } else {
            $result = (float)$sum;
        }
        return $result;
    }

    public function getSumCredit($currency, $depositName, $duration)
    {
        try {
            $depositTypes = DepositType::where('currency', $currency)->where('name', $depositName)->where('duration', $duration)->where('type', 'credit')->get();
            foreach ($depositTypes as $depositType) {
                $result = $depositType->sum;
            }
        } catch (\Exception $exception) {
            $result = 'Something went wrong';
        }
        return $result;
    }

    private function getInfoAboutBank()
    {
        $bank = BankFund::all();
        foreach ($bank as $value) {
            $result = array('id' => $value->id, 'debit' => $value->debit, 'credit' => $value->credit, 'balance' => $value->balance);
        }
        return $result;
    }

    private function addOperation($operation_name, $operation, $user_info_id)
    {
        $operations = new Operation();
        $operations->user_informations_id = $user_info_id;
        $operations->operation_name = $operation_name;
        $operations->type = 'credit';
        $operations->operation = $operation;
        $operations->save();
    }

    private function getBalanceCurrentAccount()
    {
        $current_account = CurrentAccount::all();
        foreach ($current_account as $value) {
            $result = array('id' => $value->id, 'balance' => $value->debit - $value->credit);
        }
        return $result;
    }

    private function getInfoAboutCurrentAccount()
    {
        $current_account = CurrentAccount::all();
        foreach ($current_account as $value) {
            $result = array('credit' => $value->credit, 'debit' => $value->debit, 'balance' => $value->balance);
        }

        return $result;
    }

    private function bankLoan($sum, $user_info_id)
    {
        //add to debit bank
        $result = $this->getInfoAboutBank();
        BankFund::where('id', $result['id'])->update([
            'debit' => $result['debit'] + $sum,
            'balance' => $result['credit'] - ($result['debit'] + $sum),
        ]);
        //info
        $operation_name = 'add to debit bank fund';
        $info = $this->getInfoAboutBank();
        $operation = 'Result: credit: ' . $info['credit'] . ' ;debit: ' . $info['debit'] . ' ;balance: ' . $info['balance'];
        $this->addOperation($operation_name, $operation, $user_info_id);
        //add to debit current account
        $result = $this->getBalanceCurrentAccount();
        CurrentAccount::where('id', $result['id'])->update([
            'debit' => $sum,
            'balance' => $result['balance'] + $sum,
        ]);
        //info
        $operation_name = 'add to debit current account';
        $info = $this->getInfoAboutCurrentAccount();
        $operation = 'Result: credit: ' . $info['credit'] . ' ;debit: ' . $info['debit'] . ' ;balance: ' . $info['balance'];
        $this->addOperation($operation_name, $operation, $user_info_id);
    }

    private function getBalanceCashbox()
    {
        $casboxes = Cashbox::all();
        foreach ($casboxes as $value) {
            $result = array('id' => $value->id, 'balance' => $value->debit - $value->credit);
        }
        return $result;
    }

    private function getInfoAboutCashbox()
    {
        $cashboxes = Cashbox::all();
        foreach ($cashboxes as $cashbox) {
            $result = array('credit' => $cashbox->credit, 'debit' => $cashbox->debit, 'balance' => $cashbox->balance);
        }

        return $result;
    }

    private function creditTransferToCashBox($sum, $user_info_id)
    {
        //add to credit current account
        $result = $this->getBalanceCurrentAccount();
        CurrentAccount::where('id', $result['id'])->update([
            'credit' => $sum,
            'balance' => $result['balance'] - $sum,
        ]);
        //info
        $operation_name = 'add to credit current account';
        $info = $this->getInfoAboutCurrentAccount();
        $operation = 'Result: credit: ' . $info['credit'] . ' ;debit: ' . $info['debit'] . ' ;balance: ' . $info['balance'];
        $this->addOperation($operation_name, $operation, $user_info_id);
        //add to debit cashbox
        $result = $this->getBalanceCashbox();
        Cashbox::where('id', $result['id'])->update([
            'debit' => $sum,
            'balance' => $sum - $result['balance'],
        ]);
        //info
        $operation_name = 'add to cashbox';
        $info = $this->getInfoAboutCashbox();
        $operation = 'Result: credit: ' . $info['credit'] . ' ;debit: ' . $info['debit'] . ' ;balance: ' . $info['balance'];
        $this->addOperation($operation_name, $operation, $user_info_id);
    }

    public function getLoan($sum, $user_info_id)
    {
        //transfer in cashbox debit to credit
        $result = $this->getBalanceCashbox();
        Cashbox::where('id', $result['id'])->update([
            'credit' => $sum,
            'balance' => $result['balance'] + $sum,
        ]);
        //info
        $operation_name = 'add to credit cashbox';
        $info = $this->getInfoAboutCashbox();
        $operation = 'Result: credit: ' . $info['credit'] . ' ;debit: ' . $info['debit'] . ' ;balance: ' . $info['balance'];
        $this->addOperation($operation_name, $operation, $user_info_id);
    }

    public function addCredit(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'date_start' => 'required|after:yesterday|date',
                'amount' => 'required|regex:/\d+.\d{2}$/',
                'duration' => 'required',
                'deposit_type' => 'required',
                'currency' => 'required',
            ])->validate();
            //check currency
            $sum = $this->checkCurrency($request->input('amount'), $request->input('currency'));
            //init cashbox and bank fund
            $cashbox = Cashbox::all();
            if (count($cashbox) == 0) {
                $this->initCashbox();
            }
            $bank_fund = BankFund::all();
            if (count($bank_fund) == 0) {
                $this->initBankFund();
            }
            //init users accounts
            $current_account = CurrentAccount::where('account_number', $request->input('current_account'))->get();
            if (count($current_account) == 0) {
                $this->initCurrentAccount($request->input('current_account'));
            }
            $interest_account = InterestAccount::where('account_number', $request->input('interest_account'))->get();
            if (count($interest_account) == 0) {
                $this->initInterestAccount($request->input('interest_account'));
            }
            $this->bankLoan($sum, $request->input('select_user'));
            $this->creditTransferToCashBox($request->input('amount'), $request->input('select_user'));
            //$this->getLoan($request->input('amount'), $request->input('select_user'));
            //add account charts
            $interest_accounts = InterestAccount::where('account_number', $request->input('interest_account'))->get();
            foreach ($interest_accounts as $value) {
                $interest_account_id = $value->id;
            }
            $current_accounts = CurrentAccount::where('account_number', $request->input('current_account'))->get();
            foreach ($current_accounts as $account) {
                $current_account_id = $account->id;
            }
            $deposit_types = DepositType::where('name', $request->input('deposit_type'))->where('duration', $request->input('duration'))
                ->where('currency', $request->input('currency'))->where('type', 'credit')->get();
            foreach ($deposit_types as $deposit_type) {
                $deposit_type_id = $deposit_type->id;
            }
            $date_start = strtotime($request->input('date_start'));
            $account_charts = AccountsChart::where('deposit_types_id', $deposit_type_id)->where('current_accounts_id', $current_account_id)
                ->where('interest_accounts_id', $interest_account_id)->where('user_informations_id', $request->input('select_user'))
                ->where('date_start', $date_start)->get();
            if (count($account_charts) == 0) {
                $account_chart = new AccountsChart();
                $account_chart->deposit_types_id = $deposit_type_id;
                $account_chart->current_accounts_id = $current_account_id;
                $account_chart->interest_accounts_id = $interest_account_id;
                $account_chart->sum = $request->input('amount');
                $account_chart->user_informations_id = $request->input('select_user');
                $account_chart->date_start = $request->input('date_start');
                $account_chart->date_end = date('Y-m-d', strtotime("" . $request->input('date_start') . " +" . $request->input('duration') . " month"));
                $account_chart->save();
                $card = new Card();
                $card->card_num = $request->input('current_account');
                $card->interest_num = $request->input('interest_account');
                $pin = rand(1000, 9999);
                $card->pin = $pin;
                $card->save();
            }
            $result = 'Successful. Pin-code: ' . $pin . '. Card num: ' . $request->input('current_account');
        } catch (\Exception $exception) {
            $result = 'Something went wrong.';
        }
        return $result;
    }

    private function getBalanceInterestAccount()
    {
        $interest_account = InterestAccount::all();
        foreach ($interest_account as $value) {
            $result = array('id' => $value->id, 'balance' => $value->debit - $value->credit, 'credit' => $value->credit);
        }
        return $result;
    }

    private function getInfoAboutInterestAccount()
    {
        $interest_account = InterestAccount::all();
        foreach ($interest_account as $value) {
            $result = array('credit' => $value->credit, 'debit' => $value->debit, 'balance' => $value->balance);
        }

        return $result;
    }

    private function interestWithdrawal($deposit_type_id, $interest_account_id, $user_info_id, $account_id)
    {
        //get sum
        $accounts = AccountsChart::where('id', $account_id)->get();
        foreach ($accounts as $account) {
            $sum = $account->sum;
        }
        //check currency
        $deposit_types = DepositType::where('id', $deposit_type_id)->get();
        foreach ($deposit_types as $deposit_type) {
            $duration = $deposit_type->duration;
            $currency = $deposit_type->currency;
            $percent = (float)(str_replace('%', '', $deposit_type->percent));
        }
        $sum2 = $this->checkCurrency($sum, $currency);
        //add to credit interest account
        $result = $this->getBalanceInterestAccount();
        $i = $percent / 12;
        $k = ($i * pow(1 + $i, $duration)) / (pow(1 + $i, $duration) - 1);
        InterestAccount::where('id', $interest_account_id)->update([
            'credit' => $result['credit'] + ($k * $sum),
            'balance' => (($sum / 100) * $percent) + $result['balance'],
        ]);
        //info
        $operation_name = 'add to credit interest account';
        $info = $this->getInfoAboutInterestAccount();
        $operation = 'Result: credit: ' . $info['credit'] . ' ;debit: ' . $info['debit'] . ' ;balance: ' . $info['balance'];
        $this->addOperation($operation_name, $operation, $user_info_id);
        //add to credit bank
        $result = $this->getInfoAboutBank();
        BankFund::where('id', $result['id'])->update([
            'credit' => $result['credit'] + $sum2,
            'balance' => $result['credit'] + $sum2 - $result['debit'],
        ]);
        //info
        $operation_name = 'add to credit bank fund';
        $info = $this->getInfoAboutBank();
        $operation = 'Result: credit: ' . $info['credit'] . ' ;debit: ' . $info['debit'] . ' ;balance: ' . $info['balance'];
        $this->addOperation($operation_name, $operation, $user_info_id);
    }

    public function bankDayClosing()
    {
        try {
            $result = 'Nothing doing.';
            $accounts = AccountsChart::all();
            foreach ($accounts as $account) {
                $account_id = $account->id;
                $deposit_type_id = $account->deposit_types_id;
                $interest_account_id = $account->interest_accounts_id;
                $user_info_id = $account->user_informations_id;
                $deposit_types = DepositType::where('id', $deposit_type_id)->get();
                foreach ($deposit_types as $deposit_type) {
                    $duration = $deposit_type->duration;
                }
                for ($i = 1; $i < $duration; $i++) {
                    if (date('Y-m-d') == date('Y-m-d', strtotime("" . $account->date_start . " +" . $i . " month"))) {
                        $this->interestWithdrawal($deposit_type_id, $interest_account_id, $user_info_id, $account_id);
                        $result = 'Operation successful.';
                    };
                }
            }
        } catch (\Exception $exception) {
            $result = 'Something went wrong. Error with code: ' . $exception->getCode();
        }
        return $result;
    }
}
