<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MailingContact;
use Session;

class MailingContactController extends Controller
{
  public function saveContact()
  {
    $request = request()->all();
    $email = $request['email'];
    $exists = count(MailingContact::where('email',$email)->first()) > 0 ? true : false ;
    if(!$exists){
      $contact = new MailingContact();
      $contact->email = $email;
      $contact->save();
      Session::flash('successMessage','Usted ha sido dado de alta en nuestra lista');
    }
    else {
      Session::flash('errorMessage','Usted ya se encuentra inscripto en nuestra lista');
    }
    return redirect()->to('/');
  }

  public function deleteContact()
  {
  }
}
