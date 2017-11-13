<?php
/* ----------------------------------------------------------------------
 * app/templates/summary/summary.php
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * -=-=-=-=-=- CUT HERE -=-=-=-=-=-
 * Template configuration:
 *
 * @name Object tear sheet
 * @type page
 * @pageSize letter
 * @pageOrientation portrait
 * @tables ca_objects
 * @marginTop 0.75in
 * @marginLeft 0.5in
 * @marginRight 0.5in
 * @marginBottom 0.75in
 *
 * ----------------------------------------------------------------------
 */
 
 	$t_item = $this->getVar('t_subject');
	$t_display = $this->getVar('t_display');
	$va_placements = $this->getVar("placements");

	print $this->render("pdfStart.php");
	print $this->render("header.php");
	print $this->render("footer.php");	

?>
	<div class="representationList">
		
<?php
	$va_reps = $t_item->getRepresentations(array("thumbnail", "medium"));

	foreach($va_reps as $va_rep) {
		if(sizeof($va_reps) > 1){
			# --- more than one rep show thumbnails
			$vn_padding_top = ((120 - $va_rep["info"]["thumbnail"]["HEIGHT"])/2) + 5;
			print $va_rep['tags']['thumbnail']."\n";
		}else{
			# --- one rep - show medium rep
			print $va_rep['tags']['medium']."\n";
		}
	}
?>
	</div>
	<div class='tombstone'>
<?php	
		if ($va_entities = $t_item->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('artist')))) {
			print "<div class='unit'><h6>Artist</H6>".$va_entities."</div>";
		}
		print "<div class='unit'><h6>Title</h6>".$t_item->get('ca_objects.preferred_labels')."</div>";
		if ($va_date = $t_item->get('ca_objects.date')) {
			print "<div class='unit'><h6>Date</h6>".$va_date."</div>";
		}
		if ($va_dimensions = $t_item->get('ca_objects.dimensions', array('returnWithStructure' => true))) {		
			print "<div class='unit'><h6>Dimensions</h6>";
			foreach ($va_dimensions as $va_key => $va_dimension_t) {
				foreach ($va_dimension_t as $va_key => $va_dimension) {
					$va_dims = array();
					if ($va_dimension['dimensions_height']) {
						$va_dims[] = $va_dimension['dimensions_height']." H";
					}
					if ($va_dimension['dimensions_width']) {
						$va_dims[] = $va_dimension['dimensions_width']." W";
					}
					if ($va_dimension['dimensions_length']) {
						$va_dims[] = $va_dimension['dimensions_length']." L";
					}
					if ($va_dimension['dimensions_thickness']) {
						$va_dims[] = $va_dimension['dimensions_thickness']." thick";
					}	
					print join(' x ', $va_dims);
					if ($va_dimension['dimensions_weight']) {
						$va_dims[] = "<br/>".$va_dimension['dimensions_weight']." weight";
					}
					if ($va_dimension['measurement_notes']) {
						$va_dims[] = "<br/>".$va_dimension['measurement_notes'];
					}																																			
				}						
			}
			print "</div>";
		}
		if ($va_mediums = $t_item->get('ca_objects.medium', array('delimiter' => ', ', 'convertCodesToDisplayText' => true))) {
			print "<div class='unit'><h6>Medium</h6>".$va_mediums."</div>";
		}	
		if ($vs_image_notes = $t_item->get('ca_objects.image_notes')) {
			print "<div class='unit'><h6>Image Notes</h6>".$vs_image_notes."</div>";
		}
		if ($vs_accession = $t_item->get('ca_objects.accession')) {
			print "<div class='unit'><h6>Catalogue Number</h6>".$vs_accession."</div>";
		}														
		if ($vs_description = $t_item->get('ca_objects.description')) {
			print "<div class='unit'><h6>Description</h6>".$vs_description."</div>";
		}				
		if ($va_related_pub = $t_item->get('ca_objects.related.preferred_labels', array('restrictToTypes' => array('publication'), 'delimiter' => ', '))) {
			print "<div class='unit'><h6>Related Publications</h6>".$va_related_pub."</div>";
		}
?>
	</div>
<?php	
	print $this->render("pdfEnd.php");