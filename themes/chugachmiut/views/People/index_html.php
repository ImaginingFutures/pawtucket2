<?php
	$qr_people = $this->getVar("set_items_as_search_result");
?>
	<div class="row">
		<div class="col-sm-12 col-lg-10 col-lg-offset-1">
			<H1>People</H1>
			<div class="row bgTurq">
				<div class="col-sm-6 peopleHeaderImage">
					<?php print caGetThemeGraphic($this->request, 'People.jpg', array("alt" => "People")); ?>
				</div>
				<div class="col-sm-6 text-center">
					<div class="peopleIntro">{{{people_intro}}}</div>
					<div class="peopleSearch"><form role="search" action="<?php print caNavUrl($this->request, '', 'Search', 'people'); ?>">
						<div class="formOutline">
							<div class="form-group">
								<input type="text" class="form-control" id="peopleSearchInput" placeholder="<?php print _t("Search People"); ?>" name="search" autocomplete="off" aria-label="<?php print _t("Search"); ?>" />
							</div>
							<button type="submit" class="btn-search" id="peopleSearchButton"><span class="glyphicon glyphicon-search" aria-label="<?php print _t("Submit Search"); ?>"></span></button>
						</div>
					</form></div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="row peopleBrowseButton">
		<div class="col-sm-9 col-sm-offset-3 col-md-4 col-md-offset-4 text-center">
<?php
					print caNavLink($this->request, "Browse All Community Members <i class='fa fa-arrow-right'></i>", "btn btn-default", "", "Browse", "community_members");
?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="peopleFeaturedList">
				<div class="row">
					<div class='col-sm-12 col-md-8 col-md-offset-2'>
						<hr/>
						<H2>Featured Community Members</H2>
					</div>
				</div>
<?php	
	$vn_i = 0;
	if($qr_people && $qr_people->numHits()) {
		print "<div class='row'><div class='col-sm-12 col-md-8 col-md-offset-2'>";
		while($qr_people->nextHit()) {
			$vs_image_col = $vs_image = $vs_quote = "";
			$vs_name = $qr_people->get("ca_entities.preferred_labels.displayname");
			$vs_quote = $qr_people->get("ca_entities.quote");
			
			if($vs_image = $qr_people->get("ca_object_representations.media.iconlarge")){
				$vs_image_col = "<div class='col-sm-4'>".caDetailLink($this->request, $vs_image, "", "ca_entities", $qr_people->get("ca_entities.entity_id"))."</div>\n";
			}
			$vs_quote_col = (($vs_image) ? "<div class='col-sm-8'>" : "<div class='col-sm-8'>").caDetailLink($this->request, $vs_name, "personName", "ca_entities", $qr_people->get("ca_entities.entity_id"))."<div class='peopleFeaturedQuote'>&ldquo;".$vs_quote."&rdquo;</div>".caDetailLink($this->request, "More", "btn btn-default", "ca_entities", $qr_people->get("ca_entities.entity_id"))."</div>";
			print "\n<div class='row peopleFeaturedRow'>";
			if($i == 1){
				print $vs_image_col.$vs_quote_col;
			}else{
				print $vs_quote_col.$vs_image_col;
			}
			print "</div>";
			
			$i++;
			if($i == 2){
				$i = 0;
			}
			
		}
		print "</div></div>";
	} else {
		print _t('No communities available');
	}
?>		
			</div>
		</div>
	</div>