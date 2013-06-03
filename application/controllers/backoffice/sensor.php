<?php
class Backoffice_Sensor_Controller extends Base_Controller {
	
	public $layout = 'layouts.container';
	  
    public function action_list()
	 {

	 	return View::make('backoffice.sensors.list_sensors');                       
	 }
	 
     public function action_edit($id)
	 {
	 	$fs = FieldSensor::find($id);
        return View::make('backoffice.sensors.edit_sensor')->with('fs', $fs);
	 }
	 
	 
     public function action_add()
	 {
        return View::make('backoffice.sensors.add_sensor');
	 }
	 
     public function action_delete($id)
	 {
	 	$fs = FieldSensor::find($id);
	 	$fs->delete();
	 	
        return View::make('backoffice.sensors.list_sensors');
	 }
	 
    public function action_confirm_deletion($id)
	{
		
		return View::make('backoffice.sensors.confirm_deletion_sensor')->with('id', $id);
	}
	 
	 
     public function action_save()
	 {
	 	$id = Input::get('id');
	 	$sensorcode   = trim( Input::get('sensorcode') );
	 	$serialnumber = trim(Input::get('serialnumber'));
	 	$sensorname   = trim(Input::get('sensorname'));
	 	$model        = trim(Input::get('model'));
	 	$sensoryear   = trim(Input::get('sensoryear'));
	 	$company      = trim(Input::get('company'));
	 	$description  = trim(Input::get('description'));
	 	$responsetime = trim(Input::get('responsetime'));
	 	$accuracy     = trim(Input::get('accuracy'));
	 	$resolution   = trim(Input::get('resolution'));
	 	$range        = trim( Input::get('range') );
	 	
	 	$item = FieldSensor::where('SensorCode','=', $sensorcode)
	 	                   ->where('SerialNumber','=', $serialnumber)
	 	                   ->where('SensorName','=', $sensorname)->first();
	 	                       
	 	$item = ($item != null) ? $item : (new FieldSensor);
	 	
	 	if($id == 0)
	 	{
	 	  if( strtolower($item->sensorcode) != strtolower($sensorcode) 
	 	       && strtolower($item->serialnumber) != strtolower($serialnumber) && strtolower($item->sensorname) != strtolower($sensorname))
	 	   {	
	 	   	    $fs =  new FieldSensor;
	 	   	    $fs->sensorcode   = $sensorcode;
		 		$fs->serialnumber = $serialnumber;
		 		$fs->sensorname   = $sensorname;
		 		$fs->model        = $model;
		 		$fs->sensoryear = $sensoryear;
		 		$fs->company    = $company;
		 		$fs->description  = $description;
		 		$fs->responsetime = $responsetime;
		 		$fs->accuracy     = $accuracy;
		 		$fs->resolution   = $resolution;
		 		$fs->range        = $range;
		 		
		 		$fs->save(); 	
	 	   }
	 	  else
	 	  {
	 	  	 return View::make('backoffice.sensors.add_sensor')
			                ->with('error_data', 'Error: Duplicated Sensor');
	 	  }
	 	   	
	 	}
	 	else
	 	{
	 	    $fs = FieldSensor::find($id);
	 	    if((strtolower($item->sensorcode) == strtolower($sensorcode) 
	 	        || strtolower($serialnumber) == strtolower($item->serialnumber)
	 	        || strlower($sensorname) == strtolower($item->sensorname))
	 	         && $item->id != $fs->id)
	 	      {
	 	      	return View::make('backoffice.sensors.edit_sensor')
			                ->with('error_data', 'Error: Duplicated Sensor')->with('fs',$fs);
	 	      }
	 	    else
	 	    {      
		 		$fs->sensorcode   = $sensorcode;
		 		$fs->serialnumber = $serialnumber;
		 		$fs->sensorname   = $sensorname;
		 		$fs->model        = $model;
		 		$fs->sensoryear = $sensoryear;
		 		$fs->company    = $company;
		 		$fs->description  = $description;
		 		$fs->responsetime = $responsetime;
		 		$fs->accuracy     = $accuracy;
		 		$fs->resolution   = $resolution;
		 		$fs->range        = $range;
		 		
		 		$fs->save();             
	 	    }
	 	}
	 	
        return View::make('backoffice.sensors.list_sensors');
	 }

