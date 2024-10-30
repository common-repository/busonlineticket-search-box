jQuery(document).ready(function () {
	// Event listener to toggle dropdown visibility
	document.addEventListener('click', function (event) {
		var dropdownContainers = document.querySelectorAll('.dropdown-container');
		
		dropdownContainers.forEach(function (container) {
			if (!container.contains(event.target)) 
			{
				container.style.display = 'none';
			}
		});
	});

	// Event listener to toggle "From" dropdown visibility on input click
	document.querySelector('.txtFromLoc').addEventListener('click', function (event) {
		event.stopPropagation(); // Prevent the click event from reaching the document listener
		toggleDropdown('.divSearchResultFrom');
	});

	// Event listener to toggle "To" dropdown visibility on input click
	document.querySelector('.txtToLoc').addEventListener('click', function (event) {
		event.stopPropagation(); // Prevent the click event from reaching the document listener
		toggleDropdown('.divSearchResultTo');
	});

	function toggleDropdown(selector) 
	{
		var dropdown = document.querySelector(selector);
		dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
	}
	
	var typeValue;
	var BOTDefault_Type;
	var _ticketType;
	
	// Check if 'type_searchbox' is not empty
	if (jQuery('select[name="type_searchbox"]').val() !== '') 
	{
		typeValue = jQuery('select[name="type_searchbox"]').val();
	} 
	
	else 
	{
		// If 'type_searchbox' is empty, get value from 'editedType'
		typeValue = jQuery('select[name="editedType"]').val();
	}
	
	BOTDefault_Type = typeValue;
	_ticketType = typeValue;	

	// Trigger the change event for the default selected value
	// jQuery('select[name="type_searchbox"]').trigger('change');
	
	jQuery('select[name="type_searchbox"]').change(function () {
		// Get the selected values
		typeValue = jQuery(this).val();
		
		BOTDefault_Type = typeValue;
		_ticketType = typeValue;		

		jQuery('.txtFromLoc').val('');
		jQuery('.txtToLoc').val('');			
	});
	
	jQuery('select[name="editedType"]').change(function () {
		// Get the selected values
		typeValue = jQuery(this).val();
		
		BOTDefault_Type = typeValue;
		_ticketType = typeValue;		

		jQuery('.txtFromLoc').val('');
		jQuery('.txtToLoc').val('');			
	});		

	jQuery(function () {			
		if (BOTDefault_Type != undefined) 
		{
			if (BOTDefault_Type == "bus") 
			{
				choseType('bus');
			}

			else if (BOTDefault_Type == "train") 
			{
				choseType('train');               
			}

			else if (BOTDefault_Type == "ferry") 
			{
				choseType('ferry');               
			}
		} 

		jQuery(".txtFromLoc:visible").on("keyup", function () {
			textFromBoxFetch();
		});

		jQuery(".txtFromLoc:visible").on("focus", function () {
			textFromBoxFetch();
		});

		jQuery(".txtFromLoc:visible").on("click", function () {
			jQuery(this).val("");
			textFromBoxFetch();
		});

		jQuery(".txtToLoc:visible").on("keyup", function () {
			textToboxFetch();
		});

		jQuery(".txtToLoc:visible").on("focus", function () {
			textToboxFetch();
		});

		jQuery(".txtToLoc:visible").on("click", function () {
			jQuery(this).val("");
			textToboxFetch();
		});

	});

	function choseType(type) 
	{
		if (type != "" && type != undefined) 
		{
			_ticketType = type;
			jQuery(".txtFromLoc:visible, .txtToLoc:visible").val("");
		}

		if (_ticketType == "bus") 
		{
			fetchFrom();
		}

		else if (_ticketType == "train") 
		{
			fetchKtmFrom();
		}

		else if (_ticketType == "ferry") 
		{
			fetchFerryFrom();
		}
		
		jQuery(".divSearchResultFrom").hide();
	}

	function fetchFrom(fromVal) 
	{
		var _code = '';

		if (fromVal == "") 
		{
			for (var i = 0; i < drpBus.length; i++) 
			{
				_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpBus[i].stateFrom + '</b></div><ul class="select2-result-sub">';
				for (var j = 0; j < drpBus[i].mapFrom.length; j++) 
				{
					_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-from"><div class="select2-result-label"><span class="select2-match"></span>' + drpBus[i].mapFrom[j].mFrom + '</div></li>';
				}
				
				_code += '</ul></li>';
			}
		}

		else 
		{
			for (var i = 0; i < drpBus.length; i++) 
			{
				var temp = i;
				for (var j = 0; j < drpBus[i].mapFrom.length; j++) 
				{
					if (drpBus[i].mapFrom[j].mFrom.search(new RegExp(fromVal, "i")) > -1) 
					{
						if (i == temp) 
						{
							_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpBus[i].stateFrom + '</b></div><ul class="select2-result-sub">';
							temp++;
						}

						_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-from"><div class="select2-result-label"><span class="select2-match"></span>' + drpBus[i].mapFrom[j].mFrom + '</div></li>';
					}

					_code += '</ul></li>';
				}
			}
		}

		_code += '</ul></div><div class="clearfix"></div>';
		jQuery(".div-from-location:visible .divSearchResultFrom ul").empty();
		jQuery(".div-from-location:visible .divSearchResultFrom ul").html(_code);
		jQuery(".div-from-location:visible .divSearchResultFrom").show();

		jQuery(".li-select-from").on("click", function () {
			addtoText("from", this);
		});
	}

	function fetchKtmFrom(fromVal) 
	{
		var _code = '';

		if (fromVal == "") 
		{
			for (var i = 0; i < drpTrain.length; i++) 
			{
				_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpTrain[i].stateFrom + '</b></div><ul class="select2-result-sub">';

				for (var j = 0; j < drpTrain[i].mapFrom.length; j++) 
				{
					_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-from"><div class="select2-result-label"><span class="select2-match"></span>' + drpTrain[i].mapFrom[j].mFrom + '</div></li>';
				}

				_code += '</ul></li>';
			}
		}
		else 
		{
			for (var i = 0; i < drpTrain.length; i++) 
			{
				var temp = i;

				for (var j = 0; j < drpTrain[i].mapFrom.length; j++) 
				{
					if (drpTrain[i].mapFrom[j].mFrom.search(new RegExp(fromVal, "i")) > -1) 
					{
						if (i == temp) 
						{
							_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpTrain[i].stateFrom + '</b></div><ul class="select2-result-sub">';
							temp++;
						}

						_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-from"><div class="select2-result-label"><span class="select2-match"></span>' + drpTrain[i].mapFrom[j].mFrom + '</div></li>';
					}

					_code += '</ul></li>';
				}
			}
		}

		_code += '</ul></div><div class="clearfix"></div>';
		jQuery(".div-from-location:visible .divSearchResultFrom ul").empty();
		jQuery(".div-from-location:visible .divSearchResultFrom ul").html(_code);
		jQuery(".div-from-location:visible .divSearchResultFrom").show();

		jQuery(".div-from-location:visible .li-select-from").on("click", function () {
			addtoText("from", this);
		});
	}

	function fetchFerryFrom(fromVal) 
	{
		var _code = '';

		if (fromVal == "") 
		{
			for (var i = 0; i < drpFerry.length; i++) 
			{
				_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpFerry[i].stateFrom + '</b></div><ul class="select2-result-sub">';

				for (var j = 0; j < drpFerry[i].mapFrom.length; j++) 
				{
					_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-from"><div class="select2-result-label"><span class="select2-match"></span>' + drpFerry[i].mapFrom[j].mFrom + '</div></li>';
				}

				_code += '</ul></li>';
			}
		}

		else 
		{
			for (var i = 0; i < drpFerry.length; i++) 
			{
				var temp = i;

				for (var j = 0; j < drpFerry[i].mapFrom.length; j++) 
				{
					if (drpFerry[i].mapFrom[j].mFrom.search(new RegExp(fromVal, "i")) > -1) 
					{
						if (i == temp) 
						{
							_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpFerry[i].stateFrom + '</b></div><ul class="select2-result-sub">';
							temp++;
						}

						_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-from"><div class="select2-result-label"><span class="select2-match"></span>' + drpFerry[i].mapFrom[j].mFrom + '</div></li>';
					}

					_code += '</ul></li>';
				}
			}
		}

		_code += '</ul></div><div class="clearfix"></div>';
		jQuery(".div-from-location:visible .divSearchResultFrom ul").empty();
		jQuery(".div-from-location:visible .divSearchResultFrom ul").html(_code);
		jQuery(".div-from-location:visible .divSearchResultFrom").show();

		jQuery(".li-select-from").on("click", function () {
			addtoText("from", this);
		});
	}

	function fetchTo(from, toVal) 
	{
		var _code = '';

		if (toVal == "") 
		{
			for (var i = 0; i < drpBus.length; i++) 
			{
				for (var j = 0; j < drpBus[i].mapFrom.length; j++) 
				{
					if (drpBus[i].mapFrom[j].mFrom == from) 
					{
						for (var k = 0; k < drpBus[i].mapFrom[j].stateTo.length; k++) 
						{
							_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpBus[i].mapFrom[j].stateTo[k].sTo + '</b></div><ul class="select2-result-sub">';

							for (var l = 0; l < drpBus[i].mapFrom[j].stateTo[k].mapTo.length; l++) 
							{
								if (jQuery("#lblAffiliateID").text() == "tiomanferry.com.sg" && drpBus[i].mapFrom[j].stateTo[k].mapTo[l].mTo != "Tioman Island")
									_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpBus[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';

								else if (jQuery("#lblAffiliateID").text() != "tiomanferry.com.sg")
									_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpBus[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';
							}

							_code += '</ul></li>';
						}
					}
				}
			}
		}

		else 
		{
			for (var i = 0; i < drpBus.length; i++) 
			{
				for (var j = 0; j < drpBus[i].mapFrom.length; j++) 
				{
					if (drpBus[i].mapFrom[j].mFrom == from) 
					{
						for (var k = 0; k < drpBus[i].mapFrom[j].stateTo.length; k++) 
						{
							var temp = k;
							for (var l = 0; l < drpBus[i].mapFrom[j].stateTo[k].mapTo.length; l++) 
							{
								if (drpBus[i].mapFrom[j].stateTo[k].mapTo[l].mTo.search(new RegExp(toVal, "i")) > -1) 
								{
									if (k == temp) 
									{
										_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpBus[i].mapFrom[j].stateTo[k].sTo + '</b></div><ul class="select2-result-sub">';
										temp++;
									}

									if (jQuery("#lblAffiliateID").text() == "tiomanferry.com.sg" && drpBus[i].mapFrom[j].stateTo[k].mapTo[l].mTo != "Tioman Island")
										_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpBus[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';

									else if (jQuery("#lblAffiliateID").text() != "tiomanferry.com.sg")
										_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpBus[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';
								}

								_code += '</ul></li>';
							}
						}
					}
				}
			}
		}

		_code += '</ul></div><div class="clearfix"></div>';
		jQuery(".div-to-location:visible .divSearchResultTo ul").empty();
		jQuery(".div-to-location:visible .divSearchResultTo ul").html(_code);
		jQuery(".div-to-location:visible .divSearchResultTo").show();

		jQuery(".li-select-to").on("click", function () {
			addtoText("to", this);
		});
	}

	function fetchKtmTo(from, toVal) 
	{
		var _code = '';

		if (toVal == "") 
		{
			for (var i = 0; i < drpTrain.length; i++) 
			{
				for (var j = 0; j < drpTrain[i].mapFrom.length; j++) 
				{
					if (drpTrain[i].mapFrom[j].mFrom == from) 
					{
						for (var k = 0; k < drpTrain[i].mapFrom[j].stateTo.length; k++) 
						{
							_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpTrain[i].mapFrom[j].stateTo[k].sTo + '</b></div><ul class="select2-result-sub">';

							for (var l = 0; l < drpTrain[i].mapFrom[j].stateTo[k].mapTo.length; l++) 
							{
								_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpTrain[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';
							}

							_code += '</ul></li>';
						}
					}
				}
			}
		}

		else 
		{
			for (var i = 0; i < drpTrain.length; i++) 
			{
				for (var j = 0; j < drpTrain[i].mapFrom.length; j++) 
				{
					if (drpTrain[i].mapFrom[j].mFrom == from) 
					{
						for (var k = 0; k < drpTrain[i].mapFrom[j].stateTo.length; k++) 
						{
							var temp = k;

							for (var l = 0; l < drpTrain[i].mapFrom[j].stateTo[k].mapTo.length; l++) 
							{
								if (drpTrain[i].mapFrom[j].stateTo[k].mapTo[l].mTo.search(new RegExp(toVal, "i")) > -1) 
								{
									if (k == temp) 
									{
										_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpTrain[i].mapFrom[j].stateTo[k].sTo + '</b></div><ul class="select2-result-sub">';
										temp++;
									}

									_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpTrain[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';
								}

								_code += '</ul></li>';
							}
						}
					}
				}
			}
		}

		_code += '</ul></div><div class="clearfix"></div>';
		jQuery(".div-to-location:visible .divSearchResultTo ul").empty();
		jQuery(".div-to-location:visible .divSearchResultTo ul").html(_code);
		jQuery(".div-to-location:visible .divSearchResultTo").show();

		jQuery(".li-select-to").on("click", function () {
			addtoText("to", this);
		});
	}

	function fetchFerryTo(from, toVal) 
	{
		var _code = '';

		if (toVal == "") 
		{
			for (var i = 0; i < drpFerry.length; i++) 
			{
				for (var j = 0; j < drpFerry[i].mapFrom.length; j++) 
				{
					if (drpFerry[i].mapFrom[j].mFrom == from) 
					{
						for (var k = 0; k < drpFerry[i].mapFrom[j].stateTo.length; k++) 
						{
							_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpFerry[i].mapFrom[j].stateTo[k].sTo + '</b></div><ul class="select2-result-sub">';

							for (var l = 0; l < drpFerry[i].mapFrom[j].stateTo[k].mapTo.length; l++) 
							{
								_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpFerry[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';
							}

							_code += '</ul></li>';
						}
					}
				}
			}
		}

		else 
		{
			for (var i = 0; i < drpFerry.length; i++) 
			{
				for (var j = 0; j < drpFerry[i].mapFrom.length; j++) 
				{
					if (drpFerry[i].mapFrom[j].mFrom == from) 
					{
						for (var k = 0; k < drpFerry[i].mapFrom[j].stateTo.length; k++) 
						{
							var temp = k;
							for (var l = 0; l < drpFerry[i].mapFrom[j].stateTo[k].mapTo.length; l++) 
							{
								if (drpFerry[i].mapFrom[j].stateTo[k].mapTo[l].mTo.search(new RegExp(toVal, "i")) > -1) 
								{
									if (k == temp) 
									{
										_code += '<li class="select2-results-dept-0 select2-result select2-result-unselectable select2-result-with-children"><div class="select2-result-label"><span class="select2-match"></span><b>' + drpFerry[i].mapFrom[j].stateTo[k].sTo + '</b></div><ul class="select2-result-sub">';
										temp++;
									}

									_code += '<li class="select2-results-dept-1 select2-result select2-result-selectable li-select-to"><div class="select2-result-label"><span class="select2-match"></span>' + drpFerry[i].mapFrom[j].stateTo[k].mapTo[l].mTo + '</div></li>';
								}

								_code += '</ul></li>';

							}
						}
					}
				}
			}
		}

		_code += '</ul></div><div class="clearfix"></div>';
		jQuery(".div-to-location:visible .divSearchResultTo ul").empty();
		jQuery(".div-to-location:visible .divSearchResultTo ul").html(_code);
		jQuery(".div-to-location:visible .divSearchResultTo").show();

		jQuery(".li-select-to").on("click", function () {
			addtoText("to", this);
		});
	}

	function addtoText(type, elem) 
	{
		if (type == "from") 
		{
			jQuery(".txtFromLoc:visible").val(jQuery(elem).text());
			jQuery(".divSearchResultFrom ul").empty();
			jQuery(".divSearchResultFrom").hide();
		}

		else if (type == "to") 
		{
			jQuery(".txtToLoc:visible").val(jQuery(elem).text());
			jQuery(".divSearchResultTo ul").empty();
			jQuery(".divSearchResultTo").hide();
		}
	}        

	function textFromBoxFetch() 
	{
		if (_ticketType == "bus")
			fetchFrom(jQuery(".txtFromLoc:visible").val());

		else if (_ticketType == "train")
			fetchKtmFrom(jQuery(".txtFromLoc:visible").val());

		else if (_ticketType == "ferry")
			fetchFerryFrom(jQuery(".txtFromLoc:visible").val());

		jQuery(".txtToLoc:visible").val("");
	}

	function textToboxFetch() 
	{
		if (_ticketType == "bus")
			fetchTo(jQuery(".txtFromLoc:visible").val(), jQuery(".txtToLoc:visible").val());

		else if (_ticketType == "train")
			fetchKtmTo(jQuery(".txtFromLoc:visible").val(), jQuery(".txtToLoc:visible").val());

		else if (_ticketType == "ferry")
			fetchFerryTo(jQuery(".txtFromLoc:visible").val(), jQuery(".txtToLoc:visible").val());
	}
});