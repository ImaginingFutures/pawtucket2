<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$va_access_values = caGetUserAccessValues($this->request);
	$t_lists = new ca_lists();
	$vn_promo_type_id = $t_lists->getItemIDFromList("object_representation_types", "press_promo");
 ?>
<div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='col-xs-12 col-sm-12'>
			<div class="row">
				<div class='col-sm-10'>
					<H1><span class="ltgrayText">{{{^ca_occurrences.type_id}}}</span><br/>{{{^ca_occurrences.preferred_labels.name}}}</H1>
					{{{<ifdef code="ca_occurrences.subtitle"><H5>^ca_occurrences.subtitle</H5></ifdef>}}}
				</div><!-- end col -->
				<div class='navLeftRight col-sm-2'>
					<div class="detailNavBgRight">
						{{{previousLink}}}{{{resultsLink}}}<div style='clear:right;'>{{{nextLink}}}</div>
					</div><!-- end detailNavBgLeft -->
				</div><!-- end col -->
			</div><!-- end row -->
			<div class="row">			
				<div class='col-md-6 col-lg-6'>
					{{{<ifdef code="ca_occurrences.exhibition_dates"><H6>Date</H6>^ca_occurrences.exhibition_dates<br/></ifdef>}}}
					{{{<ifdef code="ca_occurrences.opening_date"><H6>Opening Reception</H6>^ca_occurrences.opening_date<br/></ifdef>}}}
					
					{{{<ifcount code="ca_entities" restrictToRelationshipTypes="curator" min="1"><H6>Curated By</H6></ifcount>}}}
					{{{<unit relativeTo="ca_entities" restrictToRelationshipTypes="curator" delimiter=", ">^ca_entities.preferred_labels.displayname</unit>}}}
					
					{{{<ifcount code="ca_entities" restrictToRelationshipTypes="essayist" min="1"><H6>Essay By</H6></ifcount>}}}
					{{{<unit relativeTo="ca_entities" restrictToRelationshipTypes="essayist" delimiter=", ">^ca_entities.preferred_labels.displayname</unit>}}}
					
				</div><!-- end col -->
				<div class='col-md-6 col-lg-6'>
					{{{<ifcount code="ca_entities" restrictToRelationshipTypes="artist" min="1" max="1"><H6>Artist</H6></ifcount>}}}
					{{{<ifcount code="ca_entities" restrictToRelationshipTypes="artist" min="2"><H6>Artists</H6></ifcount>}}}
					{{{<unit relativeTo="ca_entities" restrictToRelationshipTypes="artist" delimiter=", ">^ca_entities.preferred_labels.displayname</unit>}}}
					
					{{{<ifcount code="ca_occurrences.related" restrictToTypes="exhibition" min="1" max="1"><H6>Related exhibition</H6></ifcount>}}}
					{{{<ifcount code="ca_occurrences.related" restrictToTypes="exhibition" min="2"><H6>Related exhibitions</H6></ifcount>}}}
					{{{<unit relativeTo="ca_occurrences.related" restrictToTypes="exhibition" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l></unit>}}}
					
					{{{<ifcount code="ca_occurrences.related" restrictToTypes="event" min="1" max="1"><H6>Related event</H6></ifcount>}}}
					{{{<ifcount code="ca_occurrences.related" restrictToTypes="event" min="2"><H6>Related events</H6></ifcount>}}}
					{{{<unit relativeTo="ca_occurrences.related" restrictToTypes="event" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l></unit>}}}
				</div><!-- end col -->
			</div><!-- end row -->
			<div class="row">
				<div class='col-md-12 col-lg-12'>
					<br/><HR/><br/>
				</div>
			</div>
			<div class="row">			
				<div class='col-sm-5'>
