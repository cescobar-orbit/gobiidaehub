<?php

class Taxon extends Eloquent {

	public static $timestamps = true;
    public static $table = 'tbl_taxon';
    
    public function images()
    {
    	return $this->has_many('TaxonImage','taxonid');
    }
}

?>