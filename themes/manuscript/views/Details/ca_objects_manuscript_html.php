<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2015 Whirl-i-Gig
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

	$t_object = 			$this->getVar("item");
	$va_comments = 			$this->getVar("comments");
	$va_tags = 				$this->getVar("tags_array");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");

?>
<div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container"><div class="row">
<?php
			if($t_object->get('ca_object_representations')){
?>
				<div class='col-sm-4 col-sm-offset-1'>
					{{{representationViewer}}}
								
					<div id="detailAnnotations"></div>
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4")); ?>
				
				</div>
				<div class='col-sm-7'>
<?php
			} else {
				print "<div class='col-sm-10 col-sm-offset-1'>";
			}
?>
<?php
	$viewable = $t_object->get('ca_objects.viewable', array('convertCodesToDisplayText' => true));
	$vs_link_text = '';
	if($viewable == "Yes"){
		$vs_link_text = 'View Online';
	} else {
		$vs_link_text = 'View Catalog Record';
	}
	$vs_link_text .= " <span class='glyphicon glyphicon-new-window' aria-hidden='true'></span>";
?>
				<H2>
					{{{ca_objects.preferred_labels.name}}}
					<?php
						if ($vs_link = $t_object->get('ca_objects.institution_link')) {
							print "<h5><a href='".$vs_link."' target='_blank'>".$vs_link_text."</a> ";
						}
                        if ($vs_library_title = $t_object->get('ca_objects.nonpreferred_labels')){
							if(strlen($vs_library_title) > 60){
								print "[Library Title: ".substr($vs_library_title, 0, 57)." . . .]</h5>";
							} else {
								print "[Library Title: ".$vs_library_title."]</h5>";
							}
                        }
					?>
				</H2>
				<HR>
<?php
				if ($va_collections = $t_object->get('ca_collections.preferred_labels', array('returnAsLink' => true, 'delimiter' => '<br/>'))) {
					print "<div class='unit'><h5>Manuscript Location</h5>".$va_collections;
                    if($vs_library_location = $t_object->get('ca_objects.sublocation')){
                        print ", ".$vs_library_location;
                    }
                    print "</div>";
				}

                #if ($vs_library_title = $t_object->get('ca_objects.nonpreferred_labels')){
                #    print "<div class='unit'><h5>Library Title</h5>".$vs_library_title."</div>";
                #}

				if ($va_place = $t_object->get('ca_places.hierarchy.preferred_labels', array('delimiter' => ', '))) {
					print "<div class='unit'><h5>Place of Origin</h5>".$va_place."</div>";
				}
				if ($va_date = $t_object->get('ca_objects.date_composition')) {
					print "<div class='unit'><h5>Date of Composition</h5>".$va_date."</div>";
				}
				if ($va_notes = $t_object->get('ca_objects.general_notes')) {
					print "<div class='unit'><h5>Description</h5>".$va_notes."</div>";
				}


?>

			</div><!-- end col -->
		</div><!-- end row --></div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 120
		});
	});
</script>