<?php
					
					$vn_cap_for_grid = 30;
					$vs_version = "large";
					$va_reps = $t_item->getRepresentations(array("large", "mediumlarge"), null, array("checkAccess" => $va_access_values));
					$va_object_ids = $t_item->get("ca_objects.object_id", array("returnAsArray" => true, "checkAccess" => $va_access_values, "sort" => "ca_entities.preferred_labels.surname"));
					$q_artworks = caMakeSearchResult("ca_objects", $va_object_ids);
					$vn_total_images = (sizeof($va_reps) + $q_artworks->numHits());
					if($vn_total_images > $vn_cap_for_grid){
						$vs_version = "mediumlarge";
					}
					$va_art_installations = array();
					$va_promos = array();
					if(is_array($va_reps) && sizeof($va_reps)){
						foreach($va_reps as $va_rep){
							$vs_image = "";
							if($va_rep["type_id"] == $vn_promo_type_id){
								$vs_image = $va_rep["tags"]["large"];
							}else{
								$vs_image = $va_rep["tags"][$vs_version];
							}
							$va_tmp = array("image" => $vs_image, "label" => $va_rep["label"], "image_link" => "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', 'Detail', 'GetMediaOverlay', array('context' => 'exhibitions', 'id' => $t_item->getPrimaryKey(), 'representation_id' => $va_rep["representation_id"], 'overlay' => 1))."\"); return false;' >".$vs_image."</a>");
							
							$vs_sort_key = "";
							if(trim($va_rep["idno_sort"])){
								$vs_sort_key = $va_rep["idno_sort"];
							}else{
								if($va_rep["label"]){
									$vs_sort_key = array_shift(explode(" ", $va_rep["label"]));
								}else{
									$vs_sort_key = $va_rep["representation_id"];
								}
							}
							$vs_sort_key = strtolower($vs_sort_key);
							if($va_rep["type_id"] == $vn_promo_type_id){
								if($va_promos[$vs_sort_key]){
									$vs_sort_key .= $va_rep["representation_id"];
								}
								$va_promos[$vs_sort_key] = $va_tmp;
							}else{
								if($va_art_installations[$vs_sort_key]){
									$vs_sort_key .= $va_rep["representation_id"];
								}
								$va_art_installations[$vs_sort_key] = $va_tmp;
							}
						}
					}
					ksort($va_art_installations, SORT_NATURAL);
					ksort($va_promos, SORT_NATURAL);
					
					$va_artworks = array();
					$va_artworks_no_media = array();
					if($q_artworks->numHits()){
						while($q_artworks->nextHit()){
							$vs_image = "";
							$vs_image = $q_artworks->get('ca_object_representations.media.'.$vs_version, array("checkAccess" => $va_access_values));
							$vb_no_rep = false;
							if(!$vs_image){
								if($vs_version == "large"){
									$vs_image = "<div class='dontScale detailPlaceholder'>".caGetThemeGraphic($this->request, 'KentlerLogoWhiteBG.jpg')."</div>";
								}else{
									$vs_image = "<div class='detailPlaceholder'>".caGetThemeGraphic($this->request, 'KentlerLogoWhiteBG.jpg')."</div>";
								}
								$vb_no_rep = true;
							}
							$vs_caption = "";
							$vs_sort_key = "";
							$vs_sort_key = array_shift(explode(" ", $q_artworks->get('ca_entities.preferred_labels.surname', array("restrictToRelationshipTypes" => array("artist"), 'checkAccess' => $va_access_values))));
							if($vs_artist = $q_artworks->get('ca_entities.preferred_labels.displayname', array("restrictToRelationshipTypes" => array("artist"), 'checkAccess' => $va_access_values))){
								$vs_caption = $vs_artist.", ";
							}
							$vs_caption .= "<i>".$q_artworks->get("ca_objects.preferred_labels.name")."</i>, ";
							$vs_medium = "";
							if($q_artworks->get("medium_text")){
								$vs_medium = $q_artworks->get("medium_text");
							}else{
								if($q_artworks->get("medium")){
									$vs_medium .= $q_artworks->get("medium", array("delimiter" => ", ", "convertCodesToDisplayText" => true));
								}
							}
							if($vs_medium){
								$vs_caption .= $vs_medium.", ";
							}					
							if($q_artworks->get("ca_objects.dimensions")){
								$vs_caption .= $q_artworks->get("ca_objects.dimensions.dimensions_height")." X ".$q_artworks->get("ca_objects.dimensions.dimensions_width").", ";
							}
							if($q_artworks->get("ca_objects.date")){
								$vs_caption .= $q_artworks->get("ca_objects.date").".";
							}
							$vs_label_detail_link 	= caDetailLink($this->request, $vs_caption, '', 'ca_objects', $q_artworks->get("ca_objects.object_id"));
							$tmp = array("image" => $vs_image, "label" => $vs_label_detail_link, "image_link" => ($vb_no_rep) ? $vs_image : "<a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', 'Detail', 'GetMediaOverlay', array('context' => 'objects', 'id' => $q_artworks->get("ca_objects.object_id"), 'representation_id' => $q_artworks->get("ca_object_representations.representation_id", array("checkAccess" => $va_access_values)), 'overlay' => 1))."\"); return false;' >".$vs_image."</a>");
							if(!$vb_no_rep){
								if($va_artworks[$vs_sort_key]){
									$vs_sort_key .= $q_artworks->get("ca_objects.object_id");
								}
								$va_artworks[$vs_sort_key] = $tmp;
							}else{
								if($va_artworks_no_media[$vs_sort_key]){
									$vs_sort_key .= $q_artworks->get("ca_objects.object_id");
								}
								$va_artworks_no_media[$vs_sort_key] = $tmp;
							}
						}
					}
					ksort($va_artworks, SORT_NATURAL);
					ksort($va_artworks_no_media, SORT_NATURAL);
					$va_all_images = array_merge($va_art_installations, $va_artworks, $va_artworks_no_media);
					if(sizeof($va_all_images)){
						print "<H6>"._t("%1 Images", $t_item->get("type_id", array("convertCodesToDisplayText" => true)))."</H6><br/>";
						if($vn_total_images > $vn_cap_for_grid){
							# --- grid
							print "<div class='exhibitGrid'>";
							$vn_col = 0;
							foreach($va_all_images as $va_art_installation){
								if($vn_col == 0){
									print "<div class='row'>";
								}
								print '<div class="col-sm-4"><div class="fullWidthImg" data-toggle="popover" data-trigger="hover" data-placement="right" data-container="body" data-html="true" data-content="'.$va_art_installation["image"].'">'.$va_art_installation["image_link"];
								if($va_art_installation["label"]){
									print "<br/><small>".$va_art_installation["label"]."</small>";
								}
								print "</div><br/></div>";
								$vn_col++;
								if($vn_col == 3){
									print "</div>";
									$vn_col = 0;
								}
							}
							if(($vn_col > 0) && ($vn_col < 3)){
								# --- trailing row
								print "</div>";
							}
							print "</div>";
?>
							<script>
							$(document).ready(function(){
								$('[data-toggle="popover"]').popover();
							});
							</script>
<?php
						}else{
							# --- full width col image
							foreach($va_all_images as $va_image){
								print "<div class='fullWidthImg'>".$va_image["image_link"];
								if($va_image["label"]){
									print "<br/><small>".$va_image["label"]."</small>";
								}
								print "</div><br/>";
							}					
						}
						print "<br/><br/>";
					}
					if(sizeof($va_promos)){
						print "<H6>"._t("Press and Promotion")."</H6><br/>";
						foreach($va_promos as $va_promo){
							print "<div class='fullWidthImg'>".$va_promo["image_link"];
							if($va_promo["label"]){
								print "<br/><small>".$va_promo["label"]."</small>";
							}
							print "</div><br/>";
						}
					}
?>				
				</div>
				<div class='col-sm-1'>
				
				</div>
				<div class='col-sm-6 largerText'>
					{{{<ifdef code="ca_occurrences.description"><H6>About the ^ca_occurrences.type_id</H6><br/>^ca_occurrences.description</ifdef>}}}
				</div>
			</div>
	</div><!-- end col -->
</div><!-- end row -->