<?php $currency_symbol = $global_config['currency_symbol'];?>
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=empty($branch_id) ? 'active' : ''?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('fees_group') . " " . translate('list'); ?></a>
			</li>
<?php if (get_permission('fees_group', 'is_add')){ ?>
			<li class="<?=!empty($branch_id) ? 'active' : ''?>">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('add') . " " . translate('fees_group'); ?></a>
			</li>
<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=empty($branch_id) ? 'active' : ''?>">
				<div class="mb-md">
					<div class="export_title">Fees Type List</div>
					<table class="table table-bordered table-hover table-condensed table-export">
						<thead>
							<tr>
								<th width="50"><?php echo translate('sl'); ?></th>
							<?php if (is_superadmin_loggedin()): ?>
								<th><?=translate('branch')?></th>
							<?php endif; ?>
								<th><?=translate('name')?></th>
								<th><?=translate('Total_Fess')?></th>
								<th><?=translate('Installment')?></th>
								<th><?=translate('Due_date')?></th>
								<th><?=translate('description')?></th>
								<th><?=translate('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; foreach ($categorylist as $row): ?>
							<tr>
								<td><?php echo $count++; ?></td>
							<?php if (is_superadmin_loggedin()): ?>
								<td><?php echo get_type_name_by_id('branch', $row['branch_id']);?></td>
							<?php endif; ?>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['total_fees']?></td>
								<td><?php echo $row['amount'].'</br>'?></td>
								<td><?php echo $row['due_date']; ?></td>
								<td><?php echo $row['description']; ?></td>
								<td>
									<?php if (get_permission('fees_group', 'is_edit')): ?>
										<a href="<?php echo base_url('fees/group_edit/' . $row['id']); ?>" class="btn btn-circle btn-default icon"
										data-toggle="tooltip" data-original-title="<?php echo translate('edit'); ?>"> 
											<i class="fas fa-pen-nib"></i>
										</a>
									<?php endif; if (get_permission('fees_group', 'is_delete')): ?>
										<?php echo btn_delete('fees/group_delete/' . $row['id']); ?>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?php if (get_permission('fees_group', 'is_add')){ ?>
			<div class="tab-pane <?=!empty($branch_id) ? 'active' : ''?>" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'frm-submit')); ?>
					<div class="form-horizontal form-bordered mb-lg">
					<?php if (is_superadmin_loggedin() ): ?>
						<div class="form-group">
							<label class="control-label col-md-3"><?=translate('branch')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
									$arrayBranch = $this->app_lib->getSelectList('branch');
									echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id', $branch_id), "class='form-control' id='branch_id'
									data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
					<?php endif; ?>
					
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('group_name')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="<?=set_value('name')?>" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('Enter Fees Amount')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="total_fees" id="total_fees"/>
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('Installment')?> <span class="required">*</span></label>
							<div class="col-md-6">
                               <select name="installment" id="installment" class="form-control" onchange="myFunction()">
							      <option value="">Select Option</option>
								  <option value="12">Monthly</option>
								  <option value="4">quarly</option>
								  <option value="1">yearly</option>
								  <option value="2">Halfly</option>
							   
								</select>
    						</div>
						</div>
						
						
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('description')?></label>
							<div class="col-md-6 mb-md">
								<textarea class="form-control" id="description" name="description" placeholder="" rows="3" ></textarea>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="tableID">
							<thead>
								<th><div id="header1"></th>
								<th><div id="header2"></th>
								<th><div id="header3"></th>
					        </thead>
							<tbody>
								<tr>
									<td class="checked-area" width="60">
										<div class="checkbox-replace">
											   <div id="div1">
										</div>
									</td>
									<td class="min-w-sm">
										<div class="form-group">
											<div id="div2">
										</div>
									</td>
									<td class="min-w-lg">
										<div class="form-group">
									    	<div id="div3">
									    </div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-2 col-md-offset-10">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close(); ?>
			</div>
<?php } ?>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$('#branch_id').on('change', function(){
			var branchID = $(this).val();
			window.location.href = base_url + 'fees/group/' + branchID;
		});
	});
	
</script>
<script>
function myFunction() {
		var x=document.getElementById("installment").value;
		var total_fees=document.getElementById("total_fees").value;
		var answer = total_fees / x;

		if(x!=0){
                 var installment1='';
                 var installment2='';
                 var installment3='';
				 for (let i = 1; i <= x; i++) {
				installment1 += '<input type="text" name="no[]" value='+i+' class="form-control"> <br>';
				installment2 +='<input type="date" class="form-control" name="due_date[]" /><br>'; 
				installment3 +='<input type="text" class="form-control" name="amount[]" value='+parseInt(answer)+'><br>'; 
      			
			}
			document.getElementById("header1").innerHTML = '<th>fees_type</th>';
			document.getElementById("header2").innerHTML = '<th>due_date </th>';
			document.getElementById("header3").innerHTML = '<th>amount</th>';


				  document.getElementById("div1").innerHTML = installment1;
				  document.getElementById("div2").innerHTML = installment2;
				  document.getElementById("div3").innerHTML = installment3;

			}
}
</script>