	/*-------------------------------------- FS Types CV --------------------------------------------------------*/
	  
	public function action_list_fstypescv()
	{
		 
		 return View::make('backoffice.sensors.list_fstypescv');
	} 
	
	public function action_edit_fstypecv($id)
	{
		$fstypecv = FSTypeCV::find($id);
		return View::make('backoffice.sensors.edit_fstypecv')->with('fstypecv', $fstypecv);
	}
	
	
	public function action_add_fstypecv()
	{
		return View::make('backoffice.sensors.add_fstypecv');
	}
	
	public function action_delete_fstypecv($id)
	{
		$fstype = FSTypeCV::find($id);
		$fstype->delete();
		
		return View::make('backoffice.sensors.list_fstypescv');
	}
	
	public function action_confirm_deletion_fstypecv($id)
	{
		
		return View::make('backoffice.sensors.confirm_deletion_fstypecv')->with('id', $id);
	}
	 
	 
    public function action_save_fstypecv()
	 {
	 	$id = Input::get('id');
	 	$term = trim( Input::get('term') );
	 	$definition = trim( Input::get('definition') );
	 	
	 	$item = FSTypeCV::where('Term','=', $term)->first();
	 	$item = ($item != null) ? $item : (new FSTypeCV);
	 	
	 	if($id == 0)
	 	{
	 		if(strtolower($item->term) != strtolower($term))
	 		{
		 	  $fstypecv = new FSTypeCV;
		 	  $fstypecv->term = $term;
		 	  $fstypecv->definition = $definition;
	
		 	  $fstypecv->save();
	 		}
	 	   else
	 	   {
	 	   	 return View::make('backoffice.sensors.add_fstypecv')
			            ->with('error_data', 'Error: Duplicated FSType CV');
	 	   }
	 	}
	 	else
	 	{
	 		$fstypecv = FSTypeCV::find($id);
	 		if( strtolower($item->term) == strtolower($term) && $item->id != $fstypecv->id)
	 		{
	 			return View::make('backoffice.sensors.edit_fstypecv')
			            ->with('error_data', 'Error: Duplicated FSType CV')->with('fstypecv', $fstypecv);
	 		}
	 		else
	 		{
		 	    $fstypecv->term = $term;
		 	    $fstypecv->definition = $definition;
	
		 	    $fstypecv->save();
	 		}
	 	}
	 	
	  return View::make('backoffice.sensors.list_fstypescv');	
	 
	 }
	 
	 
  /*--------------------------------------- FS Types  Relationship ----------------------------------------------------*/
	 
	 
    public function action_list_fstypes()
	{
		 
		 return View::make('backoffice.sensors.list_fstypes');
	} 
	
	public function action_edit_fstype($id)
	{
		$fstype = FSType::find($id);
		return View::make('backoffice.sensors.edit_fstype')->with('fstype', $fstype);
	}
	
	
	public function action_add_fstype()
	{
		return View::make('backoffice.sensors.add_fstype');
	}
	
	public function action_delete_fstype($id)
	{
		$fstype = FSType::find($id);
		$fstype->delete();
		
		return View::make('backoffice.sensors.list_fstypes');
	}
	
