<?php
	$va_set_typename = $this->getVar("sets_typename");
	$va_sets_config = $this->getVar("sets_type_config");
	
	$this->config = caGetGalleryConfig();
	$va_access_values = caGetUserAccessValues($this->request);

?>

<div class="container galleryDetail">
	<div class="row"><div class="col-sm-12">
		<H1><?php print $va_sets_config[$va_set_typename]['name']; ?></H1>
		<p style='margin-left:15px;' class='textContent'>
			<?php print $va_sets_config[$va_set_typename]['description']; ?>
		</p>
	</div><!-- end col -->	</div><!-- end row -->	
	<hr>
	<div class="row">
<?php
		$t_set = new ca_sets();
		$va_sets = caExtractValuesByUserLocale($t_set->getSets(array('table' => 'ca_objects', 'checkAccess' => $va_access_values, 'setType' => $va_set_typename, 'sort' => 'ca_sets.set_rank')));
		$r_sets = caMakeSearchResult("ca_sets", array_keys($va_sets), array("sort" => array("ca_sets.set_rank"), "sortDirection" => "asc"));

		if($r_sets->numHits()){
			while($r_sets->nextHit()){
				if ($r_sets->get('ca_sets.hide', array('convertCodesToDisplayText' => true)) != "No") {					
					$vn_set_id = $r_sets->get("set_id");
					$t_set = new ca_sets($vn_set_id);
					$va_set_items = caExtractValuesByUserLocale($t_set->getItems(array("thumbnailVersions" => array("iconlarge", "icon"), "checkAccess" => $va_check_access, "limit" => 3)));
					#$va_first_item = array_shift($va_first_items_from_set[$vn_set_id]);
					$va_set_info = $va_sets[$vn_set_id];
					if (sizeof($va_set_items) == 1 ) { $vs_one_image = "oneItem";} else { $vs_one_image = "";}
					if (sizeof($va_set_items) > 0 ) {
						print "<div class='col-sm-4 col-lg-3'><div class='setTile ".$vs_one_image."'>";
						$vs_item = 0;
						foreach ($va_set_items as $va_key => $va_set_item) {
							if ($vs_item == 0) {
								print "<div class='setImage'>".caNavLink($this->request, $va_set_item['representation_tag_iconlarge'], '', '', 'Gallery', $vn_set_id)."</div>";
							} else {
								print "<div class='imgPreview'>".$va_set_item['representation_tag_iconlarge']."</div>";
							}
							$vs_item++;
						}
						print "<div class='name'>".caNavLink($this->request, $va_set_info['name'], '', '', 'Gallery', $vn_set_id)." <small>(".$va_set_info['item_count']." items)</small></div>";
						print "<div class='user'>created by: ".$r_sets->get('ca_users.user_name')."</div>";
						print "</div></div>";
					}
				}
			}	
		}
		
?>
	</div><!-- end row -->	
</div><!-- end container -->		
		