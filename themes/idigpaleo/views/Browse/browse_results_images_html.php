<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_results_images_html.php : 
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
 * ----------------------------------------------------------------------
 */
 
	$qr_res 			= $this->getVar('result');				// browse results (subclass of SearchResult)
	$va_facets 			= $this->getVar('facets');				// array of available browse facets
	$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
	$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
	$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
	$vn_hits_per_block 	= (int)$this->getVar('hits_per_block');	// number of hits to display per block
	$vn_start		 	= (int)$this->getVar('start');			// offset to seek to before outputting results
	
	$va_views			= $this->getVar('views');
	$vs_current_view	= $this->getVar('view');
	$va_view_icons		= $this->getVar('viewIcons');
	$vs_current_sort	= $this->getVar('sort');
	
	$t_instance			= $this->getVar('t_instance');
	$vs_table 			= $this->getVar('table');
	$vs_pk				= $this->getVar('primaryKey');
	$va_access_values = caGetUserAccessValues($this->request);
	$o_config = $this->getVar("config");	
	
	$va_options			= $this->getVar('options');
	$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);

	$vb_ajax			= (bool)$this->request->isAjax();
	
	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);

	if(!($vs_placeholder = $o_config->get("placeholder_media_icon"))){
		$vs_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_placeholder."</div>";
		

		$vn_col_span = 3;
		$vn_col_span_sm = 4;
		$vb_refine = false;
		if(is_array($va_facets) && sizeof($va_facets)){
			$vb_refine = true;
			$vn_col_span = 3;
			$vn_col_span_sm = 6;
			$vn_col_span_xs = 6;
		}
		if ($vn_start < $qr_res->numHits()) {
			$vn_c = 0;
			$qr_res->seek($vn_start);
			
			if ($vs_table != 'ca_objects') {
				$va_ids = array();
				while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
					$va_ids[] = $qr_res->get($vs_pk);
					$vn_c++;
				}
				$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'small', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'checkAccess' => $va_access_values));
			
				$vn_c = 0;	
				$qr_res->seek($vn_start);
			}
			
			while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
				$vn_id 					= $qr_res->get("{$vs_table}.{$vs_pk}");
				$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
				$vs_label_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.taxonomy_specimen.scientific_name"), '', $vs_table, $vn_id);
				
				$formation_place	= $qr_res->get("{$vs_table}.lithostratigraphy.formation");
				if($formation_place){
					$vs_formation_detail 	= (strlen($formation_place) >= 15) ? "<small>Fossil Deposit: </small>".substr($formation_place, 0, 15)."..." : "<small>Fossil Deposit: </small>".$formation_place;
				};
				#Locality not currently necessary for the Browse view
				#Leaving this here in case anyone wants to add it in at a future point
				#$vs_locality_detail	= (strlen($qr_res->get("{$vs_table}.locality_specimen.locality")) >= 20) ? substr($qr_res->get("{$vs_table}.locality_specimen.locality"), 0, 20)."..." : $qr_res->get("{$vs_table}.locality_specimen.locality");
				
				$common_name_place	= $qr_res->get("{$vs_table}.taxonomy_specimen.vernacular_name");
				if ($common_name_place){
					$vs_common_detail	= (strlen($common_name_place) >= 15) ? "<small>Common Name: </small>".substr($common_name_place, 0, 15)."...<br/>" : "<small>Common Name: </small>".$common_name_place."<br/>";
				};
				$vs_thumbnail = "";
				if ($vs_table == 'ca_objects') {
					if(!($vs_thumbnail = $qr_res->getMediaTag('ca_object_representations.media', 'medium', array("checkAccess" => $va_access_values)))){
						$vs_thumbnail = $vs_placeholder_tag;	
					}
					$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);				
				} else {
					if($va_images[$vn_id]){
						$vs_thumbnail = $va_images[$vn_id];
					}else{
						$vs_thumbnail = $vs_placeholder_tag;
					}
					$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);			
				}
				$vs_add_to_set_link = "";
				if(is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
					$vs_add_to_set_link = "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array($vs_pk => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]."</a>";
				}
				$vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);

				print "
	<div class='bResultItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
		<div class='bResultItem' onmouseover='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").hide();'>
			<div class='bResultItemContent'><div class='text-center bResultItemImg'>{$vs_rep_detail_link}</div>
				<div class='bResultItemText'>
					<small>{$vs_idno_detail_link}</small><br/>{$vs_label_detail_link}<br/>{$vs_common_detail}{$vs_formation_detail}
				</div><!-- end bResultItemText -->
			</div><!-- end bResultItemContent -->
			<div class='bResultItemExpandedInfo' id='bResultItemExpandedInfo{$vn_id}'>
				<hr>
				{$vs_expanded_info}{$vs_add_to_set_link}
			</div><!-- bResultItemExpandedInfo -->
		</div><!-- end bResultItem -->
	</div><!-- end col -->";
				
				$vn_c++;
			}
			
			print "<div style='clear:both;'></div>";
			print caNavLink($this->request, _t('Next %1', $vn_hits_per_block), 'jscroll-next', '*', '*', '*', array('s' => $vn_start + $vn_hits_per_block, 'key' => $vs_browse_key, 'view' => $vs_current_view));
		}
?>
