<?php
/** ---------------------------------------------------------------------
 * themes/default/Listings/listing_html : 
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
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
 
 	$va_lists = $this->getVar('lists');
 	$va_type_info = $this->getVar('typeInfo');
 	$va_listing_info = $this->getVar('listingInfo');
?>
	<div class="listing-content single-lists">
<?php 
	$va_links_array = array();
	$va_letter_array = array();
	foreach($va_lists as $vn_type_id => $qr_list) {
		if(!$qr_list) { continue; }
		
		print "<h2>{$va_listing_info['displayName']}</h2>\n";
		
		print "<p>"._t('This list of playwrights, translators, and adaptors has been compiled from indexes in the')." ".caNavLink($this->request, 'printed catalogs of comedias sueltas', '', '', 'Listing', 'sources')._t(" in the US and Toronto.")."</p>";
		print "<p>"._t('The form of name most frequently appears as printed on the sueltas. In some cases, spelling and diacritics have been adapted according to modern practice. Birth and death dates are repeated in each instance. When known, the more commonly accepted form of a name is in italics.')."</p>";
		
		while($qr_list->nextHit()) {
			$vs_first_letter = ucfirst(substr($qr_list->get('ca_entities.preferred_labels.surname'), 0, 1));
			$va_letter_array[$vs_first_letter] = $vs_first_letter;
			$vn_id = $qr_list->get('ca_entities.entity_id');
			$va_links_array[$vs_first_letter][$vn_id] = "<div class='listLink'>".$qr_list->getWithTemplate('<l>^ca_entities.preferred_labels.displayname</l>')."</div>\n";	
		}
		foreach ($va_links_array as $va_first_letter => $va_links) {
			print "<p class='separator'><a name='".$vs_first_letter."'></a><br></p>";			
			print "<h2 id='".$va_first_letter."' class='mw-headline'>".$va_first_letter."</h2>";
			foreach ($va_links as $va_entity_id => $va_link) {
				print $va_link;
			}
		}
	}
?>
	<div id='toc_container'>
		<div id='toc_content' class='arrow-scroll'>
			<ul id='tocList'>
<?php
	foreach ($va_letter_array as $va_key => $va_letter) {
		print "<li class='tocLevel2'><a class='tocLink' href='#".$va_letter."'>".$va_letter."</a></li>";
	}
?>
			</ul><!-- end tocList -->
			<div class="tocListArrow topArrow"></div>
			<div class="tocListArrow bottomArrow"></div>
		</div><!-- end toc_content -->
	</div><!-- end toc_container -->


	</div>