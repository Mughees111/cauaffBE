function removeDescpSection(that){
	$(that).parent().parent().remove();
}
function removeVariation(that)
{
	$(that).parent().parent().remove();
}
function moreDescp(that,mlang)
{

	$.post(base_url+'admin/products/view_description_section/'+mlang,{data:true},function(data){
		$("#add_more_descps_in_me"+mlang).append(data);
	});
}
function moreImage(that,mlang)
{

	$.post(base_url+'admin/products/view_more_image/'+mlang,{data:true},function(data){
		$("#add_more_images_in_me"+mlang).append(data);
		$('.dropify').dropify();
	});
}


function moreVariation(that,mlang)
{

	$.post(base_url+'admin/products/view_variation_section/'+mlang,{data:true},function(data){
		$("#add_more_variation_in_me"+mlang).append(data);
		$('.dropify').dropify();
	});
}