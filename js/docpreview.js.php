<?php
	if(is_file('../../master.inc.php'))  require('../../master.inc.php');
	else require('../../../master.inc.php');
	
	$langs->load('docpreview@docpreview');
	header('Content-Type: text/javascript');
	//echo $langs->trans('PreviewOf');
?>
/*<script type="text/javascript">*/
function docPreview_set_link() {
	$('a[href]').each(function() {
		
		var url = $(this).attr('href');
		
		if(url.indexOf('document.php?')!=-1 && url.indexOf('action=delete')==-1 && (url.toLowerCase().indexOf('.pdf')!=-1 || url.toLowerCase().indexOf('.odt')!=-1) ) {
			filename = $(this).text();
			if(filename == '') filename = $(this).find('img').attr('alt');
			if(filename == '') filename = $(this).find('img').attr('title');
			if(filename) {
				if (url.indexOf('file=') !== -1) {
					let Tab = url.split('?');
					if (Tab.length > 1) {
						let get_params = Tab[1].split('&');
						get_params.sort(function(a, b) {
							if (a.indexOf('file=') !== -1) return 1;
							else if (b.indexOf('file=') !== -1) return -1;
							return 0;
						});
						Tab[1] = get_params.join('&');
					}
					url = Tab.join('?');
				}
				
				url = "javascript:docPreview_pop('<?php echo dol_buildpath('/docpreview/Viewer.js/v.html',1) ?>#"+encodeURIComponent(url)+"', '"+filename.replace(/'/g, "\\'")+"')";
				link = '&nbsp;<a href="'+url+'"><?php echo img_object($langs->trans('Preview'),'docpreview@docpreview') ?></a>';
			
				$(this).after(link);
			}
		}
		
	});
}

function docPreview_pop(url, filename) {
	
	$('#docpreview').remove();
	
	if($('#docpreview').length==0) {
		$('body').append('<div id="docpreview"><iframe src="#" width="100%" height="100%" allowfullscreen webkitallowfullscreen frameborder=0></iframe></div>');
	}
	
	$('#docpreview').dialog({
		title: "<?php echo $langs->transnoentities('PreviewOf') ?> " + filename
		,width:'80%'
		,height:600
		,modal:true
		,resizable: false
		,close:function() {
			$('#docpreview iframe').attr('src', '#');
		}
	});
	
	$('#docpreview iframe').attr('src', url);
	
}

$(document).ready(function() {
	docPreview_set_link();
});
