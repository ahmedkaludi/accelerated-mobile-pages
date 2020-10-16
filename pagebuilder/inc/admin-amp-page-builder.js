Vue.component('amp-pagebuilder-modal', {
  template: '#amp-pagebuilder-modal-template',
  props: ['dataContent'],
  mounted: function(){
  	document.body.addEventListener('keyup', e => {
  		 if (e.keyCode === 27) {
  		 	this.hidePageBuilderPopUp();
  		 }
  	});
  },
  data: function(){
  	return {
  		currentLayoutData: app.mainContent,
  		modalCrrentTab: 'layout',
  		ajaxurl: amppb_panel_options.ajaxUrl,
  		save_layout:{name:'',
  					url:''
  					},
  		showsavedLayouts :amppb_panel_options.savedLayouts,
  		importLayoutfromFile: '',
  		innerLayouts: '',
  		innerLayoutsHeading: '',
  		ampb_script_textarea: (app.mainContent.settingdata['scripts_data']? app.mainContent.settingdata['scripts_data']: ''),
  		ampb_style_textarea: (app.mainContent.settingdata['style_data']? app.mainContent.settingdata['style_data']:''),
  		layoutMsg: ''
  	}
  },
  methods:{
  	hidePageBuilderPopUp: function(event){
			app.showModal = false;
		},
	settingShowTabs: function(key){
		this.modalCrrentTab=key;
	},
	savePagebuilderSettings:function(currentLayoutData){
		//app.mainContent = currentLayoutData;
		app.mainContent.settingdata['scripts_data'] = this.ampb_script_textarea;
		app.mainContent.settingdata['style_data'] = this.ampb_style_textarea;
		this.hidePageBuilderPopUp();
	},
	removeSavedLayout: function(postId){
		var saveLayoutData = {
							action: 'amppb_remove_saved_layout_data',
							layoutid:postId,
							verify_nonce: amppb_panel_options.secure_nonce
							};
		this.$http.post(amppb_panel_options.ajaxUrl+'?action=amppb_remove_saved_layout_data', 
						saveLayoutData,
						{
						headers:{
							responseType:'json'
						},
						responseType:'json',
						emulateHTTP:true,
						emulateJSON:true,
						}
					).then(function(response){
						response =response.body;
						if(response.status=="200"){
							this.layoutMsg = "Layout removed successfully!";
							this.showsavedLayouts = response.data;
							amppb_panel_options.savedLayouts = this.showsavedLayouts;
 							this.save_layout = {name:"",url:""};
						}
						else if(response.status=="404"){
							this.layoutMsg = "Try Again";
						}else if(response.status=="403"){
							this.layoutMsg = "Sorry! You don't have permission to delete the layout.";
						}
					    setTimeout(() => {
				          	this.layoutMsg = '';
				      	},5000);
					},
					 //errorCallback
					 function(){
					 	alert('connection not establish');
					 });
	},
	savePagebuildercustomLayout: function(event){
		if(!this.save_layout.name && this.save_layout.name==""){
			alert("Please enter name of layout");
			return false;
		}
		var saveLayoutData = {
							action: 'amppb_save_layout_data',
							layoutname:this.save_layout.name,
							layoutdata: JSON.stringify(this.currentLayoutData),
							verify_nonce: amppb_panel_options.secure_nonce
							};
		this.$http.post(amppb_panel_options.ajaxUrl+'?action=amppb_save_layout_data', 
						saveLayoutData,
						{
						headers:{
							responseType:'json'
						},
						responseType:'json',
						emulateHTTP:true,
						emulateJSON:true,
						}
					).then(function(response){
						response =response.body;
						//var somtest = response.json(response.body);
						if(response.status="200"){
							this.showsavedLayouts = response.data;
							amppb_panel_options.savedLayouts = this.showsavedLayouts
							
							this.save_layout = {name:"",url:""};
						}
					},
					 //errorCallback
					 function(){
					 	alert('connection not establish');
					 });
	},
	layoutFileSelected: function(event){
		//jQuery(event.target).
		var currentComponent = this;
		var filename  = event.target.name;
		var files = event.target.files;
		// console.log(files);
		var fileCount = event.target.files.length;
		if(fileCount>0){
			var rawFile = files[0];

			var reader = new FileReader();
			reader.readAsText(rawFile, "UTF-8");
			 	reader.onload = function (evt) {
		        currentComponent.importLayoutfromFile = evt.target.result;
		        
		    }
		    reader.onerror = function (evt) {
		        alert("error reading file");
		    }
			
		}//if closed
	},
	replacelayoutFromSelectedFile :function(){
		var response = confirm("Replace current layout. \n Do you want to import new layout?");
		if(response){
			app.mainContent = JSON.parse(this.importLayoutfromFile);
			app.call_default_functions();
		}
		this.hidePageBuilderPopUp();
	},
	importLayout: function(event){
		var response = confirm("Replace current layout. \n Do you want to import new layout?");
		if(response){
			app.mainContent = JSON.parse(event.target.getAttribute('data-layout'));
			app.call_default_functions();
		}
		this.hidePageBuilderPopUp();
	},
	viewSpacialLayouts: function(event){
		this.innerLayouts = JSON.parse(event.target.getAttribute('data-info'));
		this.innerLayoutsHeading = event.target.getAttribute('data-heading');
	},
	loadLayOutFolder: function(){
		this.innerLayouts = '';
		this.innerLayoutsHeading = '';
	},
  }
})
Vue.component('amp-pagebuilder-module-modal', {
  template: '#amp-pagebuilder-module-modal-template',
  props: [],
  data: function(){
  	return {
	  	modalcontent: app.modalcontent,
	  	editModuleTempTitle: false,
	  };
  },
  mounted: function () {//On ready State for component
		document.body.addEventListener('keyup', e => {
			if (e.keyCode === 27) {
				this.hideModulePopUp();
			}
	  	});
	},
  methods:{
  	repeaterAcoordian: function(event){
  		var repeatHead = jQuery(event.target.parentElement).find("div.amp-accordion-head").find('span.amp-accordion-label');
  		var repeatContents = jQuery(event.target.parentElement).find("div.amp-accordion-content");
  		if(repeatContents.hasClass('active')){
  			repeatContents.removeClass('active');
  			repeatContents.addClass('hide');
  			repeatHead.html('(Show)');
  			jQuery(event.target.parentElement).removeClass("amp-repeat-active");
  		}else{
  			repeatContents.removeClass('hide');
  			repeatContents.addClass('active');
  			jQuery(event.target.parentElement).addClass("amp-repeat-active");
  			repeatHead.html('(Hide)');
  		}
  	},
  	showhideAccordian:function(event){
  		jQuery(event.target).parent(".amp-accordion-head").click();
  	},
  	hideModulePopUp: function(event){
			app.showmoduleModal = false;
		},
	showtabs: function(key){
		this.modalcontent.default_tab=key;
	},
	removeModule: function(){
		var response = confirm("Do you want to delete Module? ");
			if(response){
				app.mainContent.rows.forEach(function(rowData, rowKey){
					if(rowData.id==app.modalTypeData.containerId){
						if(app.modalType=='module'){
							rowData.cell_data.forEach(function(moduleData, moduleKey){
								if(moduleData.cell_id==app.modalTypeData.moduleId){
									Vue.delete( rowData.cell_data, moduleKey );
									return false;
								}
							});
						}
					}
				});
			}
			app.call_default_functions();
			this.hideModulePopUp();
	},
	saveModulePopupdata: function(fields,repeater){
		if(app.stopModuleModalClose==true){
			alert('Please wait till load image.');
			return false;
		}
		//Save Values to main content
		app.mainContent.rows.forEach(function(rowData, rowKey){
			if(rowData.id==app.modalTypeData.containerId){
				if(app.modalType=='module'){
					rowData.cell_data.forEach(function(moduleData, moduleKey){
						if(moduleData.cell_id==app.modalTypeData.moduleId){
							fields.forEach(function(fieldData,fieldKey){
								Vue.set( moduleData, fieldData.name, fieldData.default );
								if(fieldData[fieldData.name+"_image_data"]){
									Vue.set( moduleData, fieldData.name+"_image_data", fieldData[fieldData.name+"_image_data"] );
								}
							})
							if(app.modalcontent.repeater){
								moduleData.repeater = [];
								app.modalcontent.repeater.showFields.forEach(function(repeatWrapper,repKey){
									var repeaterData = {};
									repeatWrapper.forEach(function(repeatField,repFieldKey){
										var stringToArray = repeatField.name.split("_");
										stringToArray.pop();
										var arrayToString = stringToArray.join('_');
										var finalString = arrayToString+"_"+repKey;
										repeaterData[finalString] = repeatField.default;
										if(repeatField[finalString+"_image_data"]){
											repeaterData[finalString+"_image_data"] = repeatField[finalString+"_image_data"];
										 
										}
										 
									 
									});
									repeaterData['index'] = (repKey+1);
									moduleData.repeater.push(repeaterData);
								});
							}
						}
					});
				}else if(app.modalType=='rowSetting'){
					var a = {};
					fields.forEach(function(fieldData,fieldKey){
						a[fieldData.name] = fieldData.default;
						if(fieldData[fieldData.name+"_image_data"]){
							a[fieldData.name+"_image_data"] = fieldData[fieldData.name+"_image_data"];
						}
					});
					
					Vue.set( rowData, 'data', a );
				}
			}
		});
		app.call_default_functions();
		this.hideModulePopUp();
		return true;
	},
	duplicateRepeaterField: function(repeater){
		
		//app.modalcontent.repeater.showFields.push(repeater.fields);
		//Vue.set(app.modalcontent.repeater,'showFields',repeater.fields);
		var allRepeaterFileds = JSON.parse(JSON.stringify(app.modalcontent.repeater.fields));

		totalFields = app.modalcontent.repeater.showFields.length;
		if(totalFields>0){
			var lastName = app.modalcontent.repeater.showFields[totalFields-1][0]['name'];
			var lastNamePieces = lastName.split("_");
			var nextFieldCount = parseInt(lastNamePieces[lastNamePieces.length-1])+1;
		}else{
			var nextFieldCount = 0;
		}
		allRepeaterFileds.forEach(function(newFields,newKey){
			newFields.name = newFields.name+'_'+nextFieldCount;
		})

		app.modalcontent.repeater.showFields.push(allRepeaterFileds);

		this.$forceUpdate();
	},
	removeRepeaterSection:function(key,repeater){
		Vue.delete( app.modalcontent.repeater.showFields, key );
		this.$forceUpdate();
	},
	repeaterShowHideCheck:function(modalcontent){
		var returnOpt = true;
		if(modalcontent.repeater.required){
			var requiredCondition = modalcontent.repeater.required;
				app.modalcontent.fields.forEach(function(maindata, key){
					if(requiredCondition[maindata.name]){
						if( maindata.default==requiredCondition[maindata.name]){
							returnOpt = true;
						}else{
							returnOpt = false;
						}
					}
				});
		}
		return returnOpt;
	},
	repeater_rows_moved: function(evt){
		if(evt && evt.type=='end'){
			this.$forceUpdate();
		}
		return true;
	  },


	editModuleTitle: function(modalcontent){
		this.editModuleTempTitle = modalcontent.cell_identity_name;
	},
	saveModuleTitle: function(modalcontent){
		app.mainContent.rows.forEach(function(rowData, rowKey){
			if(rowData.id==app.modalTypeData.containerId){
				if(app.modalType=='module'){
					rowData.cell_data.forEach(function(moduleData, moduleKey){
						if(moduleData.cell_id==app.modalTypeData.moduleId){
							//app.modalcontent.cell_identity_name = modalcontent.cell_identity_name
							Vue.set( moduleData, 'cell_identity_name', modalcontent.cell_identity_name );
						}
					});
				}
			}
		});
		
		this.editModuleTempTitle = false;
	},
	cancleModuleTitle: function(modalcontent){
		app.modalcontent.cell_identity_name = this.editModuleTempTitle;
		this.editModuleTempTitle = false;
	}

  }
})

