<?php
class Backoffice_QualityControl_Controller extends Base_Controller {
	
	public $layout = 'layouts.container';
	  
    public function action_list_rangechecks()
	 {
        return View::make('backoffice.qaqc.list_rangechecks');
	 }
	 
     public function action_edit_rangecheck($id)
	 {
	 	$rcv = RangeCheckValue::find($id);
        return View::make('backoffice.qaqc.edit_rangecheck')->with('range', $rcv);
	 }
	 
     public function action_add_rangecheck()
	 {
        return View::make('backoffice.qaqc.add_rangecheck');
	 }
	 
     public function action_delete_rangecheck($id)
	 {
	 	$rcv = RangeCheckValue::find($id);
	 	$rcv->delete();
	 	
        return View::make('backoffice.qaqc.list_rangechecks');
	 }
	 
    public function action_confirm_deletion_rangecheck($id)
	{
		
		return View::make('backoffice.qaqc.confirm_deletion_rangecheck')->with('id', $id);
	}
	 
	 
     public function action_save_rangecheck()
	 {
	 	$id = Input::get('id');
	 	$variableid = Input::get('variableid');
	 	$siteid = Input::get('siteid');
	 	$methodid = Input::get('methodid');
	 	$lowerlimit = Input::get('lowerlimit');
	 	$upperlimit = Input::get('upperlimit');
	 	
	 	$item = RangeCheckValue::where('SiteID','=', $siteid)
	 	                       ->where('VariableID','=', $variableid)
	 	                       ->where('MethodID','=', $methodid)->first();
	 	                       
	 	$item = ($item != null) ? $item : (new RangeCheckValue);
	 	
	 	if($id == 0)
	 	{
	 	  if( $item->siteid != $siteid && $item->variableid != $variableid && $item->methodid != $methodid)
	 	   {	
	 		$range = new RangeCheckValue;
	 		$range->siteid = $siteid;
	 		$range->variableid = $variableid;
	 		$range->methodid = $methodid;
	 		$range->lowerlimit = $lowerlimit;
	 		$range->upperlimit = $upperlimit;
	 		
	 		$range->save();
	 	   }
	 	  else
	 	  {
	 	  	 return View::make('backoffice.qaqc.add_rangecheck')
			                ->with('error_data', 'Error: Duplicated Site or Variable or Method');
	 	  }
	 	   	
	 	}
	 	else
	 	{
	 	    $range = RangeCheckValue::find($id);
	 	    if( ($item->siteid == $siteid && $item->variableid == $variableid && $item->methodid == $methodid) 
	 	        && $item->id != $id)
	 	      {
	 	      	return View::make('backoffice.qaqc.edit_rangecheck')
			                ->with('error_data', 'Error: Duplicated Site or Variable or Method');
	 	      }
	 	    else
	 	    {      
		 		$range->siteid = $siteid;
		 		$range->variableid = $variableid;
		 		$range->methodid = $methodid;
		 		$range->lowerlimit = $lowerlimit;
		 		$range->upperlimit = $upperlimit;
		 		
		 		$range->save();
	 	    }
	 	}
	 	
        return View::make('backoffice.qaqc.list_rangechecks');
	 }
	 
/*----------------------------------  QUALIFIERS ---------------------------------*/	 
	 
     public function action_list_qualifiers()
	 {
        return View::make('backoffice.qaqc.list_qualifiers');
	 }
	 
     public function action_edit_qualifier($id)
	 {
	 	$qualifier = Qualifier::find($id);
        return View::make('backoffice.qaqc.edit_qualifier')->with('qualifier', $qualifier);
	 }
	 
     public function action_delete_qualifier($id)
	 {
	 	$qualifier = Qualifier::find($id);
	 	$qualifier->delete();
	 	
        return View::make('backoffice.qaqc.list_qualifiers');
	 }
	 
    public function action_confirm_deletion_qualifier($id)
	{
		
		return View::make('backoffice.qaqc.confirm_deletion_qualifier')->with('id', $id);
	}
	
	
	 
