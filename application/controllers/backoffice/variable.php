<?php
class Backoffice_Variable_Controller extends Base_Controller {
	
	public $layout = 'layouts.container';
	  
    public function action_list()
	{
        return View::make('backoffice.variables.list_variables');
	}
	
   public function action_edit($id)
	{
		$variable = Variable::find($id);
		
        return View::make('backoffice.variables.edit_variable')->with('variable', $variable);
	}
	
	
    public function action_delete($id)
	{
		$variable = Variable::find($id);
		$variable->delete();
		
        return View::make('backoffice.variables.list_variables');
	}
	
	
    public function action_confirm_variable_deletion($id)
	{
		
		return View::make('backoffice.variables.confirm_deletion_variable')->with('id', $id);
	}
	
	
    public function action_add()
	{
        return View::make('backoffice.variables.add_variable');
	}
	
	
    public function action_save()
    {
		$id = Input::get('id');
		$variablecode = trim(Input::get('variablecode'));
		$variablenameid = trim(Input::get('variablename'));
		$speciation   = trim(Input::get('speciation'));
		$unitsid      = trim(Input::get('units'));
		$samplemedium = trim(Input::get('samplemedium'));
		$valuetype    = trim(Input::get('valuetype'));
		$isregular    = Input::get('isregular');
		$timesupport  = Input::get('timesupport');
		$timeunitsid  = Input::get('timeunits');
		$datatype     = trim(Input::get('datatype'));
		$generalcategory = trim(Input::get('generalcategory'));
		$nodatavalue     = trim(Input::get('nodatavalue'));
		$isElectronic    = Input::get('iselectronic');
		
		$vnamecv = VariableName::find($variablenameid);
		$vnamecv = ($vnamecv != null) ? $vnamecv : (new VariableName);
		
		$item = Variable::where('variablecode','=', $variablecode)
		                ->where('variablename','=', $vnamecv->term)->first();

		$item = ($item != null) ? $item : (new Variable);
		                
		if($id == 0)
		{
			if(strtolower($variablecode) == strtolower($item->variablecode) && strtolower($vnamecv->term) == strtolower($item->variablename) )
			{
				 return View::make('backoffice.variables.add_variable')
			                ->with('variable', $variable)
			                ->with('error_data', 'Error: Duplicated name or code');
			}
			else
			{
				$variable = new Variable;
				$variable->variablecode = $variablecode;
				$variable->variablename = $vnamecv->term;
				$variable->variableunitsid = $unitsid;
				$variable->nodatavalue = $nodatavalue;
				$variable->speciation = Speciation::find($speciation)->term;
				$variable->valuetype  = ValueType::find($valuetype)->term;
				$variable->datatype   = DataType::find($datatype)->term;
				$variable->generalcategory = GeneralCategory::find($generalcategory)->term;
				$variable->samplemedium = SampleMedium::find($samplemedium)->term;
                $variable->timeunitsid = $timeunitsid;
				$variable->isregular = $isregular;
				$variable->timesupport = $timesupport;
				$variable->iselectronic = $isElectronic;
				
				$variable->save();
			}
		} 
		else 
		{
			$variable = Variable::find($id);
			
			if( strtolower($variablecode) == strtolower($item->variablecode) 
			    && strtolower($vnamecv->term) == strtolower($item->variablename) 
			    && $item->id != $variable->id)
			 {  
			   return View::make('backoffice.variables.edit_variable')
			                ->with('variable', $variable)
			                ->with('error_data', 'Error: Duplicated name or code');
			 
			 }
			else
			{
			    $variable->variablecode = $variablecode;
				$variable->variablename = $vnamecv->term;
				$variable->variableunitsid = $unitsid;
				$variable->nodatavalue = $nodatavalue;
				$variable->speciation = Speciation::find($speciation)->term;
				$variable->valuetype  = ValueType::find($valuetype)->term;
				$variable->datatype   = DataType::find($datatype)->term;
				$variable->generalcategory = GeneralCategory::find($generalcategory)->term;
				$variable->samplemedium = SampleMedium::find($samplemedium)->term;
                $variable->timeunitsid = $timeunitsid;
				$variable->isregular = $isregular;
				$variable->timesupport = $timesupport;
				$variable->iselectronic = $isElectronic;
			
			    $variable->save();
			}
		}               
		
        return View::make('backoffice.variables.list_variables');
	}
	
	
  /*------------------------------------- VARIABLE NAME CV ---------------------------------*/	
   public function action_list_variablenames()
   {
   	 return View::make('backoffice.variables.list_variablenames');
   }

   public function action_add_variablename()
   {
   	 return View::make('backoffice.variables.add_variablename');
   }
   
   public function action_edit_variablename($id)
   {
   	 $vname = VariableName::find($id);
   	 return View::make('backoffice.variables.edit_variablename')->with('variablename',$vname);
   }
   
   public function action_delete_variablename($id)
	{
		$variablename = VariableName::find($id);
		$variablename->delete();
		
        return View::make('backoffice.variables.list_variablenames');
	}
	
	
    public function action_confirm_deletion_variablename($id)
	{
		
		return View::make('backoffice.variables.confirm_deletion_variablename')->with('id', $id);
	}
	
