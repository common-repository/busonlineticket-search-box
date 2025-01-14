var imageUrl = plugin_data.image_url;

function search_box_265_424() 
{
	var innerStructure = '';

	innerStructure += '<div id="divReservation_265_424" style="display: block;">';
	innerStructure += '    <div id="divReservationMain_265_424" class="divReservationMain">';
	innerStructure += '        <div id="divReservation_title_265_424" class="divReservation_title">BOOK TICKET</div>';
	innerStructure += '        <div id="divReservation_inner_265_424" class="divReservation_inner">';
	innerStructure += '            <div class="divReservationTypes">';
	innerStructure += '                <div class="divReservationTypes_head active bus">Bus</div>';
	innerStructure += '                <div class="divReservationTypes_head train">Train</div>';
	innerStructure += '                <div class="divReservationTypes_head ferry">Ferry</div>';
	innerStructure += '            </div>';
	innerStructure += '            <table id="tbl_reservation_265_424">';
	innerStructure += '                <tr>';
	innerStructure += '                    <td colspan="2">';
	innerStructure += '                        <input id="rdOneWay_265_424" class="rdOneWay" type="radio" name="rdWay" value="rb1" checked="checked" onclick="changeWays(1);" />';
	innerStructure += '                        <label for="rdOneWay_265_424">One Way</label>';
	innerStructure += '                        <input id="rdTwoWay_265_424" class="rdTwoWay" type="radio" name="rdWay" value="rb2" onclick="changeWays(2);" />';
	innerStructure += '                        <label for="rdTwoWay_265_424">Return</label>';
	innerStructure += '                    </td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>From</td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>';
	innerStructure += '                        <div class="div-from-location" style="position: relative">';
	innerStructure += '                            <input type="text" placeholder="Select a departure point" class="locations-text txtFromLoc" />';
	innerStructure += '                            <div style="left: 0; width: 217px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultFrom">';
	innerStructure += '                                <ul class="select2-results"></ul>';
	innerStructure += '                            </div>';
	innerStructure += '                        </div>';
	innerStructure += '                    </td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>To</td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>';
	innerStructure += '                        <div class="div-to-location" style="position: relative">';
	innerStructure += '                            <input type="text" placeholder="Select a Destination" class="locations-text txtToLoc" />';
	innerStructure += '                            <div style="left: 0; width: 217px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultTo">';
	innerStructure += '                                <ul class="select2-results"></ul>';
	innerStructure += '                            </div>';
	innerStructure += '                        </div>';
	innerStructure += '                    </td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>Departure</td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>';
	innerStructure += '                        <input type="text" value="" class="TraveDates txtDepDate" />';
	innerStructure += '                    </td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td class="trReturnWay" style="display: none">Return</td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td class="trReturnWay" style="display: none">';
	innerStructure += '                        <input type="text" value="" class="TraveDates txtReturnDate" />';
	innerStructure += '                    </td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>Passengers</td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>';
	innerStructure += '                        <select class="ddPax">';
	innerStructure += '                            <option value="1">1</option>';
	innerStructure += '                            <option value="2">2</option>';
	innerStructure += '                            <option value="3">3</option>';
	innerStructure += '                            <option value="4">4</option>';
	innerStructure += '                            <option value="5">5</option>';
	innerStructure += '                            <option value="6">6</option>';
	innerStructure += '                            <option value="7">7</option>';
	innerStructure += '                            <option value="8">8</option>';
	innerStructure += '                            <option value="9">9</option>';
	innerStructure += '                            <option value="10">10</option>';
	innerStructure += '                            <option value="11">11</option>';
	innerStructure += '                            <option value="12">12</option>';
	innerStructure += '                            <option value="13">13</option>';
	innerStructure += '                            <option value="14">14</option>';
	innerStructure += '                            <option value="15">15</option>';
	innerStructure += '                        </select>';
	innerStructure += '                    </td>';
	innerStructure += '                </tr>';
	innerStructure += '                <tr>';
	innerStructure += '                    <td>';
	innerStructure += '                        <input type="button" id="btnSearchNow_265_424" class="btnSearchNow" value="Book Now!" />';
	innerStructure += '                        <br><br>';
	innerStructure += '                        <span id="powerby" style="font-size: 8pt"><em>Powered by</em>';
	innerStructure += '                            <img alt="BusOnlineTicket.com" src="' + imageUrl + '" width="125" />';
	innerStructure += '                        </span>';
	innerStructure += '                    </td>';
	innerStructure += '                </tr>';
	innerStructure += '            </table>';
	innerStructure += '        </div>';
	innerStructure += '    </div>';
	innerStructure += '</div>';

	jQuery("#divSearch_Box").html(innerStructure);
	jQuery("#divSearch_BoxPreview").html(innerStructure);
	jQuery("#divSearch_BoxPreview2").html(innerStructure);
}		
		
