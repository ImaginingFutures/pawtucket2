<H3>{{{<unit relativeTo="ca_collections" delimiter="<br/>">^ca_collections.hierarchy.preferred_labels.name%returnAsLink=1%delimiter=_➔_</unit>}}}</H3>

{{{<unit relativeTo="ca_collections" delimiter="<br/>"><ifdef code="ca_collections.CollectionNote.NoteContent%[NoteType=abstract]"><b>About the Collection</b>: ^ca_collections.CollectionNote.NoteContent%[NoteType=abstract]<br/><br/></ifdef></unit>}}}

<H5>{{{ca_objects.preferred_labels.name}}}</H5>

{{{<ifcount code="ca_entities" min="1" max="1"><b>Related person: </b></ifcount>}}}
{{{<ifcount code="ca_entities" min="2"><b>Related people: </b></ifcount>}}}
{{{<unit relativeTo="ca_entities" delimiter=", "><l>^ca_entities.preferred_labels.displayname</l></unit><br/><br/>}}}

<?php print caDetailLink($this->request, _t("VIEW RECORD"), '', 'ca_objects',  $this->getVar("object_id")); ?>