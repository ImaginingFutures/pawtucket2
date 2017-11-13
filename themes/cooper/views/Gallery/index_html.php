<?php
	$va_sets = $this->getVar("sets");
	$va_first_items_from_set = $this->getVar("first_items_from_sets");
	$va_access_values = $this->getVar('access_values');
	if(is_array($va_sets) && sizeof($va_sets)){
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 frontGalleries">
<?php
			if(sizeof($va_sets) > 1){
				$i = 1;
				foreach($va_sets as $vn_set_id => $va_set){
					$t_set = new ca_sets($vn_set_id);
					$qr_set_items = caMakeSearchResult("ca_objects", array_keys($t_set->getItemRowIDs()));
					if($qr_set_items->numHits()){
?>
						<div class="frontGallerySlideLabel"><?php print $va_set["name"].caNavLink($this->request, _t("See All")." <i class='fa fa-caret-down'></i>", "allButton", "", "Gallery", $vn_set_id);?></div>
						<div class="jcarousel-wrapper">
							<!-- Carousel -->
							<div class="jcarousel gallery<?php print $i; ?>">
								<ul>
<?php
									while($qr_set_items->nextHit()){
										$vs_image = $qr_set_items->get('ca_object_representations.media.medium', array("checkAccess" => $va_access_values));
										if(!$vs_image){
											$vs_image = caGetThemeGraphic($this->request, 'frontImage.jpg', array("style" => "opacity:.5;"));
										}
										print "<li><div class='frontGallerySlide'>".caDetailLink($this->request, $vs_image, "", "ca_objects", $qr_set_items->get("ca_objects.object_id"))."<div class='frontGallerySlideCaption'>".caDetailLink($this->request, $qr_set_items->get("ca_objects.preferred_labels.name"), "", "ca_objects", $qr_set_items->get("ca_objects.object_id"))."</div></div></li>";
									}
?>
								</ul>
							</div><!-- end jcarousel -->
							<!-- Prev/next controls -->
							<a href="#" class="jcarousel-control-prev previous<?php print $i; ?>"><i class="fa fa-caret-left"></i></a>
							<a href="#" class="jcarousel-control-next next<?php print $i; ?>"><i class="fa fa-caret-right"></i></a>
						</div><!-- end jcarousel-wrapper -->
						<script type='text/javascript'>
							jQuery(document).ready(function() {
								/*
								Carousel initialization
								*/
								$('.gallery<?php print $i; ?>')
									.jcarousel({
										// Options go here
										wrap:'circular'
									});

								/*
								 Prev control initialization
								 */
								$('.previous<?php print $i; ?>')
									.on('jcarouselcontrol:active', function() {
										$(this).removeClass('inactive');
									})
									.on('jcarouselcontrol:inactive', function() {
										$(this).addClass('inactive');
									})
									.jcarouselControl({
										// Options go here
										target: '-=1'
									});

								/*
								 Next control initialization
								 */
								$('.next<?php print $i; ?>')
									.on('jcarouselcontrol:active', function() {
										$(this).removeClass('inactive');
									})
									.on('jcarouselcontrol:inactive', function() {
										$(this).addClass('inactive');
									})
									.jcarouselControl({
										// Options go here
										target: '+=1'
									});
							});
						</script>
		<?php
							$i++;
					}
				}
			}
?>		
					
		</div><!--end col-sm-12-->
	</div><!-- end row -->
</div> <!--end container-->
<?php
	}
?>