function search_box_315_291() 
{
    var innerStructure = '';

    var innerStructure = '<div id="divReservation_315_291" style="display: block">\n';
    innerStructure += '    <div id="divReservationMain_315_291" class="divReservationMain">\n';
    innerStructure += '        <div id="divReservation_title_315_291" class="divReservation_title">BOOK TICKET</div>\n';
    innerStructure += '        <div id="divReservation_inner_315_291" class="divReservation_inner">\n';
    innerStructure += '            <div class="divReservationTypes">\n';
    innerStructure += '                <div class="divReservationTypes_head active bus">Bus Tickets</div>\n';
    innerStructure += '                <div class="divReservationTypes_head train">Train Tickets</div>\n';
    innerStructure += '                <div class="divReservationTypes_head ferry">Ferry Tickets</div>\n';
    innerStructure += '            </div>\n';
    innerStructure += '            <table id="tbl_reservation_315_291">\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td colspan="2">\n';
    innerStructure += '                        <input id="rdOneWay_315_291" class="rdOneWay" type="radio" name="rdWay" value="rb1" checked="checked" onclick="changeWays(1);" />\n';
    innerStructure += '                        <label for="rdOneWay_315_291">One Way</label>\n';
    innerStructure += '                        <input id="rdTwoWay_315_291" class="rdTwoWay" type="radio" name="rdWay" value="rb2" onclick="changeWays(2);" />\n';
    innerStructure += '                        <label for="rdTwoWay_315_291">Return</label>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>From</td>\n';
    innerStructure += '                    <td>To</td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <div class="div-from-location" style="position: relative">\n';
    innerStructure += '                            <input type="text" placeholder="Select departure" class="locations-text txtFromLoc" />\n';
    innerStructure += '                            <div style="left: 0; width: 145px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultFrom">\n';
    innerStructure += '                                <ul class="select2-results"></ul>\n';
    innerStructure += '                            </div>\n';
    innerStructure += '                        </div>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <div class="div-to-location" style="position: relative">\n';
    innerStructure += '                            <input type="text" placeholder="Select Destination" class="locations-text txtToLoc" />\n';
    innerStructure += '                            <div style="left: 0; width: 145px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultTo">\n';
    innerStructure += '                                <ul class="select2-results"></ul>\n';
    innerStructure += '                            </div>\n';
    innerStructure += '                        </div>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>Departure</td>\n';
    innerStructure += '                    <td class="trReturnWay" style="display: none">Return</td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <input type="text" value="" class="TraveDates txtDepDate" /></td>\n';
    innerStructure += '                    <td class="trReturnWay" style="display: none">\n';
    innerStructure += '                        <input type="text" value="" class="TraveDates txtReturnDate" /></td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>Passengers</td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <select class="ddPax">\n';
    innerStructure += '                            <option value="1">1</option>\n';
    innerStructure += '                            <option value="2">2</option>\n';
    innerStructure += '                            <option value="3">3</option>\n';
    innerStructure += '                            <option value="4">4</option>\n';
    innerStructure += '                            <option value="5">5</option>\n';
    innerStructure += '                            <option value="6">6</option>\n';
    innerStructure += '                            <option value="7">7</option>\n';
    innerStructure += '                            <option value="8">8</option>\n';
    innerStructure += '                            <option value="9">9</option>\n';
    innerStructure += '                            <option value="10">10</option>\n';
    innerStructure += '                            <option value="11">11</option>\n';
    innerStructure += '                            <option value="12">12</option>\n';
    innerStructure += '                            <option value="13">13</option>\n';
    innerStructure += '                            <option value="14">14</option>\n';
    innerStructure += '                            <option value="15">15</option>\n';
    innerStructure += '                        </select>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <input type="button" id="btnSearchNow_315_291" class="btnSearchNow" value="Book Now!" /></td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n\n';
	innerStructure += '                    <td>\n';
    innerStructure += '                        <br><span id="powerby" style="font-size: 8pt"><em>Powered by</em>\n';
    innerStructure += '                            <img alt="BusOnlineTicket.com" src="' + imageUrl + '" width="125" />';
    innerStructure += '                        </span>';	
	innerStructure += '                    </td>';
    innerStructure += '                </tr>\n';
    innerStructure += '            </table>\n';
    innerStructure += '        </div>\n';
    innerStructure += '    </div>\n';
    innerStructure += '</div>';

    jQuery("#divSearch_Box").html(innerStructure);
	jQuery("#divSearch_BoxPreview").html(innerStructure);	
	jQuery("#divSearch_BoxPreview2").html(innerStructure);
}

