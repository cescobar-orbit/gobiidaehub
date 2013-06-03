<?php
class Backoffice_Location_Controller extends Base_Controller {
	
	public $layout = 'layouts.container';
	  
    public function action_list()
	{
        return View::make('backoffice.locations.list_locations');
	}
	
    public function action_edit($id)
	{
		$stat = location::find($id);
        return View::make('backoffice.locations.edit_location')->with('stat', $stat);
	}
	
    public function action_delete($id)
	{
		$location  = location::find($id);
		$location->delete();
        return View::make('backoffice.locations.list_locations');
	}
	
	public function action_confirm_deletion($id)
	{
		
		return View::make('backoffice.locations.confirm_deletion_location')->with('id', $id);
	}
	
	
    public function action_add()
	{
        return View::make('backoffice.locations.add_location');
	}
	
    public function action_save()
	{
		$id = Input::get('id');
		$location_name = trim(Input::get('locationname'));
		$location_code = trim(Input::get('locationcode'));
		
		if($id == 0)
		{
		  $item = Location::where('locationcode', '=', $location_code)
		                 ->or_where('locationname','=',$location_name)->first();	
		  
		  $item = ($item != null) ? $item : (new Location);
		  
		  if($location_name != $item->locationname && $location_code != $item->locationcode)
		  {
		  	$stat = new Location;
		    $stat->locationname = $location_name;
		    $stat->locationcode = $location_code;	
		    $stat->save();
		  }
		   else 
		      return View::make('backoffice.locations.add_location')->with('error_data', 'Error: Duplicated name or code');
		  
		}
		else 
		{
		  $stat = Location::find($id);	
		  if($location_name != $stat->locationname && $location_code != $stat->locationcode)
		  {
		    $stat->locationname = $location_name;
            $stat->locationcode = $location_code;
          
		    $stat->save();
		  }
		 else 
		    return View::make('backoffice.locations.edit_location')->with('error_data', 'Error: Duplicated name or code');
		}
		
        return View::make('backoffice.locations.list_locations');
	}
	
}

?>