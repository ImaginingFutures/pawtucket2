<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
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
		print $this->render("Front/featured_set_slideshow_html.php");
?>
	<div class="row leaf_bg">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
			<H1>{{{home_intro_text}}}</H1>
		</div><!--end col-sm-8-->
	</div>
	<div class="row sectionLinks">
		<div class="col-sm-12 text-center">
			<div class="row">
				<div class="col-sm-12">
					<H2>Explore</H2>
				</div>
			</div>
			<div class="row sectionLinks">
				<div class="col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-2 text-center">
<?php
				print caNavLink($this->request, caGetThemeGraphic($this->request, 'archive.jpg', array("alt" => "Archive")), "", "", "Browse", "objects", array("facet" => "type_facet", "id" => "25"));
				print caNavLink($this->request, "Archival Items", "", "", "Browse", "objects", array("facet" => "type_facet", "id" => "25"));
?>
				</div>
				<div class="col-sm-8 col-sm-offset-2 col-md-offset-0 col-md-2 text-center">
<?php
				print caNavLink($this->request, caGetThemeGraphic($this->request, 'artifacts.jpg', array("alt" => "Artifacts")), "", "", "Browse", "objects", array("facet" => "type_facet", "id" => "23"));
				print caNavLink($this->request, "Artifacts", "", "", "Browse", "objects", array("facet" => "type_facet", "id" => "23"));
?>
				</div>
				<div class="col-sm-8 col-sm-offset-2 col-md-offset-0 col-md-2 text-center">
<?php
				print caNavLink($this->request, caGetThemeGraphic($this->request, 'exhibition.jpg', array("alt" => "Exhibition")), "", "", "Exhibition", "Index");
				print caNavLink($this->request, "Exhibition", "", "", "Exhibition", "Index");
?>
				</div>
				<div class="col-sm-8 col-sm-offset-2 col-md-offset-0 col-md-2 text-center">
<?php
				print caNavLink($this->request, caGetThemeGraphic($this->request, 'education.jpg', array("alt" => "Education")), "", "", "Education", "");
				print caNavLink($this->request, "Education", "", "", "Education", "");
?>
				</div>
			</div><!-- end row -->
		</div>
	</div>