//module is working
Vue.component('module-data',{
	template: '#module-data-template',
	props: ['cell','cellcontainer','modulekey'],
	data:function(){
		return {
			showModuleModal: false,
		};
	},
	methods:{
		showModulePopUp: function(event){
			openModulePopup(event,'module');
		},
		duplicateModule: function(event){
			currentModuleId = parseInt( event.currentTarget.getAttribute('data-module_id') );
			currentcontainerId = parseInt( event.currentTarget.getAttribute('data-container_id') );
			var updateRowKey = ''; var updateModuleKey = ''; var newDuplicateData = {};
			app.mainContent.rows.forEach(function(rowData, rowKey){
				if(rowData.id == currentcontainerId){
					rowData.cell_data.forEach(function(moduleData, moduleKey){
						if(moduleData.cell_id==currentModuleId){
							var modulesid = parseInt(app.mainContent.totalmodules);
							newDuplicateData = _.clone(moduleData);
							newDuplicateData.cell_id = modulesid;
							updateRowKey = rowKey;
							updateModuleKey = moduleKey;
							app.mainContent.totalmodules = modulesid+1;
						}
					});
				}
			});
			if(updateModuleKey>0){
				app.mainContent.rows[updateRowKey].cell_data.splice(updateModuleKey, 0,newDuplicateData);
			}else{
				app.mainContent.rows[updateRowKey].cell_data.push(newDuplicateData);
				
			}
			app.re_process_rawdata();
		}//duplicateModule closed
	}
});

