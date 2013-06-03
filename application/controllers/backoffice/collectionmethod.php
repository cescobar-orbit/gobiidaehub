<?php
class Backoffice_CollectionMethod_Controller extends Base_Controller {
	
	public $layout = 'layouts.container';

	
        
    public function action_list()
	{
        return View::make('backoffice.collectionmethods.list_methods');
	}
	
	
	public function action_edit($id)
	{
		$method = Method::find($id);
		
		return View::make('backoffice.collectionmethods.edit_method')
		           ->with('method', $method);
	}
	
	public function action_add()
	{
		return View::make('backoffice.collectionmethods.add_method');
	}
	
	public function action_delete($id)
	{
		$method = Method::find($id);
		$method->delete();
		
		return View::make('backoffice.collectionmethods.list_methods');
	}
	
	public function action_confirm_deletion_method($id)
	{
		
		return View::make('backoffice.collectionmethods.confirm_deletion_method')->with('id', $id);
	}
	
	public function action_save()
	{
		$id = Input::get('id');
        $description = trim(Input::get('description'));
        $link = Input::get('methodlink');        
        
        $item = Method::where('MethodDescription', '=', $description)->first();
        $item = ($item != null)? $item:(new Method);
        
		if($id == 0)
		{
		   if($item != null && strtolower($item->methoddescription) == strtolower($description))
		      return View::make('backoffice.collectionmethods.add_method')
		                 ->with('error_data', 'Error: Duplicated method');
		   
		   else 
		   {
			   $method = new Method;
			
			   $method->methoddescription = $description;
			   $method->methodlink = $link;	   
			
			   $method->save();
		   }
		}
		else if($id != 0)
		{
		  $method = Method::find($id);

		  if((strtolower($description) == strtolower($item->methoddescription)) && ($method->id != $item->id))
		     return View::make('backoffice.collectionmethods.edit_method')
		                ->with('method', $method)->with('error_data', 'Error: Duplicated description');
		  
		  else
		  {
			  $method->methoddescription = $description;
			  $method->methodlink = $link;
			  $method->save();
		  }
		}  
		return View::make('backoffice.collectionmethods.list_methods');
	}
	
	
	/*-------------------------------------------- LAB METHODS  --------------------------------------------------------*/
	public function action_list_labmethods()
	{
        return View::make('backoffice.collectionmethods.list_labmethods');
	}
	
	
	
	public function action_delete_labmethod($id)
	{
		$labmethod = LabMethod::find($id);
		$labmethod->delete();
		
        return View::make('backoffice.collectionmethods.list_labmethods');
	}
	
	
	
	public function action_confirm_deletion_labmethod($id)
	{
		
		return View::make('backoffice.collectionmethods.confirm_deletion_labmethod')->with('id', $id);
	}
	
	
	public function action_add_labmethod()
	{
        return View::make('backoffice.collectionmethods.add_labmethod');
	}
	
	
	
	public function action_edit_labmethod($id)
	{
		$labmethod = LabMethod::find($id);
        return View::make('backoffice.collectionmethods.edit_labmethod')->with('labmethod', $labmethod);
	}
	
	
	
	public function action_save_labmethod()
	{
		$id = Input::get('id');
        $labname = trim(Input::get('labname'));
        $laborganization = trim(Input::get('labmethodorganization'));
        $methodname  = trim(Input::get('labmethodname'));
        $description = trim(Input::get('labmethoddescription'));
        $methodlink  = trim(Input::get('labmethodlink'));
        
        $item = LabMethod::where('LabName','=',$labname)
                         ->where('LabOrganization','=', $laborganization)
                         ->where('LabMethodName','=', $methodname)->first();
                         
        $item = ($item != null) ? $item : (new LabMethod);
		 
        if($id == 0)
		{
		   if(strtolower($item->labname) == strtolower($labname) 
		      && strtolower($item->laborganization) == strtolower($laborganization) 
		      && strtolower($item->labmethodname) == strtolower($methodname))
		   {
		   	   return View::make('backoffice.collectionmethods.add_labmethod')->with('error_data', 'Error: Lab name is duplicated');  	   
		   }
		   
		   else 
		   {   
		   	   $labmethod = new LabMethod;		   
			   $labmethod->labname = $labname;	   
			   $labmethod->laborganization = $laborganization;	
			   $labmethod->labmethodname   = $methodname;
			   $labmethod->labmethoddescription  = $description;		
			   $labmethod->labmethodlink   = $methodlink;	
			   
			   $labmethod->save();
		   }
		}
		else
		{
	      $labmethod = LabMethod::find($id);
	      	
		  if(strtolower($item->labname) == strtolower($labname) 
		      && strtolower($item->laborganization) == strtolower($laborganization) 
		      && strtolower($item->labmethodname) == strtolower($methodname) && $item->id != $id)
		      	
		     return View::make('backoffice.collectionmethods.edit_labmethod')->with('labmethod', $labmethod)->with('error_data', 'Error: Lab name is duplicated'); 
		  
		  else 
		  {  	   
			   $labmethod->labname = $labname;	   
			   $labmethod->laborganization = $laborganization;	
			   $labmethod->labmethodname   = $methodname;
			   $labmethod->labmethoddescription  = $description;		
			   $labmethod->labmethodlink   = $methodlink;	
			   
			   $labmethod->save();
		  }
		  
		}  
		
        return View::make('backoffice.collectionmethods.list_labmethods');
	}
/*---------------------------------------------  SAMPLES ----------------------------------------------*/

