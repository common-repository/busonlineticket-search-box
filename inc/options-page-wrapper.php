<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<style>
    #edit-form {
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() 
	{	
		const partnerForm = document.getElementById('partner-form');
		
        const dataForm = document.getElementById('data-form');
		const dataTable = document.getElementById('data-table');
		const codeEditorTextarea = document.getElementById('shortcode_setting');	
		const previewBox = document.getElementById('previewBox');		
		const previewBox2 = document.getElementById('previewBox2');
		const hiddenDiv = document.getElementById('hiddenDiv');
        const editButton = document.getElementById('edit_css_submit');
		const partnerId = document.getElementById('partner_id_submit');
		
		//css setting button
		const cancelButton = document.getElementById('cancel_button_css');		
		const saveButton = document.getElementById('save_button_css');
		
		//edit-form button		
		const editForm = document.getElementById('edit-form');
		const hiddenDiv2 = document.getElementById('hiddenDiv2');
		const editButton2 = document.getElementById('edit_css_submit2');		
		const cancelButton2 = document.getElementById('cancel_button_css2');		
		const saveButton2 = document.getElementById('save_button_css2');
		const cancelEdit = document.getElementById('cancelEdit');	
		const saveEdit = document.getElementById('saveEdit');
		
        if (cancelButton) 
		{
            cancelButton.addEventListener('click', function() {
                document.getElementById('hiddenDiv').style.display = 'none';
            });
        }
		
		if (cancelButton2) 
		{
            cancelButton2.addEventListener('click', function() {
                document.getElementById('hiddenDiv2').style.display = 'none';
            });
        }
		
		if (cancelEdit) 
		{
            cancelEdit.addEventListener('click', function() {
				localStorage.removeItem('hasCustomCSS');
				
				// Reset the content of the textarea to the original content from search.css
				var xhr = new XMLHttpRequest();
				xhr.open('GET', '<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/search.css'); ?>', true);

				xhr.onload = function () {
					if (xhr.status >= 200 && xhr.status < 400) 
					{
						// Success response, update the content of the textarea
						document.getElementById('code-editor').value = xhr.responseText;
					} 
					
					else 
					{
						// Error response, handle it accordingly
						console.error('Error:', xhr.statusText);
						alert("Error loading original CSS content.");
					}
				};

				xhr.onerror = function () {
					console.error('Network Error');
					alert("Network error loading original CSS content.");
				};

				xhr.send();
				
                // Hide the edit-form
				document.getElementById('edit-form').style.display = 'none';

				// Show the data-form
				document.getElementById('data-form').style.display = 'block';
				
				codeEditorTextarea.style.display = 'none';

				// Scroll to the data-form
				document.getElementById('data-form').scrollIntoView();
				
				// Set empty value for input fields 
				jQuery('[name="title_searchbox"]').val('');
				jQuery('.txtFromLoc').val('');
				jQuery('.txtToLoc').val('');		 
				 
				// Toggle the visibility of divSearch_BoxPreview
				document.getElementById('divSearch_BoxPreview').style.display = 'none';				
				document.getElementById('previewMsg').style.display = 'none';
				
				hiddenDiv.style.display = 'none';
			});
        }
		
		if (saveEdit)
		{
			saveEdit.addEventListener('click', function() {		
				localStorage.removeItem('hasCustomCSS');
            });
		}
		
		if (editButton && hiddenDiv) 
		{
            editButton.addEventListener('click', function() {
                hiddenDiv.style.display = 'block';
				 
				// Toggle the visibility of divSearch_BoxPreview
				// document.getElementById('divSearch_BoxPreview').style.display = 'none';			
				// document.getElementById('previewMsg').style.display = 'none';
            });
        }
		
		// hiddenDiv2.style.display = 'none';

		if (editButton2 && hiddenDiv2) 
		{
			editButton2.addEventListener('click', function() {
				hiddenDiv2.style.display = hiddenDiv2.style.display === 'none' ? 'block' : 'none';
			});
		}
		
		if (previewBox) 
		{
            previewBox.addEventListener('click', function() {
				var previewRadio1 = document.getElementById('size1');
				var previewRadio2 = document.getElementById('size2');
				var previewRadio3 = document.getElementById('size3');		
				
				if (previewRadio1.checked) 
				{
					search_box_265_424();
				} 
				
				else if (previewRadio2.checked) 
				{
					search_box_315_291();
				} 
				
				else if (previewRadio3.checked) 
				{
					search_box_570_294(); 					
				}
				
				document.getElementById('divSearch_BoxPreview').style.display = 'flex';				
				document.getElementById('previewMsg').style.display = 'block';
			});
        }
		
		if (previewBox2) 
		{
            previewBox2.addEventListener('click', function() {
				var previewBoxRadio1 = document.getElementById('editedSize1');
				var previewBoxRadio2 = document.getElementById('editedSize2');
				var previewBoxRadio3 = document.getElementById('sizeditedSize3');			

				if (previewBoxRadio1.checked) 
				{
					search_box_265_424();
				} 
				
				else if (previewBoxRadio2.checked) 
				{
					search_box_315_291();
				} 
				
				else if (previewBoxRadio3.checked) 
				{
					search_box_570_294(); 					
				}
				
				document.getElementById('divSearch_BoxPreview2').style.display = 'flex';				
				document.getElementById('previewMsg2').style.display = 'block';
			});
        }
		
		function generateShortcode() 
		{
			var titleValue = document.getElementsByName('title_searchbox')[0].value;
			var sizeValue = document.querySelector('input[name="example"]:checked').value;
			var typeValue = document.getElementById('type_searchbox').value;
			var fromValue = document.getElementsByName('from_searchbox')[0].value;
			var toValue = document.getElementsByName('to_searchbox')[0].value;
			
			if (!fromValue)
			{
				fromValue = "";
			}
			
			if (!toValue)
			{
				toValue = "";
			}

			// Update the value of shortcode-editor textarea
			var shortcodeValue = '[botwp_search_box title="' + titleValue + '" size="' + sizeValue + '" type="' + typeValue + '" from="' + fromValue + '" to="' + toValue + '"]';
			document.getElementById('shortcode-editor').value = shortcodeValue;

			// Show the shortcode_setting div
			document.getElementById('shortcode_setting').style.display = 'block';
		}
		
		function generateEditShortcode() 
		{
			var titleValue2 = document.getElementsByName('editedTitle')[0].value;
			var sizeValue2 = document.querySelector('input[name="editedSize"]:checked').value;
			var typeValue2 = document.getElementById('editedType').value;
			var fromValue2 = document.getElementsByName('from_searchbox2')[0].value;
			var toValue2 = document.getElementsByName('to_searchbox2')[0].value;
			
			if (!fromValue2)
			{
				fromValue2 = "";
			}
			
			if (!toValue2)
			{
				toValue2 = "";
			}

			// Update the value of shortcode-editor textarea
			var shortcodeValue2 = '[botwp_search_box title="' + titleValue2 + '" size="' + sizeValue2 + '" type="' + typeValue2 + '" from="' + fromValue2 + '" to="' + toValue2 + '"]';
			document.getElementById('shortcode-editor').value = shortcodeValue2;

			// Show the shortcode_setting div
			document.getElementById('shortcode_setting').style.display = 'block';
		}
		
		partnerForm.addEventListener('submit', function(event) {
			event.preventDefault(); // Prevent the default form submission

			const partnerData = new FormData(partnerForm);

			partnerData.append('action', 'process_partner_data');
			partnerData.append('_wpnonce', my_ajax_object.ajax_nonce);

			jQuery.ajax({
				type: 'POST',
				url: ajaxurl, 
				data: partnerData,
				contentType: false,
				processData: false,
				success: function(response) {
					if (response.status === 'success') {
						alert(response.message);
					} else {
						alert(response.message);
					}
				}
			});				
		});

		dataForm.addEventListener('submit', function(event) {
			event.preventDefault(); 
			
			var BOTSize_Filter;
			var BOTDefault_Type;
			var BOTDefault_From;
			var BOTDefault_To;
			var BOTReferer_Id;
			
			const submitButton = event.submitter;			
				
			// Function to update sequence numbers in the "No." column
			function updateSequenceNumbers() 
			{
				const rows = document.querySelectorAll("#data-table tbody tr");
				
				rows.forEach((row, index) => {
					const noCell = row.querySelector(".sequence-number");
					
					if (noCell) 
					{
						noCell.textContent = index + 1;
						noCell.id = `row-${index + 1}`;
					}
				});
			}
						
			if (submitButton.name === 'shortcode_submit') 
			{					
				// var fromValue = document.querySelector(".txtFromLoc").value;
				var fromValue = document.getElementsByName('from_searchbox')[0].value;
				
				// var toValue = document.querySelector(".txtToLoc").value;
				var toValue = document.getElementsByName('to_searchbox')[0].value;
				
				if (!fromValue)
				{
					fromValue = "";
				}
				
				if (!toValue)
				{
					toValue = "";
				}

				const titleValue = document.querySelector('[name="title_searchbox"]').value;
				
				let sizeValue;
				
				var radio1 = document.getElementById('size1');
				var radio2 = document.getElementById('size2');
				var radio3 = document.getElementById('size3');			

				if (radio1.checked) 
				{
					sizeValue = radio1.value;
					search_box_265_424();
				} 
				
				else if (radio2.checked) 
				{
					sizeValue = radio2.value;
					search_box_315_291();
				} 
				
				else if (radio3.checked) 
				{
					sizeValue = radio3.value;
					search_box_570_294(); 					
				}			
				
				// var fromInput = document.querySelector('[name="from_searchbox"]');
				// var toInput = document.querySelector('[name="to_searchbox"]');
				
				// var fromValue = fromInput.value;
				// var toValue = toInput.value;
				
				const type_searchbox = document.getElementById('type_searchbox');
				const typeValue = type_searchbox.value;

				if (titleValue && sizeValue && typeValue)
				{		
					generateShortcode();
					codeEditorTextarea.style.display = 'block';					
				
					const formData = new FormData(dataForm);

					formData.append('action', 'process_form_data');
					formData.append('_wpnonce', my_ajax_object.ajax_nonce); 

					jQuery.ajax({
						type: 'POST',
						url: ajaxurl, 
						data: formData,
						contentType: false,
						processData: false,
						success: function(response) {     
							updateDataListTable();
						}
					});	
					
					// Function to update the data list table
					function updateDataListTable() 
					{
						jQuery.ajax({
							type: 'GET',
							url: ajaxurl, 
							data: {
								action: 'get_data_list_table', 
							},
							success: function (html) {
								// Update the content of the container with the new data list table
								jQuery('#bot-search-box-container').html(html);
							}
						});
					}
				}
				
				else
				{
					alert("Please fill in all the fields.");
				}
			}
		});
		
		const generateShortcodeButton = document.getElementById('shortcode_submit2');

		generateShortcodeButton.addEventListener('click', function (event) {
			var titleValue2 = document.getElementsByName('editedTitle')[0].value;
			var sizeValue2 = document.querySelector('input[name="editedSize"]:checked').value;
			var typeValue2 = document.getElementById('editedType').value;
			var fromValue2 = document.getElementsByName('from_searchbox2')[0].value;
			var toValue2 = document.getElementsByName('to_searchbox2')[0].value;
			
			if (!fromValue2)
			{
				fromValue2 = "";
			}
			
			if (!toValue2)
			{
				toValue2 = "";
			}

			if (titleValue2 && sizeValue2 && typeValue2) 
			{
				generateEditShortcode();
				codeEditorTextarea.style.display = 'block';
			} 
			
			else 
			{
				alert("Please fill in all the fields.");
			}
		});
		
		var textarea = document.getElementById('shortcode-editor');

        textarea.addEventListener('click', function() {
            textarea.select();

            try {
                document.execCommand('copy');
                alert('Shortcode copied to clipboard!');
            } catch (err) {
                console.error('Unable to copy to clipboard', err);
            }
        });
    });	
	
	
