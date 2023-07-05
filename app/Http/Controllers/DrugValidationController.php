<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Console\RegistrationValidation;

class DrugValidationController extends Controller
{
    
    /**
     * Show the form for editing the specified resource.
     */
    public function DrugValidation()
    {
        $drug_valiation = (new RegistrationValidation)->handle();
        $this->dispatch($drug_valiation);
    }
}
