<?
	require('../../../master.inc.php');
?>

function docPopin_set_link() {
	/*
	 * http://127.0.0.1/ATM/dolibarr/htdocs/document.php?modulepart=facture&file=02277394%2F02277394.pdf 
	 */
	
	$('table.formdoc a,div.linkobject a').each(function() {
		
		var url = $(this).attr('href');
		
		if(url.indexOf('document.php?')!=-1 && url.indexOf('.pdf')!=-1 ) {
			
			url = "javascript:docPopin_pop('<?=dol_buildpath('/docpopin/Viewer.js',1)  ?>#"+url+"')";
			
			$(this).attr('href', url);
			$(this).attr('target','_self');
		}
		
	});
}

function docPopin_pop(url) {
	
	if($('#docpopin').length==0) {
		$('body').append('<div id="docpopin"><iframe src="#" width="100%" height="100%"></iframe></div>');
	}
	
	
	$('#docpopin').dialog({
		title:"<?=$langs->trans('Preview') ?>"
		,width:'80%'
		,height:600
		,modal:true
	});
	
	$('#docpopin iframe').attr('src', url);
	
}

$(document).ready(function() {
	docPopin_set_link();
});
