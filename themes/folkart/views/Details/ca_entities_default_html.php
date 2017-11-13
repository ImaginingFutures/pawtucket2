<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");	
?>
<div class="container">
	<div class="row">
		<div class='col-xs-12'>
			<H1>{{{^ca_entities.preferred_labels.displayname}}}</H1>
		</div>
	</div>
</div>
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
				<div class='col-sm-6 col-md-6 col-lg-6'>
					<div class='unit'><H6>Type</H6>{{{^ca_entities.type_id}}}</div>
					{{{<ifdef code="ca_entities.role"><div class='unit'><H6>Role</H6>^ca_entities.role%delimiter=,_</div></ifdef>}}}
					{{{<ifdef code="ca_entities.idno"><div class='unit'><H6>Identifier</H6>^ca_entities.idno</div></ifdef>}}}
					{{{<ifdef code="ca_entities.nonpreferred_labels.displayname"><div class='unit'><H6>Alternate names</H6>^ca_entities.nonpreferred_labels.displayname%delimiter=,_</div></ifdef>}}}
					{{{<ifdef code="ca_entities.lifespan"><div class='unit'><H6>Lifespan</H6>^ca_entities.lifespan</div></ifdef>}}}
					{{{<ifdef code="ca_entities.function"><div class='unit'><H6>Functions, Occupations, and Activities</H6>>^ca_entities.function</div></ifdef>}}}
					{{{<ifdef code="ca_entities.heritage"><div class='unit'><H6>Heritage</H6>^ca_entities.heritage</ifdef>}}}
					{{{<ifdef code="ca_entities.medium"><div class='unit'><H6>Medium</H6>^ca_entities.medium</div></ifdef>}}}
					{{{<ifdef code="ca_entities.school"><div class='unit'><H6>School/Genre</H6>^ca_entities.school</div></ifdef>}}}
					{{{<ifdef code="ca_entities.statement"><div class='unit'><H6>Statement</H6><div class="trimText">^ca_entities.statement</div></div></ifdef>}}}
					{{{<ifdef code="ca_entities.publications"><div class='unit'><H6>Publications</H6>^ca_entities.publications</div></ifdef>}}}
					{{{<ifdef code="ca_entities.biography"><div class='unit'><H6>Biography</H6><div class="trimText">^ca_entities.biography</div></div></ifdef>}}}
					{{{<ifdef code="ca_entities.website"><div class='unit'><H6>Website</H6><a href="^ca_entities.website" target="_blank">^ca_entities.website</a></div></ifdef>}}}
					{{{<ifdef code="ca_entities.tgn"><div class='unit'><H6>Geographic names</H6>^ca_entities.tgn%delimiter=,_</div></ifdev>}}}
					
					
					{{{<ifcount code="ca_objects" min="1" max="1"><div class='unit'><unit relativeTo="ca_objects" delimiter=" "><l>^ca_object_representations.media.large</l><div class='caption'>Related Object: <l>^ca_objects.preferred_labels.name</l></div></unit></div></ifcount>}}}
<?php
				# Comment and Share Tools
				if ($vn_comments_enabled | $vn_share_enabled) {
						
					print '<div id="detailTools">';
					if ($vn_comments_enabled) {
?>				
						<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment"></span>Comments (<?php print sizeof($va_comments); ?>)</a></div><!-- end detailTool -->
						<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
<?php				
					}
					if ($vn_share_enabled) {
						print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					}
					print '</div><!-- end detailTools -->';
				}				
?>
					
				</div><!-- end col -->
				<div class='col-sm-6 col-md-6 col-lg-6'>
					
					{{{<ifcount code="ca_collections" min="1" max="1"><H6>Related collection</H6></ifcount>}}}
					{{{<ifcount code="ca_collections" min="2"><H6>Related collections</H6></ifcount>}}}
					{{{<unit relativeTo="ca_entities_x_collections" delimiter="<br/>"><unit relativeTo="ca_collections"><l>^ca_collections.preferred_labels.name</l> (^relationship_typename)</unit></unit>}}}

<?php
					$va_rel_entities = $t_item->get("ca_entities.related", array("returnWithStructure" => true));
					if(is_array($va_rel_entities) && sizeof($va_rel_entities)){
						if(sizeof($va_rel_entities) == 1){
							print "<H6>Related person/organization</H6>";
						}else{
							print "<H6>Related people/organizations</H6>";
						}
						$va_tmp = array();
						foreach($va_rel_entities as $vn_i => $va_rel_entity){
							$va_tmp[] = caDetailLink($this->request, $va_rel_entity["label"], '', 'ca_entities', $va_rel_entity["entity_id"])." (".$va_rel_entity["relationship_typename"].")";
						}
						print join("<br/>", $va_tmp);
					}
?>
					
					{{{<ifcount code="ca_occurrences" min="1" max="1"><H6>Related exhibition/event</H6></ifcount>}}}
					{{{<ifcount code="ca_occurrences" min="2"><H6>Related exhibitions/events</H6></ifcount>}}}
					{{{<unit relativeTo="ca_entities_x_occurrences" delimiter="<br/>"><unit relativeTo="ca_occurrences" delimiter="<br/>"><l>^ca_occurrences.preferred_labels.name</l></unit> (^relationship_typename)</unit>}}}
					
				</div><!-- end col -->
			</div><!-- end row -->
			
{{{<ifcount code="ca_objects" min="2">
			<div class="row">
				<div class="col-sm-12">
					<br/><H4>Related Items</H4>
				</div>
			</div>
			<div class="row">
				<div id="browseResultsContainer">
					<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>
				</div><!-- end browseResultsContainer -->
			</div><!-- end row -->
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'Search', 'objects', array('view' => 'images', 'search' => 'entity_id:^ca_entities.entity_id'), array('dontURLEncodeParameters' => true)); ?>", function() {
						jQuery('#browseResultsContainer').jscroll({
							autoTrigger: true,
							loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
							padding: 20,
							nextSelector: 'a.jscroll-next'
						});
					});
					
					
				});
			</script>
</ifcount>}}}
		</div><!-- end container -->
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