function openModulePopup(event,type){
	app.showmoduleModal = true;
	popupContent = event.currentTarget.getAttribute('data-popupContent'); 
	app.modalType = type;
	app.modalcontent = JSON.parse(popupContent);
	if(type=='module'){
		currentModuleId = event.currentTarget.getAttribute('data-module_id'); 
		currentcontainerId = event.currentTarget.getAttribute('data-container_id');
		app.modalTypeData = {
							'moduleId': currentModuleId,
							'containerId': currentcontainerId
						}

		//Save Values to main content
		app.mainContent.rows.forEach(function(rowData, rowKey){
			if(rowData.id==currentcontainerId){
				rowData.cell_data.forEach(function(moduleData, moduleKey){
					if(moduleData.cell_id==currentModuleId){
						//app.modalcontent.repeater.showFields.forEach
						app.modalcontent.cell_identity_name = moduleData.cell_identity_name;
						app.modalcontent.fields.forEach(function(fieldData,fieldKey){
							//if(moduleData[fieldData.name] && moduleData[fieldData.name]!=''){

								if(fieldData.name in moduleData){
									if(typeof moduleData[fieldData.name] !='undefined'){
										var userValues = moduleData[fieldData.name];
									}else{
										var userValues = fieldData.default;
									}
								}else{
									var userValues = fieldData.default;
								}
								
								
								if('object' != typeof(userValues)){
									userValues = decodeURIComponent(encodeURIComponent(userValues));
									
								}

								if(fieldData['type']=='color-picker'){
									Vue.set( fieldData, 
										'default_reset_val', 
										fieldData['default'] );
								}
								Vue.set( fieldData, 
										'default', 
										userValues );
							//}
							//console.log(app.modalcontent.repeater);
							if(moduleData.repeater){
								
								app.modalcontent.repeater.showFields = [];
								moduleData.repeater.forEach(function(savedREPValue,savedkey){
									var allRepeaterFileds = JSON.parse(JSON.stringify(app.modalcontent.repeater.fields));
									allRepeaterFileds.forEach(function(newFields,newKey){
										newFields.name = newFields.name+'_'+savedkey;
										//if(savedREPValue[newFields.name]){
											//console.log(savedREPValue[newFields.name],newFields.name)
											if(typeof savedREPValue[newFields.name] !='undefined'){
											newFields.default = savedREPValue[newFields.name];
											}
										//}
									})
									app.modalcontent.repeater.showFields.push(Vue.util.extend([], allRepeaterFileds));
								});
							
							}else if(app.modalcontent.repeater){//Added support for pre-build layouts for repeater
								if(app.modalcontent.repeater && app.modalcontent.repeater.fields.length > 0){
									var repeaterArray = {};
									app.modalcontent.repeater.fields.forEach(function(module,key){
										repeaterArray[module.name+'_0'] = module.default;
									});
									moduleData.repeater = [];
									moduleData.repeater.push(repeaterArray);
								}
							}

						})
					}
				});
			}
		});



	}else if(type=='rowSetting'){
		currentcontainerId = event.currentTarget.getAttribute('data-container_id'); 
		app.modalTypeData = {
							'containerId': currentcontainerId
						}

		//Save Values to main content
		app.mainContent.rows.forEach(function(rowData, rowKey){
			if(rowData.id==currentcontainerId){
				app.modalcontent.fields.forEach(function(fieldData,fieldKey){
					if(rowData.data[fieldData.name] && rowData.data[fieldData.name]!=''){
						Vue.set( fieldData, 'default', rowData.data[fieldData.name] );
					}
					
				})
			}
		});
	}
	
	
}
Vue.component('text-editor',{
	template: '#text-editor-template',
	props: [],
	mounted: function () {//On ready State for component
		this.$nextTick(function () {
			
		});
	},
	methods:{
		buildEditor:function() {
				}
	}
});