function search_box_570_294() 
{
    var innerStructure = '';

    var innerStructure = '<div id="divReservation_570_294" style="display: block">\n';
    innerStructure += '    <div id="divReservationMain_570_294" class="divReservationMain">\n';
    innerStructure += '        <div id="divReservation_title_570_294" class="divReservation_title">BOOK TICKET</div>\n';
    innerStructure += '        <div id="divReservation_inner_570_294" class="divReservation_inner">\n';
    innerStructure += '            <div class="divReservationTypes">\n';
    innerStructure += '                <div class="divReservationTypes_head active bus">Bus Tickets</div>\n';
    innerStructure += '                <div class="divReservationTypes_head train">Train Tickets</div>\n';
    innerStructure += '                <div class="divReservationTypes_head ferry">Ferry Tickets</div>\n';
    innerStructure += '            </div>\n';
    innerStructure += '            <table id="tbl_reservation_570_294">\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td colspan="2">\n';
    innerStructure += '                        <input id="rdOneWay_570_294" class="rdOneWay" type="radio" name="rdWay" value="rb1" checked="checked" onclick="changeWays(1);" />\n';
    innerStructure += '                        <label for="rdOneWay_570_294">One Way</label>\n';
    innerStructure += '                        <input id="rdTwoWay_570_294" class="rdTwoWay" type="radio" name="rdWay" value="rb2" onclick="changeWays(2);" />\n';
    innerStructure += '                        <label for="rdTwoWay_570_294">Return</label>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>From</td>\n';
    innerStructure += '                    <td>To</td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <div class="div-from-location" style="position: relative">\n';
    innerStructure += '                            <input type="text" placeholder="Select a departure point" class="locations-text txtFromLoc" />\n';
    innerStructure += '                            <div style="left: 0; width: 218px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultFrom">\n';
    innerStructure += '                                <ul class="select2-results"></ul>\n';
    innerStructure += '                            </div>\n';
    innerStructure += '                        </div>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <div class="div-to-location" style="position: relative">\n';
    innerStructure += '                            <input type="text" placeholder="Select a Destination" class="locations-text txtToLoc" />\n';
    innerStructure += '                            <div style="left: 0; width: 218px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultTo">\n';
    innerStructure += '                                <ul class="select2-results"></ul>\n';
    innerStructure += '                            </div>\n';
    innerStructure += '                        </div>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>Departure</td>\n';
    innerStructure += '                    <td class="trReturnWay" style="display: none">Return</td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <input type="text" value="" class="TraveDates txtDepDate" /></td>\n';
    innerStructure += '                    <td class="trReturnWay" style="display: none">\n';
    innerStructure += '                        <input type="text" value="" class="TraveDates txtReturnDate" /></td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>Passengers</td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <select class="ddPax">\n';
    innerStructure += '                            <option value="1">1</option>\n';
    innerStructure += '                            <option value="2">2</option>\n';
    innerStructure += '                            <option value="3">3</option>\n';
    innerStructure += '                            <option value="4">4</option>\n';
    innerStructure += '                            <option value="5">5</option>\n';
    innerStructure += '                            <option value="6">6</option>\n';
    innerStructure += '                            <option value="7">7</option>\n';
    innerStructure += '                            <option value="8">8</option>\n';
    innerStructure += '                            <option value="9">9</option>\n';
    innerStructure += '                            <option value="10">10</option>\n';
    innerStructure += '                            <option value="11">11</option>\n';
    innerStructure += '                            <option value="12">12</option>\n';
    innerStructure += '                            <option value="13">13</option>\n';
    innerStructure += '                            <option value="14">14</option>\n';
    innerStructure += '                            <option value="15">15</option>\n';
    innerStructure += '                        </select>\n';
    innerStructure += '                    </td>\n';
    innerStructure += '                    <td>\n';
    innerStructure += '                        <input type="button" id="btnSearchNow_570_294" class="btnSearchNow" value="Book Now!" /></td>\n';
    innerStructure += '                </tr>\n';
    innerStructure += '                <tr>\n\n';
	innerStructure += '                    <td>\n';
    innerStructure += '                        <br><span id="powerby" style="font-size: 8pt"><em>Powered by</em>\n';
    innerStructure += '                            <img alt="BusOnlineTicket.com" src="' + imageUrl + '" width="125" />';
    innerStructure += '                        </span>';	
	innerStructure += '                    </td>';
    innerStructure += '                </tr>\n';
    innerStructure += '            </table>\n';
    innerStructure += '        </div>\n';
    innerStructure += '    </div>\n';
    innerStructure += '</div>';

    jQuery("#divSearch_Box").html(innerStructure);
	jQuery("#divSearch_BoxPreview").html(innerStructure);
	jQuery("#divSearch_BoxPreview2").html(innerStructure);
}

function changeWays(way) 
{
    _way = way;

    if (way == 1) 
    {
        jQuery(".trReturnWay").css("display", "none");
    }

    else 
    {
        jQuery(".trReturnWay").css("display", "");
    }
}