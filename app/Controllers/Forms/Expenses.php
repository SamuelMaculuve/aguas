<?php


namespace App\Controllers\Forms;

use App\Controllers\BaseController;
use App\Models\Expense;

class Expenses extends BaseController
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function add($data): void
    {
        $name = filter_var($data["name"], FILTER_SANITIZE_STRING);
        $amount = filter_var($data["amount"], FILTER_VALIDATE_FLOAT);
        $account_id = filter_var($data["account_id"], FILTER_VALIDATE_INT);
        $description = filter_var($data["description"], FILTER_SANITIZE_STRING);

        if (!$name || !$amount || !$account_id) {
            echo ajax("msg", ["type" => "alert-danger", "msg" => "Por favor, preencha todos os campos corretamente."]);
            return;
        }

        $save = (new Expense())->save(compact("name", "amount", "description", "account_id"))
            ->execute();
        if (!$save) {

            echo ajax("msg", ["type" => "alert-danger", "msg" => "Erro ao registrar a despesa, tente novamente."]);
            return;
        }

        echo ajax("msg", ["type" => "alert-success", "msg" => "Despesa registada com sucesso !"]);
    }

    public function delete($data): void
    {
        $expense_id = filter_var($data["expense_id"], FILTER_VALIDATE_INT);

        $delete = (new Expense())->delete()->where("id = '$expense_id'")->execute();
        if (!$delete) {
            echo ajax("msg", ["type" => "error", "msg" => "Erro ao apagar a despesa, tente novamente."]);
            return;
        }

        echo ajax("msg", ["type" => "success", "msg" => "Despesa apagada com sucesso !"]);
    }
}