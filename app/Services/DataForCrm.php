<?php

namespace App\Services;

class DataForCrm 
{
    public function dataForContactsAndLeads($conversations)
    {
        $dates = [];
        foreach ($conversations as $key) {
            foreach ($key['contact'] as $contacts ) {
                  $dates = [
                      'first_name' => $contacts['fields']['name'],
                      'last_name' => $contacts['fields']['name'],
                      'email1' => $contacts['fields']['email'],
                      'phone_work' => $key['fields']['phone'],
                  ];
            }
          
        }
        return $dates;
    }

    public function dataForAccounts($fields)
    {
        $dates = [
            'name' => $fields['name'],
            'phone_office' => $fields['phone'],
            'email1' => $fields['email'],
        ];

        return $dates;
    }
}
