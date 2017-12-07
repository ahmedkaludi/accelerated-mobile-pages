
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
					fields.forEach(function(fieldData,fieldKey){
						if(rowData.data){
							rowData.data[fieldData.name] = fieldData.default;
						}
						Vue.set( rowData.data, fieldData.name, fieldData.default );
					});
				}
			}
		});
		this.hideModulePopUp();
		return false;
	//	app.call_default_functions();
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
										decodeURIComponent(moduleData[fieldData.name]) );
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
			this.buildEditor();
		});
	},
	methods:{
		buildEditor:function() {
				var id  = 'hello_editor';

				// Abort building if the textarea is gone, likely due to the widget having been deleted entirely.
				if ( ! document.getElementById( id ) ) {
					return;
				}

				// The user has disabled TinyMCE.
				if ( typeof window.tinymce === 'undefined' ) {
					wp.ampeditor.initialize( id, {
						quicktags: true
					});

					return;
				}

				// Destroy any existing editor so that it can be re-initialized after a widget-updated event.
				if ( tinymce.get( id ) ) {
					restoreTextMode = tinymce.get( id ).isHidden();
					wp.editor.remove( id );
				}

				wp.editor.initialize( id, {
					tinymce: {
						wpautop: true
					},
					quicktags: true
				});

				/**
				 * Show a pointer, focus on dismiss, and speak the contents for a11y.
				 *
				 * @param {jQuery} pointerElement Pointer element.
				 * @returns {void}
				 */
				showPointerElement = function( pointerElement ) {
					pointerElement.show();
					pointerElement.find( '.close' ).focus();
					wp.a11y.speak( pointerElement.find( 'h3, p' ).map( function() {
						return $( this ).text();
					} ).get().join( '\n\n' ) );
				};

				editor = window.tinymce.get( id );
				if ( ! editor ) {
					throw new Error( 'Failed to initialize editor' );
				}
				onInit = function() {

					// When a widget is moved in the DOM the dynamically-created TinyMCE iframe will be destroyed and has to be re-built.
					$( editor.getWin() ).on( 'unload', function() {
						_.defer( buildEditor );
					});

					// If a prior mce instance was replaced, and it was in text mode, toggle to text mode.
					if ( restoreTextMode ) {
						switchEditors.go( id, 'html' );
					}

					// Show the pointer.
					$( '#' + id + '-html' ).on( 'click', function() {
						control.pasteHtmlPointer.hide(); // Hide the HTML pasting pointer.

						if ( -1 !== component.dismissedPointers.indexOf( 'text_widget_custom_html' ) ) {
							return;
						}
						showPointerElement( control.customHtmlWidgetPointer );
					});

					// Hide the pointer when switching tabs.
					$( '#' + id + '-tmce' ).on( 'click', function() {
						control.customHtmlWidgetPointer.hide();
					});

					// Show pointer when pasting HTML.
					editor.on( 'pastepreprocess', function( event ) {
						var content = event.content;
						if ( -1 !== component.dismissedPointers.indexOf( 'text_widget_paste_html' ) || ! content || ! /&lt;\w+.*?&gt;/.test( content ) ) {
							return;
						}

						// Show the pointer after a slight delay so the user sees what they pasted.
						_.delay( function() {
							showPointerElement( control.pasteHtmlPointer );
						}, 250 );
					});
				};

				if ( editor.initialized ) {
					onInit();
				} else {
					editor.on( 'init', onInit );
				}

				control.editorFocused = false;

				editor.on( 'focus', function onEditorFocus() {
					control.editorFocused = true;
				});
				editor.on( 'paste', function onEditorPaste() {
					editor.setDirty( true ); // Because pasting doesn't currently set the dirty state.
					triggerChangeIfDirty();
				});
				editor.on( 'NodeChange', function onNodeChange() {
					needsTextareaChangeTrigger = true;
				});
				editor.on( 'NodeChange', _.debounce( triggerChangeIfDirty, changeDebounceDelay ) );
				editor.on( 'blur hide', function onEditorBlur() {
					control.editorFocused = false;
					triggerChangeIfDirty();
				});

				control.editor = editor;
			}
	}
})

