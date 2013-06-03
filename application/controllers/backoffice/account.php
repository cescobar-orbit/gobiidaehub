<?php
class Backoffice_Account_Controller extends Base_Controller {
	
	public $layout = 'layouts.container';

	
        
    public function action_list()
	{
        return View::make('backoffice.accounts.list_accounts');
	}
	
	
	public function action_edit($id)
	{
		$acct = Account::find($id);
		
		return View::make('backoffice.accounts.edit_account')
		           ->with('acct', $acct);
	}
	
	public function action_add()
	{
		$account = new Account;
		
		return View::make('backoffice.accounts.add_account')
		           ->with('acct', $account);
	}
	
	public function action_delete($id)
	{
		$acct = Account::find($id);
		$acct->delete();
		
		return Redirect::to('backoffice/account/list');
	}
	
	public function action_confirm($id)
	{
		
		return View::make('backoffice.accounts.confirm_deletion_account')->with('id', $id);
	}
	
	public function action_save()
	{
		/* id=0 then create, id != 0 then update and redirect to list*/
		$id = Input::get('id');
        $username = trim(Input::get('username'));
        $accountname = trim(Input::get('accountname'));
        $email = trim(Input::get('email'));
        $iscontributor = Input::get('iscontributor');
        $roleid  = Input::get('roleid');
        $enabled = Input::get('enabled');
        $resetpassword = Input::get('resetpassword');
        
        
        $item = Account::where('username', '=', $username)->first();
        $item = ($item != null)? $item:(new Account);
        
		if($id == 0)
		{
		   $acct = new Account;			
		   
		   $acct->username = $username;
		   $acct->password = Hash::make($username);
		   $acct->accountname = $accountname;
		   $acct->emailaddress = $email;
		   $acct->iscontributor = ($iscontributor)? 1:0;
		   $acct->active = ($enabled) ? 1:0;
		   $acct->roleid = $roleid;		
			   	
		   if($item != null && strtolower($item->username) == strtolower($username))
		   {
		   	  Log::info("ERROR: Add account - duplicate username ".$username);
		      return View::make('backoffice.accounts.add_account')
		                 ->with('error_data', 'Error: Duplicated username '.$username);
		   }
		   else 
		   {			
			   $acct->save();
		   }
		}
		else 
		{
		   $acct = Account::find($id);

		   $acct->username = $username;
		   $acct->accountname = $accountname;
		   $acct->emailaddress = $email;
		   $acct->iscontributor = $iscontributor;
		   $acct->roleid = $roleid;		
		   $acct->active = ($enabled) ? 1:0;
			  
		   if($resetpassword){
			  $acct->password = Hash::make($username);
		   }
			   
		  if((strtolower($username) == strtolower($item->username)) && ($acct->id != $item->id))
		    {   
		    	Log::info("ERROR: Edit account - duplicate username ".$username);
		    	return View::make('backoffice.accounts.edit_account')
		    	           ->with('acct', $acct)
		    	           ->with('error_data', 'Error: Duplicated username '.$username);
		    }
		  
		  else
		  {  
			  $acct->save();
		  }
		}  
		return View::make('backoffice.accounts.list_accounts');
	}
	
	public function action_change_password()
	{
		$id = trim(Input::get('acctid'));
		$password = trim(Input::get('password'));

	  	$acct =  Account::find($id);
	  	$acct->password = Hash::make($password);
	  	$acct->isnew = 0;
	  	
	  	$acct->save();

	  	return Redirect::to("home");
	}
	
	
	
    public function action_reset_password($id)
	{
		$password = Input::get('password');

	  	$acct =  Account::find($id);
	  	$acct->password = Hash::make($acct->username);
	  	$acct->isnew = 1;
	  	
	  	$acct->save();
	  	
	  	return Redirect::to('backoffice/account/list');
	}
	
	
	public function action_forgotpassword()
	{
		return null;
	}
	
	
	
	/*----------------------------------- ROLES METHODS  ---------------------------------*/
	public function action_list_roles()
	{
		$roles = Role::all();
        return View::make('backoffice.accounts.list_roles')->with('roles',$roles);
	}
	
	public function action_delete_role($id)
	{
		$role = Role::find($id);
		$role->delete();
		
        return Redirect::to('backoffice/account/list_roles');
    }
	
	public function action_confirm_deletion_role($id)
	{
		
		return View::make('backoffice.accounts.confirm_deletion_role')->with('id', $id);
	}
	
	
	public function action_add_role()
	{
		$role = new Role;
        return View::make('backoffice.accounts.add_role')
                   ->with('role',$role);
	}
	
	public function action_edit_role($id)
	{
		$role = Role::find($id);
        return View::make('backoffice.accounts.edit_role')
                   ->with('role', $role);
	}
	
	
	
	public function action_save_role()
	{
		/* id=0 then create, id != 0 then update and redirect to list*/
		$id = Input::get('id');
        $rolename = trim(Input::get('rolename'));
        $fullaccess = trim(Input::get('fullaccess'));
        $accesscontrol = trim(Input::get('accesscontrol'));
        $contenteditable = trim(Input::get('contenteditable'));
        
        $item = Role::where('rolename','=',$rolename)->first();
        $item = ($item != null) ? $item : (new Role);
        
		if($id == 0)
		{
		   $rolecv = new Role;		   
		   $rolecv->rolename = $rolename;
		   $rolecv->fullaccess = $fullaccess;
		   $rolecv->accesscontrol = $accesscontrol;
		   $rolecv->contenteditable = $contenteditable;
			   
		   if(strtolower($item->rolename) == strtolower($rolename))
		   {
		   	   Log::info("ERROR: Add role - duplicate role ".$rolename);
		   	   return View::make('backoffice.accounts.add_role')
		   	              ->with('error_data', 'Error: Role name is duplicated '.$rolename);  	   
		   }
		   
		   else 
		   {   
			   $rolecv->save();
		   }
		}
		else
		{
		    $rolecv = Role::find($id);	
		    $rolecv->rolename = $rolename;
		    $rolecv->fullaccess = $fullaccess;
		    $rolecv->accesscontrol = $accesscontrol;
		    $rolecv->contenteditable = $contenteditable;
		    
		  if( (strtolower($rolename) == strtolower($item->rolename)) && ($rolecv->id != $item->id) )
		  {	
		  	 Log::info("ERROR: Edit role - duplicate role ".$rolename);
		     return View::make('backoffice.accounts.edit_role')
		                ->with('role', $rolecv)
		                ->with('error_data', 'Error: Role name is duplicated '.$rolename); 
		  }
		  else 
		  {  		    
		    $rolecv->save();
		  }
		  
		}  
		
        return Redirect::to('backoffice/account/list_roles');
	}
}

?>