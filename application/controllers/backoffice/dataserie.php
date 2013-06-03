<?php
class Backoffice_DataSerie_Controller extends Base_Controller {
	
	public $layout = 'layouts.container';
	  
    public function action_list()
	 {
	 	$startdate = Input::get('startdate');
	 	$enddate   = Input::get('enddate');
	 	
	 	if(isset($startdate) && isset($enddate))
	 	{
	 	  $dataseries = DataSerie::where('BeginDateTime', '=>', $startdate)
	 	                         ->where('BeginDateTime', '<=', $enddate)->get();
	 	                         
	 	  return View::make('backoffice.dataseries.list_dataseries');                       
	 	}
	   else	
	   {
	   	$dataseries = DataSerie::all();
	   	
        return View::make('backoffice.dataseries.list_dataseries')
                   ->with('dataseries', $dataseries);
	   }
	 }
	 
     public function action_edit($id)
	 {
	 	$ds = DataSerie::find($id);
        return View::make('backoffice.dataseries.edit_dataserie')->with('dataserie', $ds);
	 }
	 
     public function action_add()
	 {
        return View::make('backoffice.dataseries.add_dataserie');
	 }
	 
     public function action_delete($id)
	 {
	 	$ds = DataSerie::find($id);
	 	$ds->delete();
	 	
        return View::make('backoffice.dataseries.list_dataseries');
	 }
	 
    public function action_confirm_deletion($id)
	{
		
		return View::make('backoffice.dataseries.confirm_deletion_dataserie')->with('id', $id);
	}
	 
	 
     public function action_save()
	 {
	 	$id = Input::get('id');
	 	$seriecode = trim( Input::get('seriecode') );
	 	$variableid = Input::get('variable');
	 	$siteid = Input::get('site');
	 	$methodid = Input::get('method');
	 	$organizationid = Input::get('organization');
	 	$creationdate   = Input::get('creationdate');
	 	$begindate  = Input::get('begindate');
	 	$enddate    = Input::get('enddate');
	 	$lastupdate = Input::get('lastupdate');
	 	$isfinal    = Input::get('isfinal');
	 	$sample     = Input::get('sample');
	 	
	 	$item = DataSerie::where('SeriesCode','=', $seriecode)
	 	                  ->where('SiteID','=', $siteid)
	 	                  ->where('VariableID','=', $variableid)
	 	                  ->where('CreationMethodID','=', $methodid)->first();
	 	                       
	 	$item = ($item != null) ? $item : (new RangeCheckValue);
	 	
	 	if($id == 0)
	 	{
	 	  if( $item->seriescode != $seriecode 
	 	      && $item->siteid != $siteid 
	 	      && $item->variableid != $variableid 
	 	      && $item->methodid != $methodid)
	 	   {	
	 		$ds = new DataSerie;
	 		$ds->seriescode = $seriecode;
	 		$ds->siteid = $siteid;
	 		$ds->variableid = $variableid;
	 		$ds->creationmethodid = $methodid;
	 		$ds->organizationid = $organizationid;
	 		$ds->creationdatetime = $creationdate;
	 		$ds->begindatetime  = $begindate;
	 		$ds->enddatetime    = $enddate;
	 		$ds->lastupdatedatetime = $lastupdate;
	 		$ds->isfinal        = $isfinal;
	 		$ds->sampleid       = $sample;
	 		
	 		$ds->save();
	 	   }
	 	  else
	 	  {
	 	  	 return View::make('backoffice.dataseries.add_dataserie')
			                ->with('error_data', 'Error: Duplicated Serie');
	 	  }
	 	   	
	 	}
	 	else
	 	{
	 	    $ds = DataSerie::find($id);
	 	    if( (strtolower($item->seriescode) == strtolower($seriecode) 
	 	         && $item->siteid == $siteid 
	 	         && $item->variableid == $variableid 
	 	         && $item->methodid == $methodid) 
	 	         && $item->id != $id)
	 	      {
	 	      	return View::make('backoffice.dataseries.edit_dataserie')
			                ->with('error_data', 'Error: Duplicated Serie');
	 	      }
	 	    else
	 	    {      
	            $ds->seriescode = $seriecode;
		 		$ds->siteid = $siteid;
		 		$ds->variableid = $variableid;
		 		$ds->creationmethodid = $methodid;
		 		$ds->organizationid = $organizationid;
		 		$ds->creationdatetime = $creationdate;
		 		$ds->begindatetime  = $begindate;
		 		$ds->enddatetime    = $enddate;
		 		$ds->lastupdatedatetime = $lastupdate;
		 		$ds->isfinal        = $isfinal;
		 		$ds->sampleid         = $sample;
		 		
		 		$ds->save();             
	 	    }
	 	}
	 	
        return View::make('backoffice.dataseries.list_dataseries');
	 }

	 
	public function action_list_datavalues($dataserieid)
	{
		 $datavalues = RawDataValue::where('DataSeriesID','=', $dataserieid)->get();
		 
		 return View::make('backoffice.dataseries.list_datavalues')
		            ->with('datavalues', $datavalues);
	} 
	
	public function action_detail($id)
	{
		$datavalue = RawDataValue::find($id);
		
		return View::make('backoffice.dataseries.detail_datavalue')
		            ->with('datavalue', $datavalue);
	}
}

?>