   public function action_list_samples()
   {
   	 return View::make('backoffice.collectionmethods.list_samples');
   }

   
   public function action_add_sample()
   {
   	  return View::make('backoffice.collectionmethods.add_sample');
   }
   
   
   public function action_edit_sample($id)
   {
   	  $sample = Sample::find($id);
   	  return View::make('backoffice.collectionmethods.edit_sample')->with('sample',$sample);
   }
   
   public function action_delete_sample($id)
   {
   	 $sample =  Sample::find($id);
   	 $sample->delete();
   	 
   	 return View::make('backoffice.collectionmethods.list_samples');
   }
   
	public function action_confirm_deletion_sample($id)
	{
		
		return View::make('backoffice.collectionmethods.confirm_deletion_sample')->with('id', $id);
	}
	
	public function action_save_sample()
	{
		$id = Input::get('id');
		$sampletypeid = Input::get('sampletype');
		$labmethod =  Input::get('labmethod');
		$labsamplecode = trim(Input::get('labsamplecode'));
		
		$sampletype = SampleType::find($sampletypeid)->term;
		
		$item = Sample::where('SampleType','=',$sampletype)
		              ->where('LabSampleCode','=', $labsamplecode)
		              ->where('LabMethodID','=', $labmethod)->first();
		              
		$item = ($item != null) ? $item : (new Sample);
		
		if($id == 0)
		{
			if(strtolower($item->sampletype) == strtolower($sampletype) 
			   && strtolower($item->labsamplecode) == strtolower($labsamplecode) 
			   && strtolower($labmethod) == $item->labmethodid)
			   {
			   	 return View::make('backoffice.collectionmethods.add_sample')
			   	            ->with('error_data', 'Error: Sample is duplicated'); 
			   }
		   else 
		   {
		   		$sample = new Sample;
			   	$sample->sampletype = $sampletype;
			   	$sample->labmethodid = $labmethod;
			   	$sample->labsamplecode = $labsamplecode;
			   	
			    $sample->save();
		   } 
		}
		else
		{
			$sample = Sample::find($id);
			if(strtolower($item->sampletype) == strtolower($sampletype) 
			   && strtolower($item->labsamplecode) == strtolower($labsamplecode) 
			   && strtolower($labmethod) == $item->labmethodid 
			   && $sample->id != $id)	
			   {
			   	 return View::make('backoffice.collectionmethods.edit_sample')
			   	            ->with('sample', $sample)->with('error_data', 'Error: Sample is duplicated'); 
			   	
			   }
			else 
			{
			   	$sample->sampletype = $sampletype;
			   	$sample->labmethodid = $labmethod;
			   	$sample->labsamplecode = $labsamplecode;
			   	
			    $sample->save();
			}
		}
	 
	  return View::make('backoffice.collectionmethods.list_samples');	
	}
	
 /*------------------------------------------ SAMPLE TYPE CV ------------------------------------------*/
	
	public function action_list_sampletypes()
	{
		return View::make('backoffice.collectionmethods.list_sampletypescv');
	}
	
	public function action_add_sampletype()
	{
		return View::make('backoffice.collectionmethods.add_sampletypecv');
	}
	
	public function action_edit_sampletype($id)
	{
		$sampletype = SampleType::find($id);
		return View::make('backoffice.collectionmethods.edit_sampletypecv')->with('sampletype',$sampletype);
	}
	
	public function action_delete_sampletype($id)
	{
		$sampletype = SampleType::find($id);
		$sampletype->delete();
		
		return View::make('backoffice.collectionmethods.list_sampletypescv');
	}
	
	public function action_confirm_deletion_sampletype($id)
	{
		
		return View::make('backoffice.collectionmethods.confirm_deletion_sampletype')->with('id', $id);
	}
	
	public function action_save_sampletype()
	{
		$id = Input::get('id');
		$term = trim( Input::get('term') );
		$definition = trim(Input::get('definition'));
		
		$item = SampleType::where('Term','=', $term)->first();
		$item = ($item != null) ? $item : (new SampleType);
		
		if($id == 0)
		{
		 if(strtolower($term) != strtolower($item->term))
		 {
		 	$sampletype = new SampleType;
		 	$sampletype->term = $term;
		 	$sampletype->definition = $definition;
		 	
		 	$sampletype->save();
		 } 	
		 else
		 {
		 	return View::make('backoffice.collectionmethods.add_sampletypecv')
		 	           ->with('error_data', 'Error: Sample Type is duplicated');  	
		 }
		}
		else 
		{
			$sampletype = SampleType::find($id);
			if((strtolower($term) == strtolower($sampletype->term)) && $id != $sampletype->id)
			{
				return View::make('backoffice.collectionmethods.edit_sampletypecv')
				           ->with('sampletype', $sampletype)
				           ->with('error_data', 'Error: Sample Type is duplicated');  	
			}
			else
			{
			 	$sampletype->term = $term;
			 	$sampletype->definition = $definition;
			 	
			 	$sampletype->save();
			}
		}
		
		return View::make('backoffice.collectionmethods.list_sampletypescv');
	}
	
}

?>