Vue.component('fields-data',{
	template: '#fields-data-template',
	props: ['field', 'fieldkey', 'defaulttab', 'completeFields','repeater'],
	data:function(){
		return {
			iconSearch:'',
			text_editor_wysiwig: '',
			text_color_picker: '',
			filteredList : app.filteredList,
			openIconOptions: false
		};
	},
	mounted: function () {//On ready State for component
	  this.$nextTick(function () {
	  		var self = this;
	  		//this.callChangeEnvent();
	  })
	},
	beforeMount: function(){
		if ( this.field.ajax == true ) {
			this.changeOnSelect();
		}
	},
	computed: {
		filteredIcons: function(){
			var self=this;
       		return this.filteredList.filter(function(icon){return icon.name.toLowerCase().indexOf(self.iconSearch.toLowerCase())>=0;});
		}
	},
	methods:{
		select_layout_type: function(field,event){
			var currentSelectfield = event.target;
			selectedValue = currentSelectfield.getAttribute("data-value");
			field.default = selectedValue;
			this.fieldShowHideCheck(field);
			//this.callChangeEnvent();
		},
		selectimages:function(field,event){
			app.stopModuleModalClose = true;
			var currentSelectfield = event.target;
			var componentPointer = this;
			var selectorType = currentSelectfield.getAttribute("data-imageselactor");
			var multiple = false;
			if(selectorType=='multiple'){
				multiple = true;
			}
			var image_frame;
			if(image_frame){
			 image_frame.open();
			}

			// Define image_frame as wp.media object
			image_frame = wp.media({
			           title: 'Select Media',
			           multiple : multiple,
			           library : {
			                type : 'image',
			            }
			       });
			image_frame.on('close',function() {
                  // On close, get selections and save to the hidden input
                  // plus other AJAX stuff to refresh the image preview
                  var selection =  image_frame.state().get('selection');
                  var gallery_ids = new Array();
                  var my_index = 0;
                  selection.each(function(attachment) {
                     gallery_ids[my_index] = attachment['id'];
                     my_index++;
                  });
                  var ids = gallery_ids.join(",");
                  
                  field.default = ids;
                  componentPointer.refresh_image(ids,currentSelectfield,"button",field);
                  componentPointer.$forceUpdate();
               });
			image_frame.on('open',function() {
	            // On open, get the id from the hidden input
	            // and select the appropiate images in the media manager
	            var selection =  image_frame.state().get('selection');
	            ids =  field.default.split(',');
	            if(ids){
		            ids.forEach(function(id) {
		              attachment = wp.media.attachment(id);
		              attachment.fetch();
		              selection.add( attachment ? [ attachment ] : [] );
		            });
	            }

	          });
	        image_frame.open();

		},
		refresh_image: function(the_id,currentSelectfield,type,field){
			console.log(type);
			if(type=='tag'){
				jQuery(currentSelectfield.$el).find('img').attr('src','../wp-includes/images/spinner.gif');
				if(field[field['name']+'_image_data']){
			 		var demoImage = field[field['name']+'_image_data'];
			 	 	jQuery(currentSelectfield).parents('p').find('img').attr('src',demoImage[0]);
			 	 	return ;
			 	}
			}else{
				console.log(jQuery(currentSelectfield).parents('p'))
				jQuery(currentSelectfield).parents('p').find('img').attr('src','../wp-includes/images/spinner.gif');
			}
		        this.$http.post(amppb_panel_options.ajaxUrl+'?action=ampforwp_get_image&id='+the_id+'&verify_nonce='+amppb_panel_options.secure_nonce, 
						{}
						,{
							headers:{
								responseType:'json'
							},
							responseType:'json',
							emulateHTTP:true,
							emulateJSON:true,
						}
					).then(function(response){
						response =response.body;
						 if(response.success === true) {
						 	/*if(currentSelectfield.getAttribute("data-imageselactor")=='multiple'){
						 		var imageList = [];
						 		response.data.forEach(function(imageDetails,key){
						 			console.log(imageDetails);
							 		imageList.push(imageDetails.detail[0]);
							 	});
							 	Vue.set(field,'default',imageList);
							}else{*/
								if(type=='tag'){
									field[field['name']+'_image_data'] = response.data.front_image;
									jQuery(currentSelectfield.$el).find('img').attr('src',response.data.detail[0]);
								}else{
									//console.log(jQuery(currentSelectfield).parents('p'))
									field[field['name']+'_image_data'] = response.data.front_image;
									jQuery(currentSelectfield).parents('p').find('img').attr('src',response.data.detail[0]);
								}
								
								
							//}
						 }else{
						 	if(field[field['name']+'_image_data']){
						 		var demoImage = field[field['name']+'_image_data'];
						 	 	jQuery(currentSelectfield).parents('p').find('img').attr('src',demoImage[0]);
						 	}
						 }
						app.stopModuleModalClose = false;
					},
					 //errorCallback
					 function(){
					 	alert('connection not establish');
					 });
		       
		},
		removeSelectedImage: function(field){
			field.default = '';
            this.$forceUpdate();
		},
		iconSelected: function(icon, field){
			//this.field.default = icon.name;
			field.default = icon.name;
			this.$forceUpdate();
		},
		fieldShowHideCheck: function(field){
			var returnOpt = [];
			if( !field.required_type){
				returnOpt.push(true);
			}
			if(field.required){
				var requiredCondition = field.required;

					app.modalcontent.fields.forEach(function(maindata, key){
						if(requiredCondition[maindata.name]){
							if( Array.isArray(requiredCondition[maindata.name]) ){
								var length = requiredCondition[maindata.name].length
								var checkingInArray = false;
								for(var i = 0; i < length; i++) {
			                        if(requiredCondition[maindata.name][i] == maindata.default){
			                        	checkingInArray = true;
			                        	if( !field.required_type){
			                        		return false;	
			                        	}
			                        } 
			                    }
			                    if(checkingInArray){
			                    	returnOpt.push(true);
			                    }else{
			                    	returnOpt.push(false);
			                    }
							}else if( maindata.default==requiredCondition[maindata.name]){
								returnOpt.push(true);
							}else{
								returnOpt.push(false);
							}
						}
					});
			}

			returnOpt = returnOpt.filter(function(value, index, self) { 
				    return self.indexOf(value) === index;
					});

			if(field.required_type == 'or'){
				var reqOpt = returnOpt.indexOf(true);
				if( reqOpt!= -1){
					return true;
				}else{
					return false;
				}
			}else{
				if(returnOpt.length==1 && returnOpt[0]==true){
					return true;
				}else{
					return false;
				}
			}
			return false;
		},
		changeOnSelect: function(){ //event, field
			var dataAjax = this.field.ajax;//currentSelectfield.getAttribute("data-ajax-dep");
			var dataAjaxDep = this.field.ajax_dep;//currentSelectfield.getAttribute("data-ajax-dep");
			var ajaxAction = this.field.ajax_action;//currentSelectfield.getAttribute("data-ajax-action");
			if('category_selection'==dataAjaxDep || 'taxonomy_selection'==dataAjaxDep){
				if(document.getElementById(dataAjaxDep+"1")){
					document.getElementById(dataAjaxDep+"1").style.visibility = "visible";
				}
			}
			if(typeof dataAjax == 'undefined'){ console.log(dataAjax);  return ; }//return if Selectbox not allowed ajax
			this.$http.post(amppb_panel_options.ajaxUrl+'?action='+ajaxAction, 
				{
					'selected_val': this.field.default,
					'verify_nonce': amppb_panel_options.secure_nonce
				}
				,{
					headers:{
						responseType:'json'
					},
					responseType:'json',
					emulateHTTP:true,
					emulateJSON:true,
				}
			).then(function(response){
				response =response.body;
				 if(response.success === true) {
				 	var option_html = '';				 	
				 	app.modalcontent.fields.forEach(function(modaldata, key){
				 		if(modaldata.name==dataAjaxDep){
				 			modaldata.options_details = response.data;
				 				
				 				// Add default selection for Taxonomy and Category dropdown in Category Module.
								setTimeout(function(){
									let tval = jQuery("#taxonomy_selection").children().children('select').val();
									let cval = jQuery("#category_selection").children().children('select').val();
									if(tval==""){
										jQuery("#taxonomy_selection").children().children('select').val('recent_option');
									}
									if (cval == ''){
										jQuery("#category_selection").children().children('select').val('recent_option');
									}

								},250);

				 			if(document.getElementById(dataAjaxDep+"1")){
								document.getElementById(dataAjaxDep+"1").style.visibility = "hidden";
				 			}
				 		}
				 	});
				 }else{
				 	alert(response.message);
				 }
				
			},
			//errorCallback
			function(){
				alert('connection not establish');
			});			

		}

	}
});

