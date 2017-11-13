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
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-5">
			<div class="welcome_box">
				<h1>Welcome to The Historical Society of Pennsylvania's Digital Library</h1>
				
				<a href="<?php print caNavUrl($this->request, '', 'About', 'faq', array()) ?>" role="button" class="btn btn-danger license_button">YOU CAN NOW PURCHASE IMAGES IN THE DIGITAL LIBRARY!</a>
				
				<div class="welcome_text">
					<p>For information about purchasing images please see our <?php print caNavLink($this->request, _t('FAQ'), '', '', 'About', 'faq', array()) ?>.
					<p>We invite you to explore the origins and diversity of Pennsylvania and the United States, from the colonial period and the nation's founding to the experience of contemporary life. Conduct research in the online catalogs, browse our exhibits and publications, and join us in preserving and understanding our heritage as a diverse and dynamic people.</p>
				</div>
			</div>
		</div><!--end col-sm-8-->
		<div class="col-xs-12 col-sm-7">
<?php
		print $this->render("Front/featured_set_slideshow_html.php");
		#print $this->render("Front/gallery_set_links_html.php");
?>
		</div> <!--end col-sm-4-->	
	</div><!-- end row -->
</div> <!--end container-->