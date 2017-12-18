
if(jQuery('#ampForWpPageBuilder_container').css('display') !='none'){
Vue.component('amp-pagebuilder-modal', {
  template: '#amp-pagebuilder-modal-template',
  props: ['dataContent'],
  data: function(){
  	return {
  		currentLayoutData: app.mainContent,
  		modalCrrentTab: 'customize',
  		ajaxurl: amppb_panel_options.ajaxUrl,
  		save_layout:{name:'',
  					url:''
  					},
  		showsavedLayouts :amppb_panel_options.savedLayouts,
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
		app.mainContent = currentLayoutData;
		this.hidePageBuilderPopUp();
	},
	savePagebuildercustomLayout: function(event){
		if(!this.save_layout.name && this.save_layout.name==""){
			alert("Please enter name of layout");
			return false;
		}
		var saveLayoutData = {
							action: 'amppb_save_layout_data',
							layoutname:this.save_layout.name,
							layouturl: this.save_layout.url,
							layoutdata: JSON.stringify(this.currentLayoutData)
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
		var filename  = event.target.name;
		var files = event.target.files;
		var fileCount = event.target.files.length;
		if(fileCount>0){
			var rawFile = files[0];
			rawFile.onreadystatechange = function()
		    {
		        if(rawFile.readyState === 4)
		        {
		            if(rawFile.status === 200 || rawFile.status == 0)
		            {
		              var allText = rawFile.responseText;
		              alert(allText);
		            }
		        }
		    }
		}//if closed
		
	
	},
	importLayout: function(event){
		var response = confirm("Replace current layout. \n Do you want to import new layout?");
		if(response){
			app.mainContent = JSON.parse(event.target.getAttribute('data-layout'));
			app.call_default_functions();
		}
		this.hidePageBuilderPopUp();
	},
  }
})
Vue.component('amp-pagebuilder-module-modal', {
  template: '#amp-pagebuilder-module-modal-template',
  props: [],
  data: function(){
  	return {
	  	modalcontent: app.modalcontent
	  };
  },
  methods:{
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
	saveModulePopupdata: function(fields){
		//Save Values to main content
		app.mainContent.rows.forEach(function(rowData, rowKey){
			if(rowData.id==app.modalTypeData.containerId){
				if(app.modalType=='module'){
					rowData.cell_data.forEach(function(moduleData, moduleKey){
						if(moduleData.cell_id==app.modalTypeData.moduleId){
							fields.forEach(function(fieldData,fieldKey){
								Vue.set( moduleData, fieldData.name, fieldData.default );
							})
						}
					});
				}else if(app.modalType=='rowSetting'){
					var a = {};
					fields.forEach(function(fieldData,fieldKey){
						a[fieldData.name] = fieldData.default
					});
					
					Vue.set( rowData, 'data', a );
				}
			}
		});
		app.call_default_functions();
		this.hideModulePopUp();
		return true;
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
	}
});

function openModulePopup(event,type){
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
						app.modalcontent.fields.forEach(function(fieldData,fieldKey){
							if(moduleData[fieldData.name] && moduleData[fieldData.name]!=''){
								Vue.set( fieldData, 
										'default', 
										moduleData[fieldData.name] );
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
	
	app.showmoduleModal = true;
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
	props: ['field', 'fieldkey', 'defaulttab', 'completeFields'],
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
	  		//this.filteredList = ;
	  		
	  		this.callChangeEnvent();
	  

	  })
	},
	computed: {
		filteredIcons: function(){
			var self=this;
       		return this.filteredList.filter(function(icon){return icon.name.toLowerCase().indexOf(self.iconSearch.toLowerCase())>=0;});
		}
	},
	methods:{
		selectimages:function(field,event){
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
                  //field.default = ids;
                 
                  componentPointer.refresh_image(ids,currentSelectfield,field);
               });
			image_frame.on('open',function() {
	            // On open, get the id from the hidden input
	            // and select the appropiate images in the media manager
	            var selection =  image_frame.state().get('selection');
	            /*ids = currentSelectfield.parents('.form-control').find('input[type=hidden]').val().split(',');
	            ids.forEach(function(id) {
	              attachment = wp.media.attachment(id);
	              attachment.fetch();
	              selection.add( attachment ? [ attachment ] : [] );
	            });*/

	          });
	        image_frame.open();

		},
		refresh_image: function(the_id,currentSelectfield,field){
		        this.$http.post(amppb_panel_options.ajaxUrl+'?action=ampforwp_get_image&id='+the_id, 
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
						 	if(currentSelectfield.getAttribute("data-imageselactor")=='multiple'){
						 		var imageList = [];
						 		response.data.forEach(function(imageDetails,key){
						 			console.log(imageDetails);
							 		imageList.push(imageDetails.detail[0]);
							 	});
							 	Vue.set(field,'default',imageList);
							}else{
								
								currentSelectfield.nextElementSibling.setAttribute('src',response.data.detail[0]);
								field.default = response.data.detail[0];
								console.log(app.modalcontent.fields)
								app.modalcontent.fields.forEach(function(data,key){
									if(data.name=='image_height'){
										data.default = response.data.detail[2];
									}else if(data.name=="image_width"){
										data.default = response.data.detail[1];
									}
								})
								
							}
						 }
						
					},
					 //errorCallback
					 function(){
					 	alert('connection not establish');
					 });
		       
		},
		iconSelected: function(icon, field){
			this.field.default = icon.name;
		},
		callChangeEnvent: function(field){
			//get All fields with require conditions
			jQuery(this.$el).parents('div.modal-body').find('[data-require]').each(function(e,v){
				var fieldPointer = jQuery(this)
				var requiredData = jQuery(this).attr('data-require');
				
				if(requiredData!=''){
					requiredData = JSON.parse( requiredData );
					//Show or hide Based on condition
					jQuery.each(requiredData,function(key,selectedValue){
						var fieldType = jQuery('#'+key).attr('data-type');
						switch(fieldType){
							case 'text':
								var currentValue = jQuery('#'+key).find('input[type=text]').val();
								if(currentValue==selectedValue){
									fieldPointer.show();
								}else{
									fieldPointer.hide();
								}
							break;
							case 'number':
								var currentValue = jQuery('#'+key).find('input[type=number]').val();
								if(currentValue==selectedValue){
									fieldPointer.show();
								}else{
									fieldPointer.hide();
								}
							break;
							case 'textarea':
								var currentValue = jQuery('#'+key).find('textarea').val();
								if(currentValue==selectedValue){
									fieldPointer.show();
								}else{
									fieldPointer.hide();
								}
							break;
							case 'text-editor':
								var currentValue = jQuery('#'+key).find('textarea').val();
								if(currentValue==selectedValue){
									fieldPointer.show();
								}else{
									fieldPointer.hide();
								}
							break;
							case 'select':
								var currentValue = jQuery('#'+key).find('select').val();
								if(currentValue==selectedValue){
									fieldPointer.show();
								}else{
									fieldPointer.hide();
								}
							break;
							case 'checkbox':
								var allCheckbox = jQuery('#'+key).find('input[type=checkbox]');
								allCheckbox.each(function(k,v){
									if(jQuery(this).is(":checked") && jQuery(this).val()==selectedValue){
										fieldPointer.show();
										return false;
									}else{
										fieldPointer.hide();
									}
								});
								
							break;
							case 'radio':
								var currentValue = jQuery('#'+key).find('input[type=radio]:checked').val();
								if(currentValue==selectedValue){
									fieldPointer.show();
								}else{
									fieldPointer.hide();
								}
							break;
							case 'spacing':
							break;
							case 'upload':
							break;
							case 'color-picker':
							break;
							case 'icon-selector':
							break;
							case 'gradient-selector':
							break;
						}
					});
				}
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
   	console.log(componentPoint.colorfield);
   	console.log(jQuery(this.$el).find('input'));
    jQuery(this.$el).parent('div').find('input').wpColorPicker({
    	change: function(event, ui) {
	        var element = event.target;
        	var color = ui.color.toString();
        	componentPoint.colorfield.default = color;
        	
	    }
    });
  },
  methods: {
  	selectedColorPicker: function(){
  		alert("called")
  	}
  },
  beforeDestroy: function() {
    jQuery(this.$el).wpColorPicker('destroy');
  }
});
Vue.component('textarea-wysiwyg', {
  template: '<textarea></textarea>',
   props: [ 'defaultText' ],
  
});



var app = new Vue({
  el: '#ampForWpPageBuilder_container',
  http: {
            emulateJSON: true,
            emulateHTTP: true
    },
  data: {
    message: 'Hello AMP Page builder वासियों',
    startPagebuilder: amppb_panel_options.startPagebuilder,
    showModal: false,
    //Module data
    showmoduleModal: false,
    modalcontent: [],
    modalType:'',//module/rowSetting
    modalTypeData: {},
    filteredList: [],

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
  		//Rows drop details
		handleDrop: function(columnData,Events) {
			if(typeof columnData=='undefined' || typeof columnData.type=='undefined'){
				return false;
			}
			if(columnData.type!="column"){
				return false;
			}
			this.dropover = false;
			var containerid = parseInt(this.mainContent.totalrows);
			
			var noOfCell = parseInt(columnData['value'].replace('col-',""));
			var newRow   = {
							'id':containerid,
							'index':containerid,
							'cells': noOfCell,
							'cell_data': [],
							'data':{}
							};
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
							};

						if(moduleJson.fields.length > 0){
							moduleJson.fields.forEach(function(module,key){
								cellData[module.name] = module.default;
							});
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
						console.log("row moved "+isModuleDragDrop)
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
			this.$http.post(amppb_panel_options.ajaxUrl+'?action=enable_amp_pagebuilder', 
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
			 }
			
		},
		//errorCallback
		function(){
			alert('connection not establish');
		});
		}

	},/*module close*/
	beforeMount:function(){
		this.$http.post(amppb_panel_options.ajaxUrl+'?action=ampforwp_icons_list_format', 
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
});

app.mainContent = amppb_data;
app.call_default_functions();
}