Vue.component('color-picker', {
  template: '#fields-colorPicker-template',
   props: [ 'colorfield' ],
   data: function(){
   	return {} 
   },
   mounted: function() {
   	var componentPoint = this;
   	jQuery(this.$el).parent('div').find('input').wpColorPicker({
    	// you can declare a default color here,
	    // or in the data-default-color attribute on the input
	    defaultColor: componentPoint.colorfield.default_reset_val,
	    // hide the color picker controls on load
	    hide: true,
	    // show a group of common colors beneath the square
	    // or, supply an array of colors to customize further
	    //palettes: true,
	    palettes: ['#000000', 'transparent','#ffffff','#dd3333','#dd9933','#eeee22','#81d742','#1e73be'],
		change: function(event, ui) {
	        var element = event.target;
        	var color = ui.color.toString();
        	componentPoint.colorfield.default = color;
        	
	    },
	    clear: function(event){
	    	componentPoint.colorfield.default = componentPoint.colorfield.default_reset_val;
	    	/*var element = jQuery(event.target).siblings('.wp-color-picker')[0];
	        var color = '';

	        if (element) {
        		componentPoint.colorfield.default = color;
	        }*/
	    }
    });
    //console.log(componentPoint.colorfield);
  },
  methods: {
  	
  },
  beforeDestroy: function() {
    jQuery(this.$el).wpColorPicker('destroy');
  }
});
Vue.component('textarea-wysiwyg', {
  template: '#fields-textarea-template',
  props: [ 'defaultText','fieldindex' ],
  mounted: function() {
  	var componentPoint = this;
	var useEditor = wp.oldEditor;
 	if(!useEditor){
    	useEditor = wp.editor;
  	}
	var textareaId = jQuery(this.$el).find('textarea').attr('id');
	if(useEditor){
		useEditor.initialize(textareaId, {
									tinymce: true,
									quicktags: true,
								})
		var editor = window.tinymce.get( textareaId );
		editor.on( 'blur hide', function onEditorBlur() {
				componentPoint.defaultText.default = useEditor.getContent(textareaId);
		});
		jQuery("#"+textareaId).on('change', function(){
      	componentPoint.defaultText.default = useEditor.getContent(textareaId);
    	});
	}
  	
  },
  
  beforeDestroy: function() {
  	var componentPoint = this;
  	var useEditor = wp.oldEditor;
 	if(!useEditor){
    	useEditor = wp.editor;
  	}
  	if(useEditor){
  		var textareaId = jQuery(this.$el).find('textarea').attr('id');
  		useEditor.remove(textareaId);
	}
  }
});



