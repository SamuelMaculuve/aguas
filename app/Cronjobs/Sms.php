<?php

include "../../vendor/autoload.php";

use App\Contracts\Messages;
use App\Models\Client;
use App\Models\Invoice;

$model = new Invoice();

$invoices = $model->find()
    ->where("warned = '1', status IN(1,4) AND ")
    ->like("date_added", date("m-Y"), 'end');

if ($invoices) {

    $count = 0;

    foreach ($invoices as $invoice) {

        $date = date_create_from_format("d-m-Y", $invoice->date_added);
        $exp = date_create_from_format("d-m-Y",$date->add(new DateInterval("P1M"))->format("10-m-Y"));

        /* 5 days to invoice expiration message */
        if ($exp->diff(new DateTime("now"))->d >= 5) {

            $client = (new Client())->find()->where("client_id = '$invoice->client_id'")->execute();
            $sms = Messages::expiry($client);

            if ($sms) {
                $model->update(["warned" => '2'])->where("id = '$invoice->id'")->execute();
                $count++;
            }
        }
    }

    die("Terminated, sent {$count} messages");

} else {
    die("Terminated, didn't send any messages");
}