	public function action_confirm_deletion_fstype($id)
	{
		
		return View::make('backoffice.sensors.confirm_deletion_fstype')->with('id', $id);
	}
	 
	 
    public function action_save_fstype()
	 {
	 	$id = Input::get('id');
	 	$sensorid = trim( Input::get('sensorid') );
	 	$sensortypeid = trim( Input::get('sensortypeid') );
	 	
	 	$item = FSType::where('SensorID','=', $sensorid)
	 	              ->where('SensorTypeID','=',$sensortypeid)->first();
	 	              
	 	$item = ($item != null) ? $item : (new FSType);
	 	
	 	if($id == 0)
	 	{
	 		if( $item->sensorid != strtolower($sensorid) && $item->sensortypeid != $sensortypeid )
	 		{
		 	  $fstype = new FSType;
		 	  $fstype->sensorid = $sensorid;
		 	  $fstype->sensortypeid = $sensortypeid;
	
		 	  $fstype->save();
	 		}
	 	   else
	 	   {
	 	   	 return View::make('backoffice.sensors.add_fstype')
			            ->with('error_data', 'Error: Duplicated FSType');
	 	   }
	 	}
	 	else
	 	{
	 		$fstype = FSType::find($id);
	 		if( $item->sensorid == $sensorid && $item->sensortypeid == $sensortypeid && $item->id != $fstype->id)
	 		{
	 			return View::make('backoffice.sensors.edit_fstype')
			            ->with('error_data', 'Error: Duplicated FSType')->with('fstype', $fstype);
	 		}
	 		else
	 		{
		 	  $fstype->sensorid = $sensorid;
		 	  $fstype->sensortypeid = $sensortypeid;
	
		 	  $fstype->save();
	 		}
	 	}
	 	
	  return View::make('backoffice.sensors.list_fstypes');	
	 
	 }
	 
 /**--------------------------------------------------- FS Deployments ------------------------------------------*/
	 
	 public function action_list_fsdeployments()
	 {
	 	 return View::make('backoffice.sensors.list_fsdeployments');	
	 }
	 
	 
	 public function action_add_fsdeployment()
	 {
	 	return View::make('backoffice.sensors.add_fsdeployment');	
	 }
	 
	 
	 
	 public function action_edit_fsdeployment($id)
	 {
	 	$deploy = FieldSensorDeployment::find($id);
	 	
	 	return View::make('backoffice.sensors.edit_fsdeployment')->with('deploy', $deploy);
	 }
	 
	 
	 
	 public function action_delete_fsdeployment($id)
	 {
	    $deploy = FieldSensorDeployment::find($id);
	    $deploy->delete();
	    
	    return View::make('backoffice.sensors.list_fsdeployments');
	 }
	 
	 
	public function action_confirm_deletion_fsdeployment($id)
	{
		
		return View::make('backoffice.sensors.confirm_deletion_fsdeployment')->with('id', $id);
	}
	
	public function action_save_fsdeployment()
	{
		$id = Input::get('id');
		$sensorid  = Input::get('sensorid');
		$begindate = trim(Input::get('begindatetime'));
		$enddate   = trim(Input::get('enddatetime'));
		$contactid = Input::get('contactid');
		
		$item = FieldSensorDeployment::where('SensorID','=', $sensorid)
		                             ->where('BeginDateTime','=', $begindate)
		                             ->where('EndDateTime','=', $enddate)->first();
		                             
		$item = ($item != null) ? $item : (new FieldSensorDeployment);
		if($id == 0)
		{
			if($item->sensorid != $sensorid && $item->begindatetime != $begindate && $item->enddatetime != $enddate)
			{
				$deploy = new FieldSensorDeployment;
				$deploy->sensorid       = $sensorid;
				$deploy->begindatetime  = $begindate;
				$deploy->enddatetime    = $enddate;
				$deploy->deploymentbyid = $contactid;
				
				$deploy->save();
			}
		   else 
			{
			  	return View::make('backoffice.sensors.add_fsdeployment')
			               ->with('error_data', 'Error: Duplicated Deployment');
			}
		}
		else 
		{
			$deploy = FieldSensorDeployment::find($id);
			
			if($item->sensorid == $sensorid && $item->begindatetime == $begindate && $item->enddatetime = $enddate && $item->id != $id)
			{
				return View::make('backoffice.sensors.edit_fsdeployment')
			               ->with('error_data', 'Error: Duplicated Deployment')
			               ->with('deploy',$item);
			}
		   else 
		   {
		   	    $deploy->sensorid       = $sensorid;
				$deploy->begindatetime  = $begindate;
				$deploy->enddatetime    = $enddate;
				$deploy->deploymentbyid = $contactid;
				
				$deploy->save(); 
		   }	
			
		}
		
		return View::make('backoffice.sensors.list_fsdeployments');	
	}

}

?>