<?php
	$vs_item_name_singular = 'stop';
	$vs_item_name_plural = 'stops';
	
	$vn_object_id = null;
	if ($vn_entity_id = $this->getVar('entity_id')) {
		$vs_entity_name = $this->getVar('entity_name');
		$vs_entity_image = $this->getVar('entity_image');
	} elseif($vn_object_id = $this->getVar('object_id')) {
		$vs_object_name = $this->getVar('object_name');
		$vs_object_image = $this->getVar('object_image');
	}
	
	$va_stop_data = $this->getVar('stops');
	
	
	$vs_content = '';
	
	$vn_num_items = sizeof($va_stop_data);
	if ($vn_num_items > 0) {
		$qr_stops = caMakeSearchResult('ca_tour_stops', $va_stop_data, array('sort' => 'ca_tour_stops.tourStopDateSet.tourStopDateIndexingDate'));
	
		while($qr_stops->nextHit()) {
			$vn_stop_id = $qr_stops->get('ca_tour_stops.stop_id');
			$o_map = new GeographicMap(180, 75, 'itemMap'.$vn_stop_id);
		
			$vs_map = '';
			if (is_array($va_place_ids = $qr_stops->get('ca_places.place_id', array('returnAsArray' => true))) && sizeof($va_place_ids)) {
				$qr_map_res = caMakeSearchResult('ca_places', $va_place_ids);
				$o_map->mapFrom($qr_map_res, "ca_places.georeference");
				$vs_map = $o_map->render('JPEG', array('zoomLevel' => 6, 'mapType' => 'TERRAIN'));
			}
		
			$vs_name = $qr_stops->get('ca_tour_stops.preferred_labels.name');
			$vs_date = $qr_stops->get('ca_tour_stops.tourStopDateSet.tourStopDateDisplayDate');
			$vn_indexing_date = $qr_stops->get('ca_tour_stops.tourStopDateSet.tourStopDateIndexingDate', array('GET_DIRECT_DATE' => true));
			
			
			if ($vn_object_id) { 
				$vs_text = preg_replace("![\r\t\n ]+!", " ", $qr_stops->getWithTemplate('<strong>^ca_objects.preferred_labels.name</strong><br/>^ca_tour_stops.preferred_labels.name</br>^ca_tour_stops.tourStopDateSet.tourStopDateDisplayDate<br/>^ca_tour_stops.tour_stop_description<br/><br/><ifdef code="ca_list_items.preferred_labels"><em>Source: ^ca_list_items.preferred_labels</em></ifdef>'));
			} else {
				$vs_text = preg_replace("![\r\t\n ]+!", " ", $qr_stops->getWithTemplate('<strong>^ca_entities.preferred_labels.displayname</strong><br/>^ca_tour_stops.preferred_labels.name</br>^ca_tour_stops.tourStopDateSet.tourStopDateDisplayDate<br/>^ca_tour_stops.tour_stop_description<br/><br/><ifdef code="ca_list_items.preferred_labels"><em>Source: ^ca_list_items.preferred_labels</em></ifdef>'));
 			}
 								$vs_text = preg_replace("![']+!", "&apos;", $vs_text);
		
			$vs_content .= "<li data-date='{$vs_date}' data-indexing_date='{$vn_indexing_date}'><div class='travelerChronologyItem' data-toggle='tooltip' data-placement='right' data-viewport='#travelerContent' data-html='true' title='".($vs_text)."' data-container='body'><div class='travelerChronologyItemText'><span class='travelerChronologyItemDate'>{$vs_date}</span><br/><span class='travelerChronologyItemName'>{$vs_name}</span></div>{$vs_map}</div></li>";
		}
	}
