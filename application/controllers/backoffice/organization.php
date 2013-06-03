<?php

class Backoffice_Organization_Controller extends Base_Controller {


    public $layout = 'layouts.container';

	public function action_list()
	{
        return View::make('backoffice.organizations.list_organization');
	}
	
	public function action_add()
	{
		return View::make('backoffice.organizations.add_organization');
	}
	
	public function action_edit($id)
	{
		$org = Organization::find($id);
        return View::make('backoffice.organizations.edit_organization')->with('org', $org);
	}
	
	public function action_delete($id)
	{
		$org = Organization::find($id);
		$org->delete();
        return View::make('backoffice.organizations.list_organization');
	}
	
   
	public function action_confirm($id)
	{
		
		return View::make('backoffice.organizations.confirm_deletion_organization')->with('id', $id);
	}
	
    public function action_save()
	{
		$id = Input::get('id');
        $organization_name = trim(Input::get('organizationname'));
        $citation = trim(Input::get('citation'));
        $city     = trim(Input::get('city'));
        $zipcode  = trim(Input::get('zipcode'));
        $state    = trim(Input::get('state'));
        $address  = trim(Input::get('address'));

        $item = Organization::where('organizationname', '=', $organization_name); 
        $item = ($item != null) ? $item : (new Organization);
        
		if($id == 0)
		{		    	
		   if(strtolower($item->organizationname) == strtolower($organization_name))
		      return View::make('backoffice.organizations.add_organization')->with('error_data', 'Error: Duplicated name');
		   else 
		   {
			   $org = new Organization;
			
			   $org->organizationname = $organization_name;
			   $org->citation = $citation;
			   $org->city = $city;
			   $org->zipcode = $zipcode;
			   $org->state   = $state;
			   $org->address = $address;		   
			
			   $org->save();
		   }
		}
		else if($id != 0)
		{
		   $org = Organization::find($id);
		   if(( strtolower($organization_name) == strtolower($item->organizationname) ) && ($item->id != $org->id) )
		   {	 
		      return View::make('backoffice.organizations.edit_organization')->with('org', $org)->with('error_data', 'Error: Duplicated name');
		   }   
		   else
		   {
			   $org->organizationname = $organization_name;
			   $org->citation = $citation;
			   $org->city = $city;
			   $org->zipcode = $zipcode;
			   $org->state   = $state;
			   $org->address = $address;
			
			   $org->save();
		   }
		}  
		
      return View::make('backoffice.organizations.list_organization');
	}
	
	
    public function action_edit_contact($id)
	{
		$contact = Contact::find($id);
		$org = Organization::find($contact->organizationid);
		
        return View::make('backoffice.organizations.edit_contact')->with('contact', $contact)->with('org', $org);
	}
	
    public function action_delete_contact($id)
	{
		$contact = Contact::find($id);
		$contact->delete();
        return View::make('backoffice.organizations.list_contacts');
	}
	
    public function action_confirm_contact_deletion($id)
	{
		
		return View::make('backoffice.organizations.confirm_deletion_contact')->with('id', $id);
	}
	
    public function action_add_contact()
	{
        return View::make('backoffice.organizations.add_contact');
	}
	
    public function action_list_contacts()
	{
        $organizationid = Input::get('organizationid');
        if(isset($organizationid))
        {
		   $contacts = Contact::where('organizationid', '=', $organizationid)->order_by('FirstName','asc')->get();
		   return View::make('backoffice.organizations.list_contacts')->with('contacts_from', $contacts)->with('orgid', $organizationid);
        }
        else
		{
		   $contacts = DB::table('Contacts')->order_by('FirstName','asc')->get();
		   return View::make('backoffice.organizations.list_contacts');
		}   
		
	}
	
	
    public function action_save_contact()
	{
		$id = Input::get('id');
        $firstname = trim(Input::get('firstname'));
        $lastname = trim(Input::get('lastname'));
        $phonenumber = trim(Input::get('phonenumber'));
        $mobilenumber = trim(Input::get('mobilenumber'));
        $email = trim(Input::get('email'));
        $majorarea = trim(Input::get('majorarea'));
        $organizationid = Input::get('organizationid');
        
        $item = Contact::where('firstname','=', $firstname)->where('lastname','=', $lastname)->first();
        
        $item = ($item != null) ? $item : (new Contact);
        
        if($id == 0)
        {    
        	if($firstname == $item->firstname && $lastname == $item->lastname)
        	{
        		
             return View::make('backoffice.organizations.add_contact')
                              ->with('error_data', 'Error: Fistname & Lastname are duplicated');
        		
        	}   
        	
        	else
        	{ 	
	        	$contact = new Contact;
	        	$contact->firstname = $firstname;
	        	$contact->lastname  = $lastname;
	        	$contact->phonenumber = $phonenumber;
	        	$contact->mobilenumber = $mobilenumber;
	        	$contact->email = $email;
	        	$contact->majorarea = $majorarea;
	        	$contact->organizationid = $organizationid;
	        	
	        	$contact->save();
        	}
        }
        else 
        {
        	$contact = Contact::find($id);
        	
        	if( ($item->firstname == $firstname && $item->lastname == $lastname) && $contact->id != $item->id)
        	{
              return View::make('backoffice.organizations.edit_contact')->with('contact', $contact)->with('error_data', 'Error: Fistname & Lastname are duplicated');
	        	
        	}
        	else
        	{
        		$contact->firstname = $firstname;
	        	$contact->lastname  = $lastname;
	        	$contact->phonenumber = $phonenumber;
	        	$contact->mobilenumber = $mobilenumber;
	        	$contact->email = $email;
	        	$contact->majorarea = $majorarea;
	        	$contact->organizationid = $organizationid;
	        	
	        	$contact->save();
        	}
        }
        
		return View::make('backoffice.organizations.list_contacts');
	}
	
}