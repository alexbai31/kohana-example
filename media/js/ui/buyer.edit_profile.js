$(document).ready(function(){
	$("#location").change(function(){
		$(this).next().remove();
		$.getJSON(url_base + "buyer/get_location/" + $(this).val(), function(response){
			var select = $("#location").clone();
			select.empty();
			select.attr({name:"region_id", id:"citys"});
			console.log($("#select_location"));
			for(var i in response){
				select.append(new Option(response[i].name, response[i].id));
			}

			$(".selects").append(select);
		});
	});
});