Vue.component('fields-data',{
	template: '#fields-data-template',
	props: ['field', 'fieldkey', 'defaulttab'],
	data:function(){
		return {
			iconSearch:'',
			text_editor_wysiwig: '',
			text_color_picker: '',
			filteredList : [],
			openIconOptions: false
		};
	},
	mounted: function () {//On ready State for component
	  this.$nextTick(function () {
	  		var self = this;
	  		this.filteredList = [{name:'3d_rotation'},{name:'ac_unit'},{name:'alarm'},{name:'access_alarms'},{name:'schedule'},{name:'accessibility'},{name:'accessible'},{name:'account_balance'},{name:'account_balance_wallet'},{name:'account_box'},{name:'account_circle'},{name:'add'},];
	  		console.log(this.el)
	  	//jQuery(this.el).find('input#color-picker-box').wpColorPicker();

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
						 		/*
								jQuery(currentSelectfield).parents('.form-control').find('.sample-gallery-template').html("");
								var imageSrc = '';
								jQuery.each(response.data, function(keys,imageValue){
									//console.log(imageValue.image);
									jQuery(currentSelectfield).parents('.form-control').find('.sample-gallery-template').append(imageValue.image);
									jQuery(currentSelectfield).parents('.form-control').find('.sample-gallery-template').find('img:last').attr("width",100).attr("height",100);
									imageSrc += imageValue.detail[0]+",";
								});
								jQuery(currentSelectfield).parents('.form-control').find('input[type=hidden]').val(imageSrc)*/
							}else{
								
								currentSelectfield.nextElementSibling.setAttribute('src',response.data.detail[0]);
								field.default = response.data.detail[0];
								console.log(app.modalcontent.fields)
								app.modalcontent.fields.forEach(function(data,key){
									if(data.name=='image_height'){
										data.default = response.data.detail[1];
									}else if(data.name=="image_width"){
										data.default = response.data.detail[2];
									}
								})
								/*currentSelectfield.parents('.form-control').find('#ampforwp-preview-image').replaceWith( response.data.image ).attr('id','ampforwp-preview-image');
								var src = jQuery(currentSelectfield).parents('.form-control').find('#ampforwp-preview-image').attr('src');
								jQuery(currentSelectfield).parents('.form-control').find('input[type=hidden]').val(src);*/
							}
						 }
						
					},
					 //errorCallback
					 function(){
					 	alert('connection not establish');
					 });

		       
		},
		selectIcon: function(icon, field){
			field.default = icon.name;
		}
	}
});

Vue.component('color-picker', {
  template: '<input/>',
   props: [ 'defaultColor' ],
  mounted: function() {
    jQuery(this.$el).wpColorPicker();
  },
  beforeDestroy: function() {
    jQuery(this.$el).wpColorPicker('hide').dwpColorPickeratepicker('destroy');
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
    showModal: false,
    //Module data
    showmoduleModal: false,
    modalcontent: [],
    modalType:'',//module/rowSetting
    modalTypeData: {},

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
				this.call_default_functions();
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
			this.call_default_functions();

			
		},
		showRowSettingPopUp: function(event){
			openModulePopup(event,'rowSetting');
		},
		setcontentData: function(){
  			this.mainContent_Save = JSON.stringify(this.mainContent);
  		},
		re_process_rawdata: function(){
			this.mainContent.rows.sort(function(a, b){
					var a1= a.index, b1= b.index;
					if(a1== b1) return 0;
					return a1> b1? 1: -1;
				});
			this.mainContent.rows.forEach(function(row,key){
				if(row.cells && row.cells=="2"){
					
					if(!row.cell_left && !row.cell_right){
						row.cell_left  = [];
						row.cell_right = [];
						row.cell_data.forEach(function(module,k){
							if(parseInt(module.cell_container)==1){
								row.cell_left = module;
							}else if(parseInt(module.cell_container)==2){
								row.cell_right = module;
							}
						});
					}else{
						row.cell_data = row.cell_left.concat(row.cell_right)
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
		call_default_functions:function(){
			this.re_process_rawdata();
			this.setcontentData();
			//Vue.$forceUpdate();
			//this.mainContent.$forceUpdate()
		},

	}/*module close*/
});

app.mainContent = amppb_data;
app.call_default_functions();
