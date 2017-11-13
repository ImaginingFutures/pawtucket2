<?php
	# --- ask an archivist
	$ps_contactType = $this->request->getParameter("contactType", pString);
	if(!$ps_contactType){
		$ps_contactType = "contact";
	}
	$pn_object_id = $this->request->getParameter("object_id", pInteger);
	if($pn_object_id){
		require_once(__CA_MODELS_DIR__."/ca_objects.php");
		$t_item = new ca_objects($pn_object_id);
		$vs_url = $this->request->config->get("site_host").caNavUrl($this->request, "Detail", "objects", $t_item->get("ca_objects.object_id"));
		$vs_name = $t_item->get("ca_objects.preferred_labels.name");
		$vs_idno = $t_item->get("ca_objects.idno");
	}
	$pn_collecion_id = $this->request->getParameter("collection_id", pInteger);
	if($pn_collecion_id){
		require_once(__CA_MODELS_DIR__."/ca_collections.php");
		$t_item = new ca_collections($pn_collecion_id);
		$vs_url = $this->request->config->get("site_host").caNavUrl($this->request, "Detail", "collections", $t_item->get("ca_collections.collection_id"));
		$vs_name = $t_item->get("ca_collections.preferred_labels.name");
		$vs_idno = $t_item->get("ca_collections.idno");
	}
	$va_errors = $this->getVar("errors");
	$vn_num1 = rand(1,10);
	$vn_num2 = rand(1,10);
	$vn_sum = $vn_num1 + $vn_num2;
?>
<H1>
<?php
	if($ps_contactType == "contact"){
		print "<H1>"._t("Contact")."</H1>";
	}else{
		print "<H1>"._t("Ask An Archivist")."</H1>";	
	}
	if(sizeof($va_errors["display_errors"])){
		print "<div class='alert alert-danger'>".implode("<br/>", $va_errors["display_errors"])."</div>";
	}
?>
	<form id="contactForm" action="<?php print caNavUrl($this->request, "", "Contact", "send"); ?>" role="form" method="post">
<?php
	if($ps_contactType == "askArchivist"){
?>
		<div class="row">
			<div class="col-sm-10">
				Please use this form to inquire about a specific item in our archive.
				<H2><b>Item title: </b><?php print $vs_name; ?></H2>
				<H2><b>Item identifier: </b><?php print $vs_idno; ?></H2>

				<H2><b>Regarding this URL: </b><a href="<?php print $vs_url; ?>"><?php print $vs_url; ?></a></H2>
				<br/>
				<input type="hidden" name="itemId" value="<?php print $vs_idno; ?>">
				<input type="hidden" name="itemTitle" value="<?php print $vs_name; ?>">
				<input type="hidden" name="itemURL" value="<?php print $vs_url; ?>">
			</div>
		</div>
<?php
	}
?>
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group<?php print (($va_errors["name"]) ? " has-error" : ""); ?>">
							<label for="name">Name</label>
							<input type="text" class="form-control input-sm" id="email" placeholder="Enter name" name="name" value="<?php print ($this->getVar("name")) ? $this->getVar("name") : trim($this->request->user->get("fname")." ".$this->request->user->get("lname")); ?>">
						</div>
					</div><!-- end col -->
					<div class="col-sm-6">
						<div class="form-group<?php print (($va_errors["email"]) ? " has-error" : ""); ?>">
							<label for="email">Email address</label>
							<input type="text" class="form-control input-sm" id="email" placeholder="Enter email" name="email" value="<?php print ($this->getVar("email")) ? $this->getVar("email") : $this->request->user->get("email"); ?>">
						</div>
					</div><!-- end col -->
				</div><!-- end row -->
			</div><!-- end col -->
		</div><!-- end row -->
		<div class="row">
			<div class="col-sm-8">
				<div class="form-group<?php print (($va_errors["message"]) ? " has-error" : ""); ?>">
					<label for="message">Message</label>
					<textarea class="form-control input-sm" id="message" name="message" rows="5">{{{message}}}</textarea>
				</div>
			</div><!-- end col -->
		</div><!-- end row -->
		<div class="form-group">
			<button type="submit" class="btn btn-default">Send</button>
		</div><!-- end form-group -->
		<input type="hidden" name="sum" value="<?php print $vn_sum; ?>">
		<input type="hidden" name="contactType" value="<?php print $ps_contactType; ?>">
		<input type="hidden" name="object_id" value="<?php print $pn_object_id; ?>">
	</form>