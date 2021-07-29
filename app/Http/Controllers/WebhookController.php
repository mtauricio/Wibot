<?php

namespace App\Http\Controllers;

use App\Services\DataForCrm;
use Esatic\Suitecrm\Services\CrmApi;
use Illuminate\Http\Request;

class WebhookController extends Controller
{

    private CrmApi $apiCrm;
    private DataForCrm $dataForCrm;

     /**
     * WebhookController constructor.
     * @param CrmApi $apiCrm
     */
    public function __construct(CrmApi $apiCrm, DataForCrm $dataForCrm)
    {
        $this->apiCrm = $apiCrm;
        $this->dataForCrm = $dataForCrm;
    }


    public function createEntriesCrm(Request $request)
    {
        $data = [];
        $module = "";
        $conversations = $request->input('conversations');
        foreach ($conversations as $key) {
            $module = $key['fields']['module'];
            if ($module == "Contacts" || $module == "Leads") {
                    $data = $this->dataForCrm->dataForContactsAndLeads($conversations);
                }elseif ($module == "Accounts") {
                    $data = $this->dataForCrm->dataForAccounts( $key['fields']);
                }elseif ($module == "Quotes") {
                    $data = $this->dataForCrm->dataForAccounts($conversations);
                }
            }
            $entry = $this->apiCrm->setEntry($module, $data);
        return $entry;
    }
}
