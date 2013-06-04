<?php
class Backoffice_Taxonomic_Controller extends Base_Controller {
	
   public $layout = 'layouts.container';
	  
   
   public function action_list()
	{
		$per_page = 10;
		$count = 0;
		$records = 0;
		
		$page = Input::get('page');
		$page = (isset($page)) ? $page: 1;
		
	    $rows = Taxon::where('taxontype','<>','S')->order_by('taxonname','asc');
	    $count = count($rows->get());
        $taxons = $rows->get(); //$rows->paginate($per_page);
        
        $records = ($per_page * $page);
        if($records > $count && $page != 1)
           $records = $records - $count;

        if($page == 1 && $records > $count)
           $records = $count;   
	    
        return View::make('backoffice.taxons.list_taxons')
                   ->with('taxons',$taxons)
                   ->with('records',$records)
                   ->with('count',$count);
	}
	
	
   public function action_delete($id)
	{
		$taxon = Taxon::find($id);
		$taxon->delete();
		
        return Redirect::to('backoffice/taxonomic/list');
	}
	
	
   
	public function action_confirm_taxon_deletion($id)
	{
		
		return View::make('backoffice.taxons.confirm_deletion_taxon')->with('id', $id);
	}
		
	
	
   public function action_edit($id)
	{
		$taxon = Taxon::find($id);
        return View::make('backoffice.taxons.edit_taxon')->with('taxon', $taxon);
	}
	
   public function action_add()
	{
		$taxon  = new Taxon;
		
        return View::make('backoffice.taxons.add_taxon')->with('taxon', $taxon);
	}
	
	
	
   public function action_save()
	{
	    $id = Input::get('id');
	    
	    $parentid   = trim(Input::get('parentid'));
	    $taxonname  = trim(Input::get('taxonname'));
		$taxontype  = trim(Input::get('taxontype'));
		$authorname = trim(Input::get('authorname'));
		$updated     = trim(Input::get('updated'));
		$description = trim(Input::get('description'));

		$item = Taxon::where('taxonname', '=', $taxonname)->first();
		$item = ($item != null) ? $item : (new taxon);                 														
		
		if($id == 0)
		{  
		    $taxon = new Taxon;
		    $taxon->taxonname  = $taxonname;
		    $taxon->taxontype  = $taxontype;
		    $taxon->parentid   = $parentid;
		    $taxon->description = $description;
		    $taxon->authorname = $authorname;
		    $taxon->updated = $updated;
		    	 
		   if( strtolower($taxonname) == strtolower($item->taxonname) && $item->id == $taxon->id )
		   {		    
		     $taxon->save();
		   }
		   else
		   {
		   	  Log::info("ERROR: Add taxon - duplicate taxonname ".$taxonname); 
		      return View::make('backoffice.taxons.add_taxon')
		                 ->with('taxon', $taxon)
		                 ->with('error_data', 'Error: Duplicate taxon name '.$taxonname);
		   }
		}
		else 
		{
		    $taxon = taxon::find($id);	
		  
		    $taxon->taxonname  = $taxonname;
		    $taxon->taxontype  = $taxontype;
		    $taxon->parentid   = $parentid;
		    $taxon->description = $description;
		    $taxon->authorname = $authorname;
		    $taxon->updated = $updated;
		    
		  if( strtolower($taxonname) == strtolower($item->taxonname) && $taxon->id == $item->id)
		  {          
		    $taxon->save();
		  }
		  else
		  { 
		  	 Log::info("ERROR: Edit taxon - duplicate taxonname ".$taxonname); 
		     return View::make('backoffice.taxons.edit_taxon')
		                ->with('taxon', $taxon)
		                ->with('error_data', 'Error: Duplicated taxon name '.$taxonname);
		  }
		}
		
		
       return Redirect::to('backoffice/taxonomic/list');
	}
	
	
	/*-------------------------------- SPECIES INFO -------------------------------------------*/
	
