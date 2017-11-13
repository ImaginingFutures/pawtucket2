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
<div class="page-title-container clearfix">
    <h1 class="page-title">American Ceramics & Ceramic National Exhibition Archive</h1>
</div>
			<nav class="navbar navbar-default yamm">
			<form class="navbar-form navbar-right" role="search" action="<?php print caNavUrl($this->request, '', 'MultiSearch', 'Index'); ?>">
				<div class="formOutline">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search" name="search">
					</div>
					<button type="submit" class="btn-search"><span class="glyphicon glyphicon-search"></span></button>
				</div>
			</form>	
			<ul class="nav navbar-nav navbar-right">
				<li <?php print ($this->request->getController() == "Collection") ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Collections"), "", "FindingAid", "Collection", "Index"); ?></li>				
				<?php print $this->render("pageFormat/browseMenu.php"); ?>	
				<li <?php print (($this->request->getController() == "Search") && ($this->request->getAction() == "advanced")) ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Advanced Search"), "", "", "Search", "advanced/objects"); ?></li>
				<li <?php print ($this->request->getController() == "Gallery") ? 'class="active"' : ''; ?>><?php print caNavLink($this->request, _t("Gallery"), "", "", "Gallery", "Index"); ?></li>
			</ul>
			</nav>
<div class="container " style="padding-bottom:50px;">

	<div class="row">
		<div class="col-sm-12 pageContent">
			<p>The Everson Museum of Art's internationally recognized ceramics collection includes some of the finest representations of modern and contemporary American ceramics in the United States. With comprehensive collections and archival holdings central to the history of American ceramics, the Everson is focused on becoming the country's leading center for ceramics research and exhibitions. </p>
			<p>A generous grant from the Henry Luce Foundation supported the museum's recently completed effort to photograph and digitize a significant portion of the collection and archive.  The new publicly accessible and searchable database offers artists, collectors, curators, scholars, and students the previously unavailable opportunity to engage directly with this valuable chapter in American art history. This critical preservation project is part of the Everson's larger effort to reinstall the ceramics collection in a newly renovated space and to create a world class Ceramics Research Center.</p>
			<p>Featuring more than 6,000 objects, the ceramics collection is at the core of the museum's permanent collection. The Everson's long-term commitment to the ceramic arts began in 1916 with the acquisition of thirty-two works by Adelaide Alsop Robineau, the one American studio potter whose work was ranked, without qualification, alongside that of Europe’s great masters in the early twentieth century. Robineau lived and worked in Syracuse at the height of the Arts and Crafts movement, earning international fame in 1911 after capturing first prize at the Turin International with her popularly named Scarab Vase – dubbed by many as the Mona Lisa of ceramics. Robineau's master work has anchored the museum's ceramics collection since its acquisition in 1916.</p>
			<p>In the 100 years since acquiring the Scarab Vase, the Everson has continued to strengthen its focus on American ceramics. Notably, from 1932 until 1993, the <i>Ceramic Nationals</i>, a juried exhibition that attracted artists from across the country, was held at the Everson. The annual exhibition grew quickly in importance, and within its first eight years travelled to scores of American museums including the Whitney, Philadelphia Museum of Art, and the Fine Arts Museums of San Francisco. Many works in the Everson's permanent collection were acquired directly through the <i>Ceramic Nationals</i>. </p>
			<p>Not content to rest on the exhibition's success, Everson Director James Harithas, along with artist and curator Margie Hughto, set out in 1972 to challenge the format, presentation, and limits of clay as a medium for artistic production. On January 23, 1976, <i>New Works in Clay by Contemporary Painters and Sculptors</i> opened at the Everson. The success of this project spurred a series of exhibitions, lectures, and acquisitions that continues to guide the Everson's central role in contemporary American ceramics.</p>
			<p class='homelogo'><?php print caGetThemeGraphic($this->request, 'luce.jpg');?></p>
		</div> <!--end col-sm-4-->	
	</div><!-- end row -->
	<hr class="divide">
	<div class="row">
		<div class="col-sm-12 pageContent">
			<div class="pageContentTitle">Access Policy and Terms of Use</div>
				<p>The contents of the Ceramic National Exhibition & American Ceramics Archive, which includes finding aides, guides as well as digital content including correspondence, images, text, audio and video recordings are made publicly available by the Everson Museum of Art as the owner of the contents for use in research, teaching, and private study.</p>
				<p>The nature of historical archival and manuscript collections often makes it difficult to determine the copyright status of a particular item. Whenever possible, the Everson Museum provides available information about copyright owners and other restrictions in the metadata associated with digital images, texts, and audio and video recordings. This information is provided as a service to assist the user in determining the copyright status of an item. Ultimately, however, it is the user's responsibility to use an item according to the terms governing its use.</p>
				<p>The Everson Museum or Art is eager to hear from any copyright owners who are not properly identified so that appropriate information may be provided to researchers and teachers in the future. The museum will work with copyright holders in a timely manner to address the removal material from public view while we address any copyright concerns or other issues such as libel or invasion of privacy.</p>
			<div class="pageContentTitle">Conditions of Use</div>
			<p>By their use of these digital materials, images, texts, and audio and video recordings, users agree to the following conditions:</p>
			<ul>
				<li><b>1.</b>	Responsibility for any use of these materials rests exclusively with the user.</li>
				<li><b>2.</b>	Some materials in these collections may be protected by the U.S. Copyright Law (Title 17, U.S.C.). In addition, the reproduction of some materials may be restricted by terms of gift or purchase agreements, donor restrictions, privacy and publicity rights, licensing and trademarks. Transmission or reproduction of materials protected by copyright beyond that allowed by copyright law requires the written permission of the copyright owners.</li>
				<li><b>3.</b>	In many cases, the Everson Museum of Art does not hold the copyright to materials in its collections. If the work is not in the public domain, it is the responsibility of the researcher to secure permission from the appropriate copyright holder to publish items from the Archive.</li>
				<li><b>4.</b>	Permission to publish must be applied for separately by completing and submitting a Permission & Reproduction form. </li>
				<li><b>5.</b>	The Everson Museum requires the following credit line in citations and bibliographies for research publications:<br/><br/><p>For Archive Material:<br/> <i>Collection of Everson Museum of Art, Ceramic National Exhibition & American Ceramics Archive</i></p><p>For Permanent Collection Material:<br/> <i>Everson Museum of Art, Permanent Collection</i></p></li>
			</ul>
		</div>
	</div>
</div> <!--end container-->