?>
<div class='travelerChronologyTrack' <?php print $vn_entity_id ? "data-entity_id='{$vn_entity_id}'" : "data-object_id='{$vn_object_id}'"; ?> id='travelerChronologyTrackContainer<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>'>
	<div class='row travelerChronologyTrackContainer'>
		<div class='col-md-1 travelerChronologyTrackInfo'>
			<div class='trackTitle'><?php print $vn_entity_id ? $vs_entity_name : $vs_object_name; ?></div><!-- end trackTitle -->
			<div><?php print $vn_num_items.' '.(($vn_num_items == 1) ? $vs_item_name_singular : $vs_item_name_plural); ?></div>
			
			<div class='trackImage'><?php print $vn_entity_id ? $vs_entity_image : $vs_object_image; ?></div>
			
			<div class='travelerChronologyItemRemove' <?php print $vn_entity_id ? "data-entity_id='{$vn_entity_id}'" : "data-object_id='{$vn_object_id}'"; ?>>&#10006;</div>
		</div><!-- end trackInfo -->
		
		<div class='col-md-11 jcarousel travelerChronologyCarousel' id='travelerChronologyTrack<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>'>
			<ul>
				<?php print $vs_content; ?>
			</ul>
		</div><!-- end jcarousel -->
	</div><!-- end travelerChronologyTrackContainer -->
	<div class='row travelerChronologyCarouselSlider'>
		<div class='col-md-1 travelerChronologyTrackSliderOffset'><div class='travelerChronologySyncContainer'><?php print caGetThemeGraphic($this->request, 'chronology/clock.png', array('class' => 'travelerChronologySync', 'id' => 'travelerChronologySync'.($vn_entity_id ? $vn_entity_id : $vn_object_id), 'data-entity_id' => $vn_entity_id, 'data-object_id' => $vn_object_id)); ?></div></div>
		<div class='col-md-11 travelerChronologyTrackSliderContainer'><input type="text" id='travelerChronologyTrackSliderInput<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>' class='travelerChronologyTrackSliderInput' data-slider-id="travelerChronologyTrackSlider<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>"></div>
	</div>
</div>

<script type='text/javascript'>
	jQuery(document).ready(function() {
		jQuery('#travelerChronologyTrack<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>').jcarousel({size: <?php print (int)$vn_num_items; ?>, start: 0});
		
		jQuery("#travelerChronologyTrackSliderInput<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>").slider({min: 0, max: <?php print (int)$vn_num_items; ?>, formatter: function(v) {
			var item = jQuery('#travelerChronologyTrack<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>').jcarousel('items').eq(v);
			var d = jQuery(item).data('date');
			return d ? d : " - ";
		}}).on('slide', function(v) {
			jQuery('#travelerChronologyTrack<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>').jcarousel('scroll', parseInt(v.value));
		});
		jQuery("#travelerChronologyTrackSlider<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>").css("width", "100%");
		jQuery(".travelerChronologyItemRemove").bind("click", function() {
			var id = jQuery(this).data('entity_id');
			var idname, idtype;
			if (id) {
				idname = 'id';
				idtype = 'entity';
			} else {
				id = jQuery(this).data('object_id');
				idname = 'object_id';
				idtype = 'object';
			}
			jQuery.get('<?php print caNavUrl($this->request, '*', '*', 'Get', array('m' => 'remove')); ?>/' + idname + '/' + id, function() {
				jQuery('#travelerChronologyTrackContainer' + idtype + '_' + id).remove();
				
				if (jQuery(".travelerChronologyTrack").length == 0) {
					jQuery('#intineraChronologyNoEntities').show();
				}
			});
		});
		
		jQuery("#travelerChronologySync<?php print $vn_entity_id ? 'entity_'.$vn_entity_id : 'object_'.$vn_object_id; ?>").bind('click', function(e) {
			var id = jQuery(this).data('entity_id'); // entity to sync with
			var idname, idtype;
			if (id) {
				idname = 'id';
				idtype = 'entity';
			} else {
				id = jQuery(this).data('object_id');
				idname = 'object_id';
				idtype = 'object';
			}
			
			var item = jQuery('#travelerChronologyTrack' + idtype + '_' + id).jcarousel('first');
			var sync_date = jQuery(item).data('indexing_date');	// date to sync with
	
			jQuery('.travelerChronologyTrack').each(function(k, v) {
				var track_entity_id = jQuery(v).data('entity_id');
				
				var track_id = jQuery(this).data('entity_id');
				var track_idname, track_idtype;
				if (track_id) {
					track_idname = 'id';
					track_idtype = 'entity';
				} else {
					track_id = jQuery(this).data('object_id');
					track_idname = 'object_id';
					track_idtype = 'object';
				}
				
				if (track_id == id) { return; }
				
				var items = jQuery('#travelerChronologyTrack' + track_id).jcarousel('items');
				jQuery.each(items, function(i, j) {
					if (jQuery(j).data('indexing_date') > sync_date) {
						jQuery('#travelerChronologyTrack' + track_idtype + '_' + track_id).jcarousel('scroll', i);
						jQuery('#travelerChronologyTrackSliderInput<?php print 'entity_'.$vn_entity_id ? 'object_'.$vn_entity_id : $vn_object_id; ?>').slider('setValue', i, true, true);
						return false;
					}
				});
				
			});
			
		});
		
		jQuery('[data-toggle="tooltip"]').tooltip();
		jQuery('#intineraChronologyNoEntities').hide();
	});
</script>