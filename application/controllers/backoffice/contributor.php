<?php
class Backoffice_Contributor_Controller extends Base_Controller {
	
   public $layout = 'layouts.container';
	  
   
   public function action_list()
	{
	   $contributors = Contributor::all();
	   
	   return View::make('backoffice.contributors.list_contributors')
	              ->with('contributors',$contributors);
	}
	
	
	
	
   public function action_delete($id)
	{
		$contributor = Contributor::find($id);
		
		File::delete('public/uploads/images/contributors/'.$contributor->photo);
		$contributor->delete();
		
        return Redirect::to('backoffice/contributor/list');
	}
	
	
   
	public function action_confirm_deletion($id)
	{
		
		return View::make('backoffice.contributors.confirm_deletion_contributor')->with('id', $id);
	}
		
	
	
   public function action_edit($id)
	{
		$contributor = Contributor::find($id);
        return View::make('backoffice.contributors.edit_contributor')
                   ->with('contributor', $contributor);
	}
	
	
	
   public function action_add()
	{
		$contributor =  new Contributor;
        return View::make('backoffice.contributors.add_contributor')
                   ->with('contributor',$contributor);
	}
	
	
	
   public function action_save()
	{
	    $id = Input::get('id');
	    
	    $contributorname = trim(Input::get('contributorname'));	    
	    $contributortype = Input::get('contributortype');
	    $email = trim(Input::get('email'));
	    $phonenum = trim(Input::get('phonenumber'));
	    $address = trim(Input::get('address')); 
	    $detail  = trim(Input::get('detail')); 
           
		$item = Contributor::where('contributorname','=', $contributorname)->first();		
		$item = ($item != null) ? $item : (new Contributor);
		
	    //set the name of the file
		$image = Input::file('image');
		$filename  =  Input::file('image.name');

		    
		if($id == 0)
		{
		  $contributor = new Contributor;
		  
		  $contributor->contributorname = $contributorname;
		  $contributor->contributortype = $contributortype;
	      $contributor->emailaddress = $email;
	      $contributor->address = $address;
	      $contributor->detail  = $detail;
	      $contributor->phoneno = $phonenum; 
	      $contributor->accountid = -999;       
	
	      $setPicture = $this->uploadImage($image, $filename,'add');
		  if($setPicture)
		  {
		   $contributor->photo = $filename;
		  }	
		   
		  if( $item && strtolower($contributorname) != strtolower($item->contributorname))
		  {
		    $contributor->save();		   
		  }
		   else
		   {
		   	  Log::info("ERROR: Add Contributor - duplicate contributor ".$contributorname); 
		      return View::make('backoffice.contributors.add_contributor')
		                 ->with('contributor',$contributor)
		                 ->with('error_data', 'Error: Duplicated Contributor '.$contributorname);
		   }
		}
		else 
		{
		  $contributor = Contributor::find($id);	
		  if( strtolower($contributor->contributorname) == strtolower($item->contributorname) && $contributor->id != $item->id)
		  {
		  	 Log::info("ERROR: Edit Contributor - duplicate contributor ".$contributorname); 
		  	 return View::make('backoffice.contributors.edit_contributor')
		                ->with('contributor', $contributor)
		                ->with('error_data', 'Error: Duplicated Contributor '.$contributorname);
		  
		  }
		 else 
		 {
		    $contributor->contributorname = $contributorname;
		  	$contributor->contributortype = $contributortype;
	        $contributor->emailaddress    = $email;
	        $contributor->address = $address;
	        $contributor->detail  = $detail;
	        $contributor->phoneno = $phonenum;
	        
	        $setPicture = $this->uploadImage($image, $filename, 'edit');
	        
		    if( $setPicture )
		    {
		       Log::info($filename);
		       $contributor->photo = $filename;	
		    }
		   
		    $contributor->save(); 
		 }
		    
		}
		
        return Redirect::to("backoffice/contributor/list");
	}
	
	
	public function uploadImage($image, $filename, $current_action)
	{
	    $success = false;
	    
	    Log::info("Filename: ".$filename);
        $extension = File::extension($filename);
		
        $rules = array('image' => 'image|max:1000');
		$inputs = array('image' => $image);
			 
		
		$path = ($current_action == "add") 
		  	      ? 'backoffice.contributors.add_contributor'
		  	      : 'backoffice.contributors.edit_contributor';
		  	         
		$validation = Validator::make($inputs, $rules);
		
		if( $validation->passes() && in_array(strtolower($extension), array('jpg','gif','png','jpeg','bmp'))) 
		 {

		  //Check if a file already exists before uploading.
		  if(File::exists('public/uploads/images/contributors/'.$filename))
		  {
		  	$success = false;
		  	Log::info('ERROR: File already exists...'.$filename);
		  	         
		  	return View::make($path)
		  	           ->with('error_data', 'Error: Image '. $filename.'already exists');
		  }
		  
		  //Upload the file
		  $img_upload = Input::upload('image', 'public/uploads/images/contributors', $filename);
		  if($img_upload === false)
		  {
		  	 $success =  false;
		  	 Log::info('ERROR: uploading file: '.$filename);
		     return View::make($path)
		                ->with('error_data', 'Error uploading file: '.$filename);
		  }
		  else 
		      $success = true;
		   
		 }
		 
	     Log::info("Upload image was successed: ".$success);
	     return $success;	 
	}
	
}
?>