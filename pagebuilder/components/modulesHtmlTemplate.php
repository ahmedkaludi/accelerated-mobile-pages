
<script type="text/x-template" id="module-data-template">
		<?php $i=0;
    		foreach ($moduleTemplate as $key => $module) {
    			unset($module['front_template']);
                unset($module['front_css']);
                if(isset($module['front_loop_content'])){
                    unset($module['front_loop_content']);
                }
                if(isset($module['front_common_css'])){
                    unset($module['front_common_css']);
                }
                if(isset($module['repeater'])){
    			    unset($module['repeater']['front_template']);
                }
    			$conditioner = 'v-else-if';
    			if($i==0){
    				$conditioner = 'v-if';
    			}
    			$i++;
				$moduleJson = array('type'=> 'module','moduleDraggable'=>false ,'modulename'=>strtolower($module['name']),'moduleJson'=>$module);
    			echo '
    				<div 
    					'.$conditioner.'="cell.type==\''.strtolower($module['name']).'\'
    					 &&
    					  cellcontainer==cell.cell_container"
    					 class="amp_mod amppb-module amppb-module-'.strtolower($module['name']).'"
                          :data-module_id="cell.cell_id"
					>

		        		<span class="module_label">'.$module['label'].'</span>
		        		<span class="amppb-setting-right">
			        		<label  @click="showModulePopUp($event)" class="link" title="'.$module['label'].'" data-popupContent=\''.json_encode($module).'\'
                                :data-module_id="cell.cell_id"
                                :data-container_id="cell.container_id"
                            >
			        			<span class="dashicons dashicons-admin-generic"></span>
			        		</label>
		        		</span>
		        	</div>
    					';
    		}
    ?>
 </script>