var app = new Vue({
  el: '#ampForWpPageBuilder_container',
  http: {
            emulateJSON: true,
            emulateHTTP: true
    },
  data: {
    message: '',
    loadingPagebuilder: 'display: block;',
    startPagebuilder: amppb_panel_options.startPagebuilder,
    checkedPageBuilder: amppb_panel_options.checkedPageBuilder,
    showModal: false,
    //Module data
    showmoduleModal: false,
    editModuleTempTitle: false,
    stopModuleModalClose:false,
    modalcontent: [],
    modalType:'',//module/rowSetting
    modalTypeData: {},
    filteredList: [],

    rowOverDrop:false,
    modulesOverDrop:false,
    rowdrag: false,
    moduledrag: false,
    pagebuilderContent: ' <p class="dummy amppb-rows-message">Welcome to AMP Page Builder.</p>',
    mainContent: {},
    mainContent_Save: JSON.stringify(this.mainContent),
  },
  methods: {
  		//module sort
  		modulesort:function(evt,originalEvent){
  			if(evt && evt.type=='end'){
  				//Information where element has dropped
  				var module_id = evt.clone.getAttribute('data-module_id');//Dragged module
				
				//to Data
				var module_sorted_row_id = parseInt(evt.to.getAttribute('data-rowid'));
				var module_sorted_row_cellid = parseInt(evt.to.getAttribute('data-cellid'));
				
				//Element which we have moves
  				
  				this.mainContent.rows.forEach(function(data,key){
					Vue.set(data, 'index', parseInt(key)+1);
					if(data.cells==2){
						if(data.cell_left.length>0){
							data.cell_left.forEach(function(module,modKey){
								Vue.set(module, 'index', parseInt(modKey)+1);
								if(module_id==module.cell_id){
									Vue.set(module, 'container_id', module_sorted_row_id);
									Vue.set(module, 'cell_container',module_sorted_row_cellid);
								}
							});
						}
						if(data.cell_right.length>0){
							data.cell_right.forEach(function(module,modKey){
								Vue.set(module, 'index', parseInt(modKey)+1);
								if(module_id==module.cell_id){
									Vue.set(module, 'container_id', module_sorted_row_id);
									Vue.set(module, 'cell_container',module_sorted_row_cellid);
								}
							});
						}
					}else{
						data.cell_data.forEach(function(module,modKey){
							Vue.set(module, 'index', parseInt(modKey)+1);
							if(module_id==module.cell_id){
								Vue.set(module, 'container_id', module_sorted_row_id);
								Vue.set(module, 'cell_container',module_sorted_row_cellid);
							}
						});
					}
					
  				});
  				var isModuleDragDrop = true;
				this.call_default_functions(isModuleDragDrop);
				//console.log(this.mainContent);
  			}
  			return true;
  		},
  		//row Sorting
  		rows_moved: function(evt){
  			if(evt && evt.type=='end'){
				this.mainContent.rows.forEach(function(data,key){
					Vue.set(data, 'index', parseInt(key)+1);
						data.cell_data.forEach(function(module,modKey){
							Vue.set(module, 'index', parseInt(modKey)+1);
						});
				});
			}
			this.call_default_functions();
			return true;
			//return true;
  		},

  		reomve_row: function(key){
			var response = confirm("Do you want to delete Row? ");
			if(response){
				this.mainContent.rows.splice(key, 1);
				this.call_default_functions();
			}
		},
		duplicateRow: function(){
			var currentRowId = event.currentTarget.getAttribute('data-rowid');
			var duplicateRowData = {}; var rowKeyValue = '';
			app.mainContent.rows.forEach(function(rowData, rowKey){
				if(rowData.id == currentRowId){
					var rowsId = parseInt(app.mainContent.totalrows);
					duplicateRowData = JSON.parse(JSON.stringify(rowData));
					duplicateRowData.id = rowsId;
					rowKeyValue = rowKey;
					app.mainContent.totalrows = rowsId+1;
				}
			});
			var sampleSelldata = duplicateRowData.cell_data;//_.clone(duplicateRowData.cell_data);
			sampleSelldata.forEach(function(moduleData, moduleKey){
				var modulesid = parseInt(app.mainContent.totalmodules);
				duplicateRowData.cell_data[moduleKey].cell_id = modulesid;
				duplicateRowData.cell_data[moduleKey].container_id = duplicateRowData.id;
				app.mainContent.totalmodules = modulesid+1;
			});
			duplicateRowData.cell_data = sampleSelldata;


			// console.log(duplicateRowData);
			if(rowKeyValue>0){
				app.mainContent.rows.splice(rowKeyValue, 0,duplicateRowData);
			}else{
				app.mainContent.rows.push(duplicateRowData);	
			}
			app.re_process_rawdata();
			//
		},
  		//Rows drop details
		handleDrop: function(columnData,Events) {
			if(typeof columnData=='undefined' || typeof columnData.type=='undefined'){
				return false;
			}
			if(columnData.type!="column"){
				if(columnData.type=='module' && this.mainContent.rows.length==0){
					alert("First drop columns");
				}
				return false;
			}
			this.dropover = false;
			var containerid = parseInt(this.mainContent.totalrows);
			
			var noOfCell = parseInt(columnData['value'].replace('col-',""));
			var rowSettingJson = columnData['rowSettingJson'];
			var newRow   = {
							'id':containerid,
							'index':containerid,
							'cells': noOfCell,
							'cell_data': [],
							'data':{}
							};
			if(rowSettingJson.fields.length > 0){
				rowSettingJson.fields.forEach(function(module,key){
					newRow['data'][module.name] = module.default;
				});
			}
			if(noOfCell==2){
				newRow.cell_left = [];
				newRow.cell_right = [];
			}
			this.mainContent.totalrows = containerid+1;
			this.mainContent.rows.push(newRow);
			this.call_default_functions();
		},
		handleModuleDrop: function(moduleData,Events) {
			this.dropover = false;
			if(typeof moduleData=='undefined' || typeof moduleData.type=='undefined'){
				return false;
			}
			var moduletype = moduleData['type'];
			if(moduletype!="module"){
				return false;
			}
			var modulename = moduleData['modulename'];
			moduleJson = moduleData['moduleJson'];
			element = Events.currentTarget;
			var modulesid = parseInt(this.mainContent.totalmodules);

			var rowid = parseInt( element.getAttribute('data-rowid') );
			var cellid = parseInt( element.getAttribute('data-cellid') );

			this.mainContent.rows.forEach(function(columnVal,k){
				if(columnVal.id==rowid){
					moduleIndex = columnVal.cell_data.length;
					if(moduleIndex==0){ moduleIndex=1; }
					var cellData = {
							'cell_id'	: modulesid,
							'index'		: moduleIndex,
							'type'		: modulename,
							'container_id': rowid,
							'cell_container': cellid,
							'cell_identity_name': modulesid,
							};

						if(moduleJson.fields.length > 0){
							moduleJson.fields.forEach(function(module,key){
								cellData[module.name] = module.default;
							});
						}
						if(moduleJson.repeater && moduleJson.repeater.fields.length > 0){
							var repeaterArray = {};
							moduleJson.repeater.fields.forEach(function(module,key){
								repeaterArray[module.name+'_0'] = module.default;
							});
							cellData.repeater = [];
							cellData.repeater.push(repeaterArray);
						}
						columnVal.cell_data.push(cellData);
						if(cellid==1){
							if(!columnVal.cell_left){
								columnVal.cell_left = [];
							}
							columnVal.cell_left.push(cellData);
						}
						if(cellid==2){
							if(!columnVal.cell_right){
								columnVal.cell_right = [];
							}
							columnVal.cell_right.push(cellData);
						}
				}
			});
			this.mainContent.totalmodules = modulesid+1;
			var isModuleDragDrop = true;
			this.call_default_functions(isModuleDragDrop);
		},
		showRowSettingPopUp: function(event){
			openModulePopup(event,'rowSetting');
		},
		setcontentData: function(){
  			this.mainContent_Save = JSON.stringify(this.mainContent);
  		},
		re_process_rawdata: function(isModuleDragDrop="false"){
			this.mainContent.rows.sort(function(a, b){
					var a1= a.index, b1= b.index;
					if(a1== b1) return 0;
					return a1> b1? 1: -1;
				});
			this.mainContent.rows.forEach(function(row,key){
				if(row.cells && row.cells=="2"){
					
					if(isModuleDragDrop===true){
						//console.log("row moved "+isModuleDragDrop)
						row.cell_data = row.cell_left.concat(row.cell_right)
					}else {//if(!row.cell_left && !row.cell_right)
						row.cell_left  = [];
						row.cell_right = [];
						row.cell_data.forEach(function(module,k){
							if(parseInt(module.cell_container)==1){
								row.cell_left.push(module);
							}else if(parseInt(module.cell_container)==2){
								row.cell_right.push(module);
							}
						});
					}
					if(row.cell_data.length>0){
						row.cell_data.sort(function(a, b){
							var a1= a.index, b1= b.index;
							if(a1== b1) return 0;
							return a1> b1? 1: -1;
						});
					}
					if(row.cell_left.length>0){
						row.cell_left.sort(function(a, b){
							var a1= a.index, b1= b.index;
							if(a1== b1) return 0;
							return a1> b1? 1: -1;
						});
					}
					if(row.cell_right.length>0){
						row.cell_right.sort(function(a, b){
							var a1= a.index, b1= b.index;
							if(a1== b1) return 0;
							return a1> b1? 1: -1;
						});
					}
				}
			});//loop closed
			//setting data Compatible
			if(!this.mainContent.settingdata){
				this.mainContent.settingdata = {
					front_class: '',
					front_css: ''
				};
			}
			
		},
		call_default_functions:function(isModuleDragDrop){
			this.re_process_rawdata(isModuleDragDrop);
			this.setcontentData();
			//Vue.$forceUpdate();
			//this.mainContent.$forceUpdate()
		},
		amppb_startFunction: function(event){
			var postId = event.target.getAttribute('data-postId');
			this.$http.post(amppb_panel_options.ajaxUrl+'?action=enable_amp_pagebuilder&verify_nonce='+amppb_panel_options.secure_nonce, 
				{
					postId
				}
				,{
					headers:{
						responseType:'json'
					},
					responseType:'json',
					emulateHTTP:true,
					emulateJSON:true,
				}
			).then(function(response){
				response =response.body;
				 if(response.status === 200) {
				 	this.startPagebuilder = 1;
				 	this.checkedPageBuilder = 'yes';
				 	this.ampforwp_icon_list();
				 }
				
			},
			//errorCallback
			function(){
				alert('connection not establish');
			});
		},
		ampforwp_icon_list: function(){
			if(this.startPagebuilder==1){

				this.$http.post(amppb_panel_options.ajaxUrl+'?action=ampforwp_icons_list_format&verify_nonce='+amppb_panel_options.secure_nonce, 
					{}
					,{
						headers:{
							responseType:'json'
						},
						responseType:'json',
						emulateHTTP:true,
						emulateJSON:true,
					}
				).then(function(response){
					response =response.body;
					 if(response.success === true) {
					 	this.filteredList = response.data;
					 }
					
				},
				//errorCallback
				function(){
					alert('connection not establish');
				});
			}
		}

	},/*module close*/
	beforeMount:function(){
		this.ampforwp_icon_list();
	}
});

app.mainContent = amppb_data;
app.call_default_functions();