     public function action_add_qualifier()
	 {
        return View::make('backoffice.qaqc.add_qualifier');
	 }
	 
     public function action_save_qualifier()
	 {
	 	$id = Input::get('id');
	 	$code = trim( Input::get('qualifiercode') );
	 	$description = trim( Input::get('description') );
	 	
	 	$item = Qualifier::where('QualifierCode','=', $code)->first();
	 	$item = ($item != null) ? $item : (new Qualifier);
	 	
	 	if($id == 0)
	 	{
	 	  if( strtolower($item->qualifiercode) != strtolower($code) )
	 	  {
	 		$q = new Qualifier;
	 		$q->qualifiercode = $code;
	 		$q->qualifierdescription = $description;
	 		$q->save();
	 	  }
	 	  else
	 	  {
	 	  	return View::make('backoffice.qaqc.add_qualifier')
			                ->with('error_data', 'Error: Duplicated Qualifier Code');
	 	  }	
	 	}
	 	else
	 	{
	 		$q = Qualifier::find($id);
	 		
	 		if( strtolower($item->qualifiercode) == strtolower($code) && $item->id != $id )
	 		{
	 			return View::make('backoffice.qaqc.edit_qualifier')
	 			            ->with('qualifier', $item)
			                ->with('error_data', 'Error: Duplicated Qualifier Code');
	 		}
	 		else 
	 		{
	 		  $q->qualifiercode = $code;
	 		  $q->qualifierdescription = $description;
	 		  $q->save();
	 		}  
	 	}
	 	
        return View::make('backoffice.qaqc.list_qualifiers');
	 }
	 
/*------------------------------------------  Quality Control Levels -----------------------------*/	 
     public function action_list()
	 {
	 	
        return View::make('backoffice.qaqc.list_qclevels');
	 }
	 
	 
     public function action_edit($id)
	 {
	 	$qclevel = QualityControlLevel::find($id);
        return View::make('backoffice.qaqc.edit_qclevel')->with('qclevel', $qclevel);
	 }
	 
     public function action_add()
	 {
        return View::make('backoffice.qaqc.add_qclevel');
	 }
	 
     public function action_delete($id)
	 {
	 	$qclevel = QualityControlLevel::find($id);
	 	$qclevel->delete();
	 	
        return View::make('backoffice.qaqc.list_qclevels');
	 }
	 
	 
    public function action_confirm_deletion($id)
	{
		
		return View::make('backoffice.qaqc.confirm_deletion_qclevel')->with('id', $id);
	}
	 
     public function action_save()
	 {
        $id = Input::get('id');
        $code = trim( Input::get('qclevelcode') );
        $definition   = trim( Input::get('definition') );
        $explanation = trim( Input::get('explanation') );
        
        $item = QualityControlLevel::where('QualityControlLevelCode','=',$code)->first();
        $item = ($item != null) ? $item : (new QualityControlLevel);
        
        if($id == 0)
        {
        	if(strtolower($item->qualitycontrollevelcode) != strtolower($code) )
        	{ 
	        	$qc = new QualityControlLevel;
	        	$qc->qualitycontrollevelcode = $code;
	        	$qc->definition = $definition;
	        	$qc->explanation = $explanation;
	        	
	        	$qc->save();
        	}
        	else 
        	{
        	  	return View::make('backoffice.qaqc.add_qclevel')
			                ->with('error_data', 'Error: Duplicated Code');	
        	}
        }
        else 
        {
        	$qc = QualityControlLevel::find($id);
        	
        	if( strtolower($qc->qualitycontrollevelcode) == $code && $qc->id != $item->id)
        	{
        	   return View::make('backoffice.qaqc.edit_qclevel')
	 			          ->with('qclevel', $qc)
			              ->with('error_data', 'Error: Duplicated Code');
        	}
        	else 
        	{
	        	$qc->qualitycontrollevelcode = $code;
	        	$qc->definition = $definition;
	        	$qc->explanation = $explanation;
	        	
	        	$qc->save();
        	}
        }
        
        return View::make('backoffice.qaqc.list_qclevels');
	 }
}

?>