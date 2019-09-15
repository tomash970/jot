<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactsController extends Controller
{

	public function index()
    {
    	$this->authorize('viewAny', Contact::class);
    	return ContactResource::collection(request()->user()->contacts);
    	
    }

    public function store() 
    {
    	$this->authorize('create', Contact::class);
    	$contact = request()->user()->contacts()->create($this->validateData());

    	return (new ContactResource($contact))
    	->response()
    	->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Contact $contact)
    {

    	
    	// if (request()->user()->isNot($contact->user)) {
    	// 	return response([], 403);
    	// }

    	$this->authorize('view', $contact);
        //dd($contact);
    	return new ContactResource($contact);
    }

    public function update(Contact $contact) 
    {
    	$this->authorize('update', $contact);
    	$contact->update($this->validateData());

    	return (new ContactResource($contact))
    	->response()
    	->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Contact $contact)
    {
    	$this->authorize('delete', $contact);

    	$contact->delete();

    	return response([], Response::HTTP_NO_CONTENT);
    }

    private function validateData()
    {
    	return request()->validate([
    		'name' => 'required | min:3',
    		'email' => 'required | email',
    		'birthday' => 'required',
    		'company' => 'required',
    	],
    	[
	        'name.required' => 'Ime je potrebno',
	        'name.min' => 'Ime mora imati minimum od 3 slova!',
	        
	    ]
         );
    }

   

}
