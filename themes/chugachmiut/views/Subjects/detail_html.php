<?php
	$va_subjects = $this->getVar("subjects");
	$vs_subject_name = $this->getVar("subject_name");
	$vn_parent_id = $this->getVar("parent_id");
?>
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
<H1><?php
			if($vn_parent_id){
				print caNavLink($this->request, "<i class='fa fa-arrow-left'></i>", "", "", "Subjects", "Detail", array("subject_id" => $vn_parent_id))." ".$vs_subject_name;
			}else{
				print caNavLink($this->request, "<i class='fa fa-arrow-left'></i>", "", "", "Subjects", "Index")." ".$vs_subject_name;
			}
?></H1>
			
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="peopleFeaturedList">
<?php	
	if(is_array($va_subjects) && sizeof($va_subjects)) {
		foreach($va_subjects as $vn_subject_id => $va_subject) {
			$vs_image = "";
			#print "\n<div class='row'><div class='col-sm-12 col-md-6 col-md-offset-3'>".caNavLink($this->request, "<div class='subjectsTile'>".$vs_image."<div class='title'>".$va_subject["name"]."</div></div>", "", "", "Browse", "objects", array("facet" => "subjects_facet", "id" => $vn_subject_id))."</div></div>";
			print "\n<div class='row'><div class='col-sm-12 col-md-6 col-md-offset-3'><div class='subjectsTile'>";
			if($va_subject["image"]){
				print "<div class='subjectsImage'>".$va_subject["image"]."</div>";
			}
			if($va_subject["children"]){
				print caNavLink($this->request, $va_subject["name"]." <i class='fa fa-arrow-right'></i>", "title".(($va_subject["image"]) ? "WithImage" : ""), "", "Subjects", "Detail", array("subject_id" => $vn_subject_id), array("title" => "More Subjects"));
			}else{
				print caNavLink($this->request, $va_subject["name"], "title".(($va_subject["image"]) ? "WithImage" : ""), "", "Browse", "objects", array("facet" => "subjects_facet", "id" => $vn_subject_id), array("title" => "Browse Heritage Items"));
			}
			print caNavLink($this->request, "<span class='glyphicon glyphicon-search' aria-label='Submit'></span>", "subjectsBrowse", "", "Browse", "objects", array("facet" => "subjects_facet", "id" => $vn_subject_id), array("title" => "Browse Heritage Items"));
			print "</div><!-- end tile --></div></div>";
		}
	}
		
	
?>		
			</div>
		</div>
	</div>