	public function action_save_variablename()
	{
	  $id = Input::get('id');
	  $term = trim(Input::get('term'));
	  $definition = trim(Input::get('definition'));

	  $item = VariableName::where('Term','=', $term)->first();
	  $item = ($item != null) ? $item : (new VariableName);
	  
	  if($id == 0)
	  {
	  	if( strtolower($item->term) != strtolower($term) )
	  	{
	  		$name = new VariableName;
	  	    $name->term = $term;
	  	    $name->definition = $definition;
	  	    $name->save();
	  	}
	  	else
	  	{
	  	  return View::make('backoffice.variables.add_variablename')
			                ->with('error_data', 'Error: Duplicated term');	
	  	}
	  }
	  else
	  {
	  	$name = VariableName::find($id);
	  	if( strtolower($item->term) == strtolower($term) && $item->id != $name->id)
	  	{
	  		return View::make('backoffice.variables.edit_variablename')
	  		                ->with('variablename', $name)
			                ->with('error_data', 'Error: Duplicated term');	
	  	}
	  	else 
	  	{
		  	$name->term = $term;
		  	$name->definition = $definition;
		  	$name->save();
	  	}
	  }
	  
	  return View::make('backoffice.variables.list_variablenames');	
	}
	
	
	
  /*------------------------------------  UNITS  METHODS -----------------------------------*/		
    public function action_list_units()
	{
        return View::make('backoffice.units.list_units');
	}
	

   public function action_edit_unit($id)
	{
		$unit = Unit::find($id);
		
        return View::make('backoffice.units.edit_unit')->with('unit', $unit);
	}
	
	
    public function action_add_unit()
	{
		
        return View::make('backoffice.units.add_unit');
	}
	
	
    public function action_delete_unit($id)
	{
		$unit = Unit::find($id);
		$unit->delete();
		
        return View::make('backoffice.units.list_units');
	}
	
	
    public function action_confirm_deletion_unit($id)
	{
		
		return View::make('backoffice.units.confirm_deletion_unit')->with('id', $id);
	}
	
    public function action_save_unit()
    {
		$id = Input::get('id');
		$unit_name = trim(Input::get('unitsname'));
		$unit_type = trim(Input::get('unitstype'));
		$abbreviation = trim(Input::get('abbreviation'));
		
		$item = Unit::where('UnitsName', '=', $unit_name)->first();
		$item = ($item != null) ? $item : (new Unit);
		
		if($id == 0)
		{
			if( strtolower($item->unitsname) != strtolower($unit_name) )
			{
			  $unit = new Unit;
			  $unit->unitsname = $unit_name;
			  $unit->unitstype = $unit_type;
			  $unit->unitsabbreviation = $abbreviation;
			
			  $unit->save();
			}
			else 
			{
				return View::make('backoffice.units.add_unit')
			                ->with('error_data', 'Error: Duplicated Unit');
			}
		}
		else 
		{
			$unit = Unit::find($id);
			if(strtolower($unit->unitsname) == strtolower($unit_name) && $unit->id != $item->id )
			{
				return View::make('backoffice.units.add_unit')
			                ->with('unit', $unit)
			                ->with('error_data', 'Error: Duplicated Unit');
			}
			else
			{
			  $unit->unitsname = $unit_name;
			  $unit->unitstype = $unit_type;
			  $unit->unitsabbreviation = $abbreviation;
			
			  $unit->save();
			}
		}
		
        return View::make('backoffice.units.list_units');
	}
	
	/*------------------------------------- OFFSET TYPES  -------------------------------------*/
	
    public function action_list_offsettypes()
	{
        return View::make('backoffice.units.list_offsettypes');
	}
	
	
   public function action_add_offsettype()
	{	
        return View::make('backoffice.units.add_offsettype');
	}

	
    public function action_edit_offsettype($id)
	{
		$offset = OffsetType::find($id);
		
        return View::make('backoffice.units.edit_offsettype')->with('offset', $offset);
	}
	
	
    public function action_delete_offsettype($id)
	{
		$offset = OffsetType::find($id);
		$offset->delete();
		
        return View::make('backoffice.units.list_offsettypes');
	}
	
	
    public function action_confirm_deletion_offsettype($id)
	{
		
		return View::make('backoffice.units.confirm_deletion_offsettype')->with('id', $id);
	}
	
	
    public function action_save_offsettype()
    {

		$id = Input::get('id');
		$unitid = Input::get('unitsid');
		$description = trim(Input::get('description'));
		
		$item = OffsetType::where('OffsetDescription', '=', $description)->first();
		$item = ($item != null) ? $item : (new OffsetType);
		
		if($id == 0)
		{
			if(strtolower($item->offsetdescription) == strtolower($description) )
			{
               return View::make('backoffice.units.add_offsettype')->with('error_data', 'Error: Duplicated offset');
				
			}
			else
			{
			  $offset = new OffsetType;
			  $offset->offsetunitsid = $unitid;
			  $offset->offsetdescription = $description;
			
			  $offset->save();
			} 
		}
		else 
		{
			$offset = OffsetType::find($id);
		  
			if((strtolower($description) == strtolower($item->offsetdescription)) && ($offset->id != $item->id))
			{
              return View::make('backoffice.units.add_offsettype')->with('error_data', 'Error: Duplicated offset');
				
			}
			else 
			{
			  $offset->offsetunitsid = $unitid;
			  $offset->offsetdescription = $description;
			
			  $offset->save();
			}
		}
		
        return View::make('backoffice.units.list_offsettypes');
	}
}
?>