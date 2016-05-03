<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");
	$va_access_values = 	$this->getVar('access_values');	
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
		<div class="container">
			<div class="row">
				<div class='col-sm-6'>
				
				{{{representationViewer}}}
				
<?php
				$vs_access_point = "";				
				#Local Subject
				$va_local_subjects = $t_item->get('ca_occurrences.local_subject', array('returnAsArray' => true, 'convertCodesToDisplayText' => true));
				if (sizeof($va_local_subjects) >= 1) {
					$vn_subject = 1;
					#$vs_access_point.= "<h9>Local Access Points </h9>";
					foreach ($va_local_subjects as $va_key => $va_local_subject) {
						if ($va_local_subject == '-') { continue; }
						if ($vn_subject > 3) {
							$vs_subject_style = "class='subjectHidden'";
						}
						$vs_access_point.= "<div {$vs_subject_style}>".caNavLink($this->request, $va_local_subject, '', '', 'Search', 'objects', array('search' => "'".$va_local_subject."'"))."</div>";
						
						if (($vn_subject == 3) && (sizeof($va_local_subjects) > 3)) {
							$vs_access_point.= "<a class='seeMore' href='#' onclick='$(\".seeMore\").hide();$(\".subjectHidden\").slideDown(300);return false;'>more...</a>";
						}
						$vn_subject++;
					}
				}
				if ($vs_access_point != "") {
					print "<div class='subjectBlock'>";
					print "<h8 style='margin-bottom:10px;'>Access Points</h8>";
					print $vs_access_point;
					print "</div>";
				}
?>	
				<div class='map'>{{{map}}}</div>				
				</div><!-- end col -->
				<div class='col-sm-6'>
				<H4>{{{^ca_occurrences.preferred_labels.name}}}</H4>
				<hr>
<?php
				if ($va_originating_institution = $t_item->get('ca_entities.preferred_labels', array('returnAsLink' => true, 'restrictToRelationshipTypes' => array('institution'), 'delimiter' => ', '))) {
					print "<div class='unit'><h8>Originating Institution</h8>".$va_originating_institution."</div>";
				}
				if ($va_exh_type = $t_item->get('ca_occurrences.exhibition_type')) {
					print "<div class='unit'><h8>Exhibition Type</h8>".$va_exh_type."</div>";
				}
				if ($va_curator = $t_item->get('ca_entities.preferred_labels', array('returnAsLink' => true, 'restrictToRelationshipTypes' => array('curator'), 'delimiter' => ', '))) {
					print "<div class='unit'><h8>Curator</h8>".$va_curator."</div>";
				}								
				if ($va_event = $t_item->get('ca_occurrences.occurrence_dates')) {
					print "<div class='unit'><h8>Event Date</h8>".$va_event."</div>";
				}
				if ($va_venue = $t_item->getWithTemplate('<unit delimiter="<br/>">^ca_occurrences.venue.venue_institution (^ca_occurrences.venue.venue_dates)</unit>')) {
					print "<div class='unit'><h8>Venue</h8>".$va_venue."</div>";
				}	
				if ($va_description = $t_item->get('ca_occurrences.occurrence_description')) {
					print "<div class='unit'><h8>Description</h8>".$va_description."</div>";
				}
				if ($va_catalogue = $t_item->get('ca_objects.preferred_labels', array('delimiter' => '<br/>', 'returnAsLink' => true, 'restrictToTypes' => array('library')))) {
					print "<div class='unit'><h8>Catalogue</h8>".$va_catalogue."</div>";
				}
				if ($va_online = $t_item->get('ca_occurrences.online_exhibition')) {
					print "<div class='unit'><h8>Online Exhibition</h8><a href='".$va_online."' target='_blank'>".$va_online."</a></div>";
				}
				if ($va_entities = $t_item->getWithTemplate('<unit delimiter="<br/>" relativeTo="ca_entities"><l>^ca_entities.preferred_labels</l> (^relationship_typename)</unit>')) {
					print "<div class='unit'><h8>Related Entities</h8>".$va_entities."</div>";
				}
				if ($va_places = $t_item->getWithTemplate('<unit delimiter="<br/>" relativeTo="ca_places"><l>^ca_places.preferred_labels</l> (^relationship_typename)</unit>')) {
					print "<div class='unit'><h8>Related Places</h8>".$va_places."</div>";
				}
				if ($va_collections = $t_item->getWithTemplate('<unit delimiter="<br/>" relativeTo="ca_collections"><l>^ca_collections.preferred_labels</l> (^relationship_typename)</unit>')) {
					print "<div class='unit'><h8>Related Collections</h8>".$va_collections."</div>";
				}
				if ($va_events = $t_item->getWithTemplate('<unit delimiter="<br/>" relativeTo="ca_occurrences.related"><l>^ca_occurrences.preferred_labels</l></unit>')) {
					print "<div class='unit'><h8>Related Events</h8>".$va_events."</div>";
				}																			
?>					
				</div>
			</div><!-- end row -->

{{{<ifcount code="ca_objects" min="2">
			<div class="row">
				<div id="browseResultsContainer">
					<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>
				</div><!-- end browseResultsContainer -->
			</div><!-- end row -->
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'Search', 'objects', array('search' => 'occurrence_id:^ca_occurrences.occurrence_id'), array('dontURLEncodeParameters' => true)); ?>", function() {
						jQuery('#browseResultsContainer').jscroll({
							autoTrigger: true,
							loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
							padding: 20,
							nextSelector: 'a.jscroll-next'
						});
					});
					
					
				});
			</script>
</ifcount>}}}		</div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->