	public function action_list_species($taxonid)
	{
		$species = Taxon::where('parentid','=', $taxonid)
		                ->where('taxontype','=','S')
		                ->order_by('taxonname','asc')->get();

		$genus = Taxon::find($taxonid);
		                
		return View::make('backoffice.taxons.species.list_species')
		           ->with('species',$species)
		           ->with('genus', $genus);
	}
	
	
	public function action_add_specie($genusid)
	{
		$specie =  new Taxon;
		
		return View::make('backoffice.taxons.species.add_specie')
		           ->with('specie', $specie)
		           ->with('genusid', $genusid);
	}
	
	
	public function action_edit_specie($id)
	{
		$specie = Taxon::find($id);
		$genusid = $specie->parentid;
		
		return View::make('backoffice.taxons.species.edit_specie')
		           ->with('specie', $specie)
		           ->with('genusid', $genusid);
	}
	
	
	public function action_delete_specie($id)
	{
		$specie = Taxon::find($id);
		$parentid = $specie->parentid;
		                
		$specie->delete();
		
		return Redirect::to('backoffice/taxonomic/list_species/'.$parentid);
	}
	
	
	
	public function action_confirm_specie_deletion($id)
	{
		$taxon = Taxon::find($id);
		return View::make('backoffice.taxons.species.confirm_deletion_specie')
		           ->with('id', $id)
		           ->with('taxon', $taxon);
	}
	
	
	
	public function action_save_specie()
	{
	  $id = Input::get('id');
	  $taxonname = trim( Input::get('taxonname') );
	  $taxontype = trim( Input::get('taxontype') );
	  $genusid = Input::get('genusid');
	  $updated = Input::get('updated');
	  $authorname = trim(Input::get('authorname'));
	  
	  /** Taxon Data */
	  $common_name = trim( Input::get('commonname') );
	  $description = Input::get('description');
	  $size   = Input::get('size');
	  $colors = Input::get('colors');
	  $fins   = Input::get('fins');
	  $teeth  = Input::get('teeth');
	  $scales = Input::get('scales');
	  $notes  = Input::get('notes');
	  $papillae = Input::get('papillae');
	  $headpores = Input::get('headpores');
	  $breeding  = Input::get('breeding');
	  $distribution = Input::get('distribution');
	  $habitatdepth = Input::get('habitatdepth');
	  $generalmorphology = Input::get('generalmorphology');

	  $item = Taxon::where("taxonname","=", $taxonname)->first();
	  $item = (isset($item)) ? $item : (new Taxon);
	  
	  if($id == 0)
	  {
	  	  $specie = new Taxon;
	  	  $specie->taxonname = $taxonname;
	  	  $specie->taxontype = $taxontype;
	  	  $specie->parentid  = $genusid;	  	  
	  	  $specie->authorname = $authorname;
	  	  $specie->updated = $updated;
	  	  $specie->description = $description;
	  	  
	  	  $specie->commonname = $common_name;
	  	  $specie->description = $description;
	  	  $specie->size   = $size;
	  	  $specie->color  = $colors;
	  	  $specie->notes  = $notes;
	  	  $specie->fins   = $fins;
	  	  $specie->teeth  = $teeth;
	  	  $specie->scales = $scales;
	  	  $specie->papillae  = $papillae;
	  	  $specie->headpores = $headpores;
	  	  $specie->breeding  = $breeding;
	  	  $specie->habitat   = $habitatdepth;
	  	  $specie->distribution = $distribution;
	  	  $specie->generalmorphology = $generalmorphology;

	  	  
		  if( strtolower($taxonname) == strtolower($item->taxonname) )
		   {
		   	 Log::info("ERROR: Add specie - duplicate specie name ".$taxonname);
		   	 return View::make('backoffice.taxons.species.add_specie')
		   	            ->with('specie', $specie)
		   	            ->with('genusid', $genusid)
		   	            ->with('error_data', 'Error: Duplicated Species name '.$taxonname);
		   }
		   else
		   {
		   	$specie->save();
		   }
	     	
	  }
	  else 
	  {
	  	  $specie = Taxon::find($id);
	  	
	  	  $specie->taxonname = $taxonname;
	  	  $specie->taxontype = $taxontype;
	  	  $specie->parentid  = $genusid;	  	  
	  	  $specie->authorname = $authorname;
	  	  $specie->updated = $updated;
	  	  $specie->description = $description;

	  	  $specie->commonname = $common_name;
	  	  $specie->size   = $size;
	  	  $specie->color  = $colors;
	  	  $specie->notes  = $notes;
	  	  $specie->fins   = $fins;
	  	  $specie->teeth  = $teeth;
	  	  $specie->scales = $scales;
	  	  $specie->papillae  = $papillae;
	  	  $specie->headpores = $headpores;
	  	  $specie->breeding  = $breeding;
	  	  $specie->habitat   = $habitatdepth;
	  	  $specie->distribution = $distribution;
	  	  $specie->generalmorphology = $generalmorphology;
	  	
	  	if( strtolower($taxonname) == strtolower($item->taxonname) && $specie->id != $item->id )
	  	{
	  		 Log::info("ERROR: Edit specie - duplicate specie name ".$taxonname);
		   	 return View::make('backoffice.taxons.species.edit_specie')
		   	            ->with('specie', $specie)
		   	            ->with('genusid', $genusid)
		   	            ->with('error_data', 'Error: Duplicated Species name '.$taxonname);
	  	}
	  	else
	  	{	
		   	$specie->save();
	  	}  	
	  }
	  
	  return Redirect::to('backoffice/taxonomic/list_species/'.$genusid);
	}
	
	
	/**
	 * Metadata management
	 * @param: taxonid
	 * @return:taxonimage object
	 * @description: Upload documents related to a specific taxon such as: images, doc, pdf.
	 * 
	 */