</script>

<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	
    <!-- banner -->
    <div class="header-top">
	    <div class="header-container">
	        <div class="header-row">
	            <div class="header-logo-wrap">
                    <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . 'img/BOT-Logo_White.png'); ?>" alt="Banner Image">
                </div>
	        </div>
	    </div>
	</div>

	<div id="poststuff" style="padding-top:20px!important;">

		<div id="post-body" class="metabox-holder columns-2" style="display: flex;">

			<!-- left sidebar -->
			<div id="sub-container" class="postbody-container" style="padding-right: 10px;">
			
				<!-- partner id sidebar -->
				<div class="meta-box-sortables ui-sortable" style="display:flex;">
					<div class="postbox" style="background: #172f55; color: #172f55; padding-bottom:10px!important; padding-left: 0px!important; padding-right:0px!important; width: 100%;">					
                        <form method="post" action="" id="partner-form">
                            <input type="hidden" name="partner_id_submitted" value="Y">
                            <center>                                
								<h2 style="color: #FFFFFF; padding: 8px 20px!important;"><span>Partner ID</span></h2>
								
								<?php										
									global $wpdb;

									// Table name with prefix
									$table_name = $wpdb->prefix . "bot_generic_settings";
							
									$query = $wpdb->prepare("SELECT partner_id FROM $table_name ORDER BY update_date DESC LIMIT 1");
									$partnerId = $wpdb->get_var($query);
								?>

                                </br><input type="text" name="partner_id" id="partner_id" style="text-align: center;" placeholder="Partner ID" value="<?php echo esc_attr($partnerId); ?>" />

                                <div class="inside" style="margin-top: 15px;">
                                    <input class="button-primary" style="width: 30%;" type="submit" name="partner_id_submit" id="partner_id_submit" value="Save" /> 
                                </div>
                            </center>
                        </form>
					</div>				
				</div>
				<!-- end partner id sidebar -->
				
				<!-- setting sidebar -->
				<div class="meta-box-sortables ui-sortable" style="display:flex;">
					<div class="postbox" style="background: #172f55; color: #172f55; padding-bottom:10px!important; padding-left: 0px!important; padding-right:0px!important; width: 100%;">
						<h2 style="color: #FFFFFF; padding: 8px 20px!important;"><span>Setting</span></h2>
						<div class="inside">
							<input class="button-secondary" style="width: 100%; min-height: 35px!important; font-size: 14px!important;" type="submit" value="Search Box" />
						</div>
					</div>		
				</div>
				<!-- setting sidebar -->
				
			</div>
			<!-- end left sidebar -->		

			<!-- right sidebar -->
			<div id="sub-container" class="postbox-container" style="flex: 1; margin-left: 5px; padding-left: 10px;">
				<div class="meta-box-sortables">
					<div class="postbox" style="padding: 20px;width: 1400px;max-width: 98%;">		
						<h2 style="margin-bottom: 13px;"><span>Search Box</span></h2>
						<div id="bot-search-box-container">
						
						<?php							
							global $wpdb;

							// Handle Edit or Delete actions
							if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') 
							{								
								if (current_user_can('manage_bot_searchbox_settings') && check_admin_referer('nonce_edit_form', '_wpnonce_edit_form')) 
								{
									$id = isset($_POST['id']) ? esc_html(sanitize_text_field($_POST['id'])) : '';
									$editedTitle = esc_html(sanitize_text_field($_POST['editedTitle']));
									$editedSize = esc_html(sanitize_text_field($_POST['editedSize']));
									$editedType = esc_html(sanitize_text_field($_POST['editedType']));
									$from_searchbox2 = esc_html(sanitize_text_field($_POST['from_searchbox2']));
									$to_searchbox2 = esc_html(sanitize_text_field($_POST['to_searchbox2']));

									$update_data = array(
										'title' => $editedTitle,
										'size' => $editedSize,
										'default_type' => $editedType,
										'default_from' => $from_searchbox2,
										'default_to' => $to_searchbox2,
									);

									$where_condition = array('id' => $id);

									$result = $wpdb->update($wpdb->prefix . 'bot_searchbox_settings', $update_data, $where_condition, array('%s', '%s', '%s', '%s', '%s'));

									if ($result !== false) 
									{
										echo '<script>alert(' . wp_json_encode("Record updated successfully.") . ')</script>';
									} 
									
									else 
									{
										echo '<script>alert(' . wp_json_encode("Failed to update record.") . ')</script>';
										// echo "Error updating record: " . $wpdb->last_error;
									}
								}
								
								else
								{
									echo '<script>alert(' . wp_json_encode("Your session may have expired. Please refresh the page and try again.") . ')</script>';
								}
							} 
							
							elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id']))
							{
								if (current_user_can('manage_bot_searchbox_settings'))
								{
									$id = absint($_POST['id']);
									$delete_result = $wpdb->delete(
										$wpdb->prefix . 'bot_searchbox_settings',
										array('id' => $id),
										array('%d') 
									);

									// if ($delete_result !== false) 
									// {
										// echo esc_html('Record deleted successfully');
									// } 
									
									// else 
									// {
										// echo 'Error deleting record: ' . esc_html($wpdb->last_error);
									// }
								}								
							}

							$query = "SELECT * FROM {$wpdb->prefix}bot_searchbox_settings";

							// Execute the query with wpdb::prepare
							$results = $wpdb->get_results($wpdb->prepare($query), ARRAY_A);

							if ($results === false) 
							{
								displayErrorMessage("Query failed: " . $wpdb->last_error);
							} 
							
							else 
							{
								if (!empty($results)) 
								{
									echo '<table style="margin-bottom: 20px;" class="widefat">';
									echo '<thead>';
									echo '<tr>';
									echo '<th style="text-align: center;" class="sequence-number">No.</th>';
									echo '<th style="text-align: center;">Title</th>';
									echo '<th style="text-align: center;">Size</th>';
									echo '<th style="text-align: center;">Default Type</th>';
									echo '<th style="text-align: center;">Option</th>';
									echo '</tr>';
									echo '</thead>';
									echo '<tbody id="data-table">';

									$count = 1; 

									foreach ($results as $row) 
									{
										echo '<tr>';
										echo '<td style="text-align: center;" class="sequence-number">' . esc_html($count) . '</td>';
										echo '<td style="text-align: center;">' . esc_html($row['title']) . '</td>';
										echo '<td style="text-align: center;">' . esc_html($row['size']) . '</td>';
										echo '<td style="text-align: center;">' . esc_html($row['default_type']) . '</td>';
										echo '<td style="text-align: center;">';

										echo '<a href="#" onclick="editRecord(' . esc_js($row['id']) . ', \'' . esc_js($row['title']) . '\', \'' . esc_js($row['size']) . '\', \'' . esc_js($row['default_type']) . '\', \'' . esc_js($row['default_from']) . '\', \'' . esc_js($row['default_to']) . '\');">Edit</a>';
										echo ' | ';
										echo '<a href="#" onclick="deleteRecord(' . esc_js($row['id']) . ');">Delete</a>';

										echo '</td>';
										echo '</tr>';

										$count++; 
									}

									echo '</tbody>';
									echo '</table>';
								} 
								
								else 
								{
									echo esc_html('No data found.');
								}
							}
						?>
						</div>	

						<script>
							function editRecord(id, editedTitle, editedSize, editedType, from_searchbox2, to_searchbox2) 
							{	
								localStorage.removeItem('hasCustomCSS');
								loadCustomStyle2('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>');
								
								if (!document.getElementById('from_to_functions2_script')) 
								{
									// Add the script tag dynamically
									var script = document.createElement('script');
									script.id = 'from_to_functions2_script';
									script.type = 'text/javascript';
									script.src = '<?php echo esc_url(plugin_dir_url(__FILE__) . 'js/from_to_function2.js'); ?>';
									script.defer = true; 
									document.head.appendChild(script);
								}
								
								// Add the script tag for 'search_box_function.js' dynamically
								if (!document.getElementById('search_box_function_script')) 
								{
									var script2 = document.createElement('script');
									script2.id = 'search_box_function_script';
									script2.type = 'text/javascript';
									script2.src = '<?php echo esc_url(plugin_dir_url(__FILE__) . 'js/search_box_function.js'); ?>';
									script2.defer = true; 
									document.head.appendChild(script2);
								}
								
                                hiddenDiv2.style.display = 'none';
								document.getElementById('shortcode_setting').style.display = 'none';

								// Hide the data-form
								document.getElementById('data-form').style.display = 'none';

								// Show the edit-form
								document.getElementById('edit-form').style.display = 'block';
								
								// Populate the form fields with the provided data
								document.getElementById('edit-form').action = window.location.href; 
								document.getElementsByName('id')[0].value = id;
								document.getElementsByName('editedTitle')[0].value = editedTitle;

								// Check the appropriate radio button based on the value
								document.querySelector('input[name="editedSize"][value="' + editedSize + '"]').checked = true;

								// Set the selected option in the dropdowns
								document.getElementById('editedType').value = editedType;

								// Set values for from_searchbox and to_searchbox
								document.getElementsByName('from_searchbox2')[0].value = from_searchbox2;
								document.getElementsByName('to_searchbox2')[0].value = to_searchbox2;

								// Toggle the visibility of divSearch_BoxPreview
								document.getElementById('divSearch_BoxPreview2').style.display = 'none';			
								document.getElementById('previewMsg2').style.display = 'none';

								// Scroll to the form
								document.getElementById('edit-form').scrollIntoView();
							}
							
							function deleteRecord(id) {
								if (confirm('Are you sure you want to delete this record?')) {
									var xhr = new XMLHttpRequest();
									xhr.open('POST', window.location.href, true);
									xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
									xhr.onload = function() {
										if (xhr.status === 200) {
											window.location.reload();
										} else {
											alert('Error deleting record. Please try again.');
										}
									};
									xhr.onerror = function() {
										alert('Error deleting record. Please try again.');
									};
									xhr.send('action=delete&id=' + id);
								}
							}
						</script>
						
						<br><br>

						<h2 style="margin-bottom: 13px;"><span>Search Box Setting</span></h2>
						
						<!-- start edit form -->
						<form method="post" action="" id="edit-form">
							<input type="hidden" name="action" value="edit">
							<input type="hidden" name="id" value="<?php echo esc_attr(isset($id) ? $id : ''); ?>">

							<div class="form-group">
								<label for="editedTitle" style="min-width: 100px !important">Title:</label>
								<input type="text" name="editedTitle" class="regular-text" id="editedTitle" value="<?php echo esc_attr(isset($editedTitle) ? $editedTitle : ''); ?>" /><br>
							</div>
							
							<br><br>
							
							<div class="form-group">
								<label for="editedSize" style="min-width: 100px !important">Size:</label>

								<input type="radio" name="editedSize" value="265x424" id="editedSize1" <?php echo isset($row['size']) && $row['size'] === '265x424' ? 'checked' : ''; ?> />
								<span style="margin-right: 10px;">265 x 424</span>&emsp;&emsp;

								<input type="radio" name="editedSize" value="315x291" id="editedSize2" <?php echo isset($row['size']) && $row['size'] === '315x291' ? 'checked' : ''; ?> />
								<span style="margin-right: 10px;">315 x 291</span>&emsp;&emsp;

								<input type="radio" name="editedSize" value="570x294" id="sizeditedSize3" <?php echo isset($row['size']) && $row['size'] === '570x294' ? 'checked' : ''; ?> />
								<span>570 x 294</span>
								
								<label for="editedType" style="min-width: 100px!important; margin-left: 86px;">Default type:</label>
								<select name="editedType" id="editedType">
									<option value="bus" <?php echo isset($row['default_type']) && $row['default_type'] === 'bus' ? 'selected' : ''; ?>>Bus</option>
									<option value="train" <?php echo isset($row['default_type']) && $row['default_type'] === 'train' ? 'selected' : ''; ?>>Train</option>
									<option value="ferry" <?php echo isset($row['default_type']) && $row['default_type'] === 'ferry' ? 'selected' : ''; ?>>Ferry</option>
								</select>
							</div>						
							
							<br><br>
							
							<div class="form-group" style="display:flex">
								<div class="div-from-location2" style="position: relative">
									<label for="from_searchbox2" style="min-width: 100px!important;width: 50px;line-height: 18px;">Default From (optional):</label>
									<input type="text" placeholder="Select a departure point" name="from_searchbox2" id="from_searchbox2" class="locations-text txtFromLoc2" value="<?php echo isset($row['default_from']) ? esc_attr($row['default_from']) : ''; ?>" autocomplete="off" />
									<div style=" max-height: 150px; overflow-y: auto; left: 104px; width: 175px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultFrom2 dropdown-container2">
										<ul class="select2-results"></ul>
									</div>
								</div>

								<div class="div-to-location2" style="position: relative; margin-left:225px">
									<label for="to_searchbox2" style="min-width: 100px!important;width: 50px;line-height: 18px;">Default To (optional):</label>
									<input type="text" placeholder="Select a destination" name="to_searchbox2" id="to_searchbox2" class="locations-text txtToLoc2" value="<?php echo isset($row['default_to']) ? esc_attr($row['default_to']) : ''; ?>" autocomplete="off" />
									<div style="max-height: 150px; overflow-y: auto; left: 104px; width: 175px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultTo2 dropdown-container2">
										<ul class="select2-results"></ul>
									</div>
								</div>
							</div>
							
							<br><br>	

							<!-- css setting -->
							<div style="display: flex; align-items: center; margin-bottom: 13px">
								<h2><span>CSS Setting &nbsp</span></h2>
								<input type="hidden" name="edit_css_submit2" id="edit_css_submit2_input" value="<?php echo isset($hidden_field2) ? esc_attr('Y') : ''; ?>">
								<button type="button" class="button" id="edit_css_submit2">Edit</button>
							</div>
							
							<div id="hiddenDiv2" style="display: <?php echo isset($hidden_field2) && $hidden_field2 === 'Y' ? esc_attr('block') : esc_attr('none'); ?>;">
							
								<?php
									// Read the content of search.css file
									$cssFilePath2 = plugin_dir_path(__FILE__) . 'css/search.css';

									if (file_exists($cssFilePath2)) 
									{
										$cssContent2 = file_get_contents($cssFilePath2);
									} 
									
									else 
									{
										$cssContent2 = '/* Error: Unable to read search.css file. Path: ' . $cssFilePath2 . ' */';
									}
								?>
							
								<textarea name="code-editor2" id="code-editor2" style="width: 100%; height: 300px; font-family: monospace; text-align: left;"><?php echo esc_textarea($cssContent2); ?></textarea>			
								
								<div class="inside" style="margin-top: 15px;">
									<input class="button-primary" style="width: 60px; float: right;" type="button" name="save_button_css2" id="save_button_css2" value="Save" />
									<input class="button-primary" style="width: 60px; margin-right: 8px; float: right" type="button" name="cancel_button_css2" value="Cancel" id="cancel_button_css2" />
								</div>							
							</div>
							
							<br><br>
							
							<script>
								document.addEventListener('DOMContentLoaded', function () {
									// Check if custom CSS has been saved previously
									var hasCustomCSS2 = localStorage.getItem('hasCustomCSS');

									// If custom CSS has been saved, use it for preview
									if (hasCustomCSS2) 
									{
										loadCustomStyle2('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>');
									} 
									
									else 
									{
										// If not saved, use original CSS for preview
										loadCustomStyle2('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style-ori.css'); ?>');
									}

									document.getElementById('save_button_css2').addEventListener('click', function () {
										saveCSS2();
									});

									document.getElementById('previewBox2').addEventListener('click', function () {
										previewBox2();
									});
								});

								function saveCSS2() 
								{
									var textareaValue2 = document.getElementById('code-editor2').value;

									// AJAX request to save data
									var xhr2 = new XMLHttpRequest();
									xhr2.open('POST', ajaxurl, true);
									xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

									xhr2.onload = function () {
										if (xhr2.status >= 200 && xhr2.status < 400) 
										{
											console.log(xhr2.responseText);
											alert("CSS file saved successfully!");
											localStorage.setItem('hasCustomCSS', 'true');
											loadCustomStyle2('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>');
										} 
										
										else 
										{
											console.error('Error:', xhr2.statusText);
											alert("Error saving CSS file.");
										}
									};

									xhr2.onerror = function () {
										console.error('Network Error');
									};

									// Prepare data to send in the request
									var data2 = 'action=save_css&css_content=' + encodeURIComponent(textareaValue2);
									
									xhr2.send(data2);
								}

								function loadCustomStyle2(href) 
								{
									// Dynamically load custom-style.css for preview
									var linkElement2 = document.createElement('link');
									linkElement2.rel = 'stylesheet';
									linkElement2.type = 'text/css';
									linkElement2.href = href;

									// Remove existing CSS link
									var existingLink2 = document.querySelector('link[data-preview-css]');
									
									if (existingLink2) 
									{
										existingLink2.remove();
									}

									// Add the new CSS link with a data attribute for identification
									linkElement2.setAttribute('data-preview-css', 'true');
									document.head.appendChild(linkElement2);
								}

								function previewBox2() 
								{
									// Trigger the preview logic
									// Check if custom CSS has been saved previously
									var hasCustomCSS2 = localStorage.getItem('hasCustomCSS');

									// If custom CSS has been saved, use it for preview
									if (hasCustomCSS2) 
									{
										loadCustomStyle2('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>');
									} 
									
									else 
									{
										// If not saved, use original CSS for preview
										loadCustomStyle2('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style-ori.css'); ?>');
									}
								}
							</script>	
							<!-- end css setting -->								
							<br>
								
							<?php wp_nonce_field('nonce_edit_form', '_wpnonce_edit_form'); ?>
							
							<div class="inside" style="margin-top: 15px; text-align: center;">							
								<input class="button-secondary" style="padding: 3px 10px; margin-right: 10px" type="button" name="cancelEdit" id="cancelEdit" value="Cancel Edit" />
								
								<input class="button-secondary" style="padding: 3px 10px; margin-right: 10px" type="submit" name="saveEdit" id="saveEdit" value="Save Edit" />
								
								<input class="button-secondary" style="padding: 3px 10px; margin-right: 10px" type="button" name="previewBox2" id="previewBox2" value="Preview" />
								
								<input class="button-secondary" style="padding: 3px 10px;" type="button" name="shortcode_submit2" id="shortcode_submit2" value="Generate Shortcode" />
							</div><br>
							
							<div id="previewMsg2" style="display: none;">
								<p style="font-size: 13px; font-style: italic; font-weight: bold; text-align: center;">Search Box Preview</p>
							</div>
							<div style="text-align: left; justify-content: center; display: none;" id="divSearch_BoxPreview2"></div>	
						</form>
						<!-- end edit form -->						
						
						<form method="post" action="" id="data-form">
							<div class="form-group">
								<label for="title" style="min-width: 100px !important">Title:</label>
								<input type="text" name="title_searchbox" class="regular-text" /><br>
							</div>
							
							<br><br>
							
							<div class="form-group">
								<label for="size" style="min-width: 100px !important">Size:</label>
								
								<input type="radio" name="example" value="265x424" id="size1" checked />
								<span style="margin-right: 10px;">265 x 424</span>&emsp;&emsp;
								
								<input type="radio" name="example" value="315x291" id="size2" />
								<span style="margin-right: 10px;">315 x 291</span>&emsp;&emsp;
								
								<input type="radio" name="example" value="570x294" id="size3" />
								<span>570 x 294</span>    		

								<label for="type" style="min-width: 100px!important; margin-left: 86px;">Default type:</label>
								<select name="type_searchbox" id="type_searchbox">
									<option selected="selected" value="bus">Bus</option>
									<option value="train">Train</option>
									<option value="ferry">Ferry</option>
								</select>									
							</div>
							
							<br><br>
							
							<div class="form-group" style="display:flex">
								<div class="div-from-location" style="position: relative">
									<label for="from" style="min-width: 100px!important;width: 50px;line-height: 18px;">Default From (optional):</label>
									<input type="text" placeholder="Select a departure point" name="from_searchbox" class="locations-text txtFromLoc" autocomplete="off"/>
									<div style=" max-height: 150px; overflow-y: auto; left: 104px; width: 175px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultFrom dropdown-container">
										<ul class="select2-results"></ul>
									</div>	
								</div>									
								<div class="div-to-location" style="position: relative; margin-left:225px">
									<label for="to" style="min-width: 100px!important;width: 50px;line-height: 18px;">Default To (optional):</label>
									<input type="text" placeholder="Select a destination" name="to_searchbox" class="locations-text txtToLoc" autocomplete="off" />
									<div style="max-height: 150px; overflow-y: auto; left: 104px; width: 175px; top: 27px; bottom: auto; position: absolute; display: none; background-color: #ffffff; z-index: 1; border: 1px solid #cccccc; border-top: none;" class="divSearchResultTo dropdown-container">
										<ul class="select2-results"></ul>
									</div>
								</div>
							</div>
							
							<br><br><br>							
							
							<!-- css setting -->
							<div style="display: flex; align-items: center; margin-bottom: 13px">
								<h2><span>CSS Setting &nbsp</span></h2>
								<input type="hidden" name="edit_css_submit" value="Y">
								
								<?php
								if (isset($_POST['edit_css_submit'])) 
								{
									$hidden_field3 = 'Y'; 
								}
								
								submit_button('Edit', 'small', 'edit_css_submit', false, null);
								?>
							</div>
							
							<div id="hiddenDiv" style="display: <?php echo isset($hidden_field3) && $hidden_field3 === 'Y' ? esc_attr('block') : esc_attr('none'); ?>;">
							
								<?php
									// Read the content of search.css file
									$cssFilePath = plugin_dir_path(__FILE__) . 'css/search.css';

									if (file_exists($cssFilePath)) 
									{
										$cssContent = file_get_contents($cssFilePath);
									}
									
									else 
									{
										$cssContent = '/* Error: Unable to read search.css file. Path: ' . $cssFilePath . ' */';
									}
								?>
							
								<textarea name="code-editor" id="code-editor" style="width: 100%; height: 300px; font-family: monospace; text-align: left;"><?php echo esc_textarea($cssContent); ?></textarea>			
								
								<div class="inside" style="margin-top: 15px;">
									<input class="button-primary" style="width: 60px; float: right;" type="button" name="save_button_css" id="save_button_css" value="Save" />
									<input class="button-primary" style="width: 60px; margin-right: 8px; float: right" type="button" name="cancel_button_css" value="Cancel" id="cancel_button_css" />
								</div>							
							</div>
							
							<script>
								document.addEventListener('DOMContentLoaded', function () {
									// Check if custom CSS has been saved previously
									var hasCustomCSS = localStorage.getItem('hasCustomCSS');
									
									// Check if the page is being reloaded
									var isPageReloaded = performance.navigation.type === 1;

									// If the page is being reloaded, remove the hasCustomCSS flag from localStorage
									if (isPageReloaded) 
									{
										localStorage.removeItem('hasCustomCSS');
									}

									// If custom CSS has been saved, use it for preview
									if (hasCustomCSS) 
									{
										loadCustomStyle('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>');
									} 
									
									else 
									{
										// If not saved, use original CSS for preview
										loadCustomStyle('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style-ori.css'); ?>');
									}

									document.getElementById('save_button_css').addEventListener('click', function () {
										saveCSS();
									});

									document.getElementById('previewBox').addEventListener('click', function () {
										previewBox();
									});
								});

								function saveCSS() 
								{
									var textareaValue = document.getElementById('code-editor').value;

									// AJAX request to save data
									var xhr = new XMLHttpRequest();
									xhr.open('POST', ajaxurl, true);
									xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

									xhr.onload = function () {
										if (xhr.status >= 200 && xhr.status < 400) 
										{
											console.log(xhr.responseText);
											alert("CSS file saved successfully!");
											localStorage.setItem('hasCustomCSS', 'true');
											loadCustomStyle('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>');
										} 
										
										else 
										{
											console.error('Error:', xhr.statusText);
											alert("Error saving CSS file.");
										}
									};

									xhr.onerror = function () {
										console.error('Network Error');
									};

									// Prepare data to send in the request
									var data = 'action=save_css&css_content=' + encodeURIComponent(textareaValue);

									// Send the request
									xhr.send(data);
								}

								function loadCustomStyle(href) 
								{
									// Dynamically load custom-style.css for preview
									var linkElement = document.createElement('link');
									linkElement.rel = 'stylesheet';
									linkElement.type = 'text/css';
									linkElement.href = href;

									// Remove existing CSS link
									var existingLink = document.querySelector('link[data-preview-css]');
									
									if (existingLink) 
									{
										existingLink.remove();
									}

									// Add the new CSS link with a data attribute for identification
									linkElement.setAttribute('data-preview-css', 'true');
									document.head.appendChild(linkElement);
								}

								function previewBox() 
								{
									// Trigger the preview logic
									// Check if custom CSS has been saved previously
									var hasCustomCSS = localStorage.getItem('hasCustomCSS');

									// If custom CSS has been saved, use it for preview
									if (hasCustomCSS) 
									{
										loadCustomStyle('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style.css'); ?>');
									} 
									
									else 
									{
										// If not saved, use original CSS for preview
										loadCustomStyle('<?php echo esc_url(plugin_dir_url(__FILE__) . 'css/custom-style-ori.css'); ?>');
									}
								}
							</script>									
							<!-- end css setting -->	
							<br>

							<div class="inside" style="margin-top: 15px; text-align: center;">							
								<input class="button-secondary" style="padding: 3px 10px; margin-right: 10px" type="button" name="previewBox" id="previewBox" value="Preview" />
								
								<input class="button-secondary" style="padding: 3px 10px;" type="submit" name="shortcode_submit" id="shortcode_submit" value="Generate Shortcode & Save" />
							</div>
							
							<br>
							
							<div id="previewMsg" style="display: none;">
								<p style="font-size: 13px; font-style: italic; font-weight: bold; text-align: center;">Search Box Preview</p>
							</div>
							<div style="text-align: left; justify-content: center; display: none;" id="divSearch_BoxPreview"></div>			
						</form>
						
						<br><br>
						
						<div id="shortcode_setting" style="display: none;">
						
							<!-- Shortcode -->
							<div id="shortcode_title" style="display: flex; align-items: center; margin-bottom:13px">
								<h2><span>Shortcode</span></h2>&nbsp (Copy this shortcode and paste it into your post, page, or text widget content)
							</div>
							
							<div id="container" style="display: flex;">							
								<textarea readonly id="shortcode-editor" style="width: 100%; height: 130px; font-family: monospace; text-align: left; margin-top: 7px;"></textarea>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<br class="clear">
	</div>
</div> <!-- .wrap -->