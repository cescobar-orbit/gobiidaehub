<?php
class Backoffice_Definition_Controller extends Base_Controller {
	
   public $layout = 'layouts.container';
	  
   public function action_list()
	{
	   $definitions = Definition::order_by('term','asc')->get();
	   
	   return View::make('backoffice.definitions.list_definitions')
	              ->with('definitions', $definitions);
	}
	
	
   public function action_delete($id)
	{
		$def = Definition::find($id);
        File::delete('public/uploads/images/definitions/'.$def->photo);
        
		$def->delete();
		
        return Redirect::to('backoffice/definition/list');
	}
	
	
   
	public function action_confirm_deletion($id)
	{
		
		return View::make('backoffice.definitions.confirm_deletion_definition')->with('id', $id);
	}
		
	
	
   public function action_edit($id)
	{
		$definition = Definition::find($id);
        return View::make('backoffice.definitions.edit_definition')
                   ->with('definition', $definition);
	}
	
   public function action_add()
	{
		$definition = new Definition;
        return View::make('backoffice.definitions.add_definition')
                   ->with('definition', $definition);
	}
	
	
	
   public function action_save()
	{
	    $id = Input::get('id');
	    $lang = Input::get('lang');
	    
	    $term = trim(Input::get('term'));
	    $definition_desc = trim(Input::get('definition')); 
        $categoryid = trim(Input::get('category'));
           
		$item = Definition::where('term','=', $term)->first();				
		$item = ($item != null) ? $item : (new Definition);
		
	    //set the name of the file
		$image = Input::file('image');
		$filename  =  Input::file('image.name');
            
		if($id == 0)
		{
		  $definition = new Definition;
		  	
		  $definition->term = $term;
		  $definition->definition = $definition_desc;
          $definition->categoryid = $categoryid;
		   
	      $setPicture = $this->uploadImage($image, $filename,'add');
		  if($setPicture)
		  {
		   $definition->photo = $filename;
		  }
		  
		  if( $item && strtolower($term) != strtolower($item->term))
		  { 
            $definition->save();
		  }
		 
		  else 
		   {
		   	  Log::info("ERROR: Add defintion - duplicate term ".$term);
		      return View::make('backoffice.definitions.add_definition')
		                 ->with('definition', $definition)
		                 ->with('error_data', 'Error: Duplicated Term '.$term);
		   }
		}
		else 
		{
		  $definition = Definition::find($id);	
		  if( strtolower($term) == strtolower($item->term) && $definition->id != $definition->id)
		  {
		  	Log::info("ERROR: Add defintion - duplicate term ".$term);
		  	return View::make('backoffice.definitions.edit_definition')
		                ->with('definition', $definition)
		                ->with('error_data', 'Error: Duplicated Term '.$term);
		  
		  }
		 else 
		 {
		    $definition->term = $term;
		    $definition->definition = $definition_desc;
            $definition->categoryid = $categoryid;
            
		 	$setPicture = $this->uploadImage($image, $filename, 'edit');
	        
		    if( $setPicture )
		    {
		       Log::info($filename);
		       $definition->photo = $filename;	
		    }
	
		    $definition->save();
		 }
		    
		}
		
        return Redirect::to('backoffice/definition/list');
	}
	
	
   public function uploadImage($image, $filename, $current_action)
	{
	    $success = false;
	    
	    Log::info("Filename: ".$filename);
        $extension = File::extension($filename);
		
        $rules = array('image' => 'image|max:1000');
		$inputs = array('image' => $image);
			 
		
		$path = ($current_action == "add") 
		  	      ? 'backoffice.definitions.add_definition'
		  	      : 'backoffice.definitions.edit_definition';
		  	         
		$validation = Validator::make($inputs, $rules);
		
		if( $validation->passes() && in_array(strtolower($extension), array('jpg','gif','png','jpeg','bmp'))) 
		 {

		  //Check if a file already exists before uploading.
		  if(File::exists('public/uploads/images/definitions/'.$filename))
		  {
		  	$success = false;
		  	Log::info('ERROR: File already exists...'.$filename);
		  	         
		  	return View::make($path)
		  	           ->with('error_data', 'Error: Image '. $filename.'already exists');
		  }
		  
		  //Upload the file
		  $img_upload = Input::upload('image', 'public/uploads/images/definitions', $filename);
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