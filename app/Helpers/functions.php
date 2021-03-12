<?php

function getValidationsOnUpdate($request) {
    $validations = [];
    if($request->has('name')) $validations['name'] = 'required|string';
    if($request->has('document')) $validations['document'] = ['required','string', 'unique:payers', new \App\Rules\Document];
    if($request->has('phone')) $validations['phone'] = ['required','string', new \App\Rules\Phone];
    if($request->has('email')) $validations['email'] = 'required|string';
    if($request->has('birth')) $validations['birth'] = 'required|date_format:Y-m-d';
    if($request->has('address_cep')) $validations['address_cep'] = ['required','string', new \App\Rules\CEP];
    if($request->has('address_street')) $validations['address_street'] = 'required|string';
    if($request->has('address_district')) $validations['address_district'] = 'required|string';
    if($request->has('address_number')) $validations['address_number'] = 'required|numeric';
    if($request->has('address_complement')) $validations['address_complement'] = 'required|string';
    if($request->has('address_city')) $validations['address_city'] = 'required|string';
    if($request->has('address_state')) $validations['address_state'] = 'required|string';
    return $validations;
}