	public function action_list_taxonimages($taxonid)
	{
		$taxon = Taxon::find($taxonid);

		return View::make('backoffice.taxons.metadata.list_taxonimages')
		            ->with('images',$taxon->images)
		            ->with('taxon', $taxon);
	}
	
	
	
	public function action_upload_image()
	{
	    $taxonid  = Input::get('taxonid');	
	    $contributorid = trim( Input::get('contributorid') );
		$imagelocation = trim( Input::get('imagelocation') );
		$displayOnSpecie = Input::get('specieimageonpage');
		$displayOnGenus  = Input::get('genusimageonpage');
		  	
	   //set the name of the file
		$image = Input::file('image');
		$filename  =  Input::file('image.name');
        $extension = File::extension($filename);
		
        $rules = array('image' => 'image|max:1000');
		$inputs = array('image' => $image);
			  
		$taxonImage = new taxonImage;
		$taxonImage->taxonid   = $taxonid;
		$taxonImage->imagename = $filename;
		$taxonImage->imagelocation   = $imagelocation;
		$taxonImage->contributorid   = $contributorid;
		$taxonImage->speciepageimage = (isset($displayOnSpecie)) ? $displayOnSpecie : 0;
		$taxonImage->genuspageimage  = (isset($displayOnGenus)) ? $displayOnGenus : 0;

		$destination = (Taxon::find($taxonid)->taxontype=="S") ? "species" : "taxons";
		
		$setPicture = $this->uploadImage($image, $filename, $destination, '');
	        
		if( $setPicture )
		 {
		   Log::info($filename);
		   $taxonImage->imagename = $filename;	
		 }	
		  	
		 $taxonImage->save();
		 Log::info("Image: ".$filename." was uploaded.");
		     	
	    return Redirect::to('backoffice/taxonomic/list_taxonimages/'.$taxonid);	 
	}
	
	
	public function action_edit_image($id)
	{
		$image = TaxonImage::find($id);
		
		return null;
	}
	
	
	public function action_delete_image($id)
	{
		$image = taxonImage::find($id);
		
		$taxon =  Taxon::find($image->taxonid);
		
		File::delete('public/uploads/images/taxons/'.$image->imagename);
		$image->delete();

	    return Redirect::to_action('backoffice/taxonomic/list_taxonimages/'.$image->taxonid);	
	}
	
	
	
    public function action_confirm_deletion_image($id)
	{
		$image = TaxonImage::find($id);
		$taxon = Taxon::find($image->taxonid);
		
		
		return View::make('backoffice.taxons.metadata.confirm_deletion_image')
		            ->with('id',$id)
		            ->with('taxon',$taxon);
	}
	
	
   public function uploadImage($image, $filename, $dest, $current_action)
	{
	    $success = false;
	    
	    Log::info("Filename: ".$filename);
        $extension = File::extension($filename);
		
        $rules = array('image' => 'image|max:1000');
		$inputs = array('image' => $image);
			 
		
		$path =  'backoffice.taxons.list_taxonimages';
		  	         
		$validation = Validator::make($inputs, $rules);
		
		if( $validation->passes() && in_array(strtolower($extension), array('jpg','gif','png','jpeg','bmp'))) 
		 {

		  //Check if a file already exists before uploading.
		  if(File::exists('public/uploads/images/'.$dest.'/'.$filename))
		  {
		  	$success = false;
		  	Log::info('ERROR: File already exists...'.$filename);
		  	         
		  	return View::make($path)
		  	           ->with('error_data', 'Error: Image '. $filename.'already exists');
		  }
		  
		  //Upload the file
		  $img_upload = Input::upload('image', 'public/uploads/images/'.$dest, $filename);
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