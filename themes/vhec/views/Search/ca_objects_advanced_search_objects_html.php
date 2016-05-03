<div class="container">
	<div class="row">
		<div class="col-sm-8 ">
			<h1>Advanced Search</h1>

<?php			
	print "<p>Enter your search terms in the fields below.</p>";
?>

{{{form}}}
	
	<div class='advancedContainer'>
		<div class="advancedSearchField">
			Title:<br/>
			{{{ca_objects.preferred_labels.name%width=300px}}}
		</div>
		<div class="advancedSearchField">
			Accession number:<br/>
			{{{ca_objects.idno%width=260px}}}
		</div>
		<div class="advancedSearchField">
			Keyword<br/>
			{{{_fulltext%width=300px&height=25px}}}
		</div>
		<div class="advancedSearchField">
			Type:<br/>
			{{{ca_objects.type_id%width=300px}}}
		</div>
		<div class="advancedSearchField">
			Date range <i>(e.g. 1970-1979)</i><br/>
			{{{ca_objects.displayDate%width=300px&height=25px&useDatePicker=0}}}
		</div>
		
		<div class="advancedSearchField">
			Collection <br/>
			{{{ca_collections.preferred_labels%restrictToTypes=collection%width=420px}}}
		</div>

		<br style="clear: both;"/>
	
		<div style="float: right; margin-left: 20px;">{{{reset%label=Reset}}}</div>
		<div style="float: right;">{{{submit%label=Search}}}</div>
	
	</div>	
	

{{{/form}}}

		</div>
		<div class="col-sm-4" style='border-left:1px solid #ddd;'>
			<h1>Helpful Hints</h1>
			<p>Include some helpful info for your users here.</p>
		</div><!-- end col -->
	</div><!-- end row -->
</div><!-- end container -->