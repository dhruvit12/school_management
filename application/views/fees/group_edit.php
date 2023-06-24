<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?=base_url('fees/group')?>"><i class="fas fa-list-ul"></i> <?php echo translate('fees_group') . " " . translate('list'); ?></a>
			</li>
			<li class="active">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('edit') . " " . translate('fees_group'); ?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'frm-submit')); ?>
				<input type="hidden" name="group_id" value="<?=$group['id']?>">
					<div class="form-horizontal form-bordered mb-lg">
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo translate('group_name'); ?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="<?=$group['name']?>" autocomplete="off" />
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('Enter Fees Amount')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="total_fees" id="total_fees" value="<?=$group['total_fees']?>"/>
								<span class="error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('Installment')?> <span class="required">*</span></label>
							<div class="col-md-6">
                               <select name="installment" id="installment" class="form-control" onchange="myFunction()">
							      
								  <option value="12"<?php if($group['installment'] == '12'){ echo "selected";}?>>Monthly</option>
								  <option value="4" <?php if($group['installment'] == '4'){ echo "selected";}?>>quarly</option>
								  <option value="1" <?php if($group['installment'] == '1'){ echo "selected";}?>>yearly</option>
								  <option value="2" <?php if($group['installment'] == '2'){ echo "selected";}?>>Halfly</option>
							   
								</select>
    						</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label"><?php echo translate('description'); ?></label>
							<div class="col-md-6 mb-md">
								<textarea class="form-control" id="description" name="description" placeholder="" rows="3" ><?=$group['description']?></textarea>
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
									<i class="fas fa-plus-circle"></i> <?php echo translate('update'); ?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
<?php $array = $group['due_date'];?>
<script>
	$(document).ready(function(){
		myFunction();
});
</script>
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
				installment2 +='<input type="date" class="form-control" name="due_date[]"  value='+parseInt(answer)+'/><br>'; 
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
