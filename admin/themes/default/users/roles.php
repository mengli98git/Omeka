<?php head();?>
<?php common('users-nav'); ?>

<script type="text/javascript" charset="utf-8">
	function getRoleRuleForm(role) {
		var url = '<?php echo uri('users/rulesForm'); ?>?role='+role.value;
		new Ajax.Request(url, {
			method: 'post',
			onSuccess: function(req) {
				$('rulesForm').innerHTML = req.responseText;
			}
		});
	}
	
	Event.observe(window,'load',function(){
		Event.observe($('alter_role'),'change',function(event) {
			getRoleRuleForm(event.target);
		});
	});
</script>
<div id="primary">
<div id="message"></div>

<h1>Available Roles</h1>

<?php foreach( $roles as $role ): ?>
	<dl class="user<?php echo $role; ?>">
	<dt><?php echo $role; ?></dt>
		<?php 
			$roleRules = $acl->getRoleAssignedRules($role); 
			
		?>
		<?php if(!empty($roleRules)): ?>
		<dd>
			<ul>
		<?php foreach( $roleRules as $k => $roleRule ): ?>
			<li><div class="role-rule"><?php echo $k;?></div>
				<ul>
				<?php foreach( $roleRule as $rr ): ?>
					<li><?php echo $rr; ?></li>
				<?php endforeach; ?>		
				</ul>		
			</li>
		<?php endforeach; ?>
		</dd>
		<?php endif; ?>
	</dl>
<?php endforeach; ?>

<h1>Available Rules</h1>
<ul>
<?php foreach( $rules as $key=>$rule ): ?>
	<li>
		<?php echo $key; ?>
		<?php $ruleNames[$key] = $key; ?>
		<ul>
			<?php foreach( $rule as $k => $action ): ?>
				<li><?php echo $action; ?></li>
			<?php endforeach; ?>
		</ul>
	</li>
<?php endforeach; ?>
</ul>

<h3>Add a New Role</h3>
<form method="post" action="<?php echo uri('users/addRole');?>">
	<input type="text" name="name"/>
	<input type="submit" name="submit" value="Add a New Role"/>
</form>

<h3>Add a New Action to a Rule</h3>
<form method="post" action="<?php echo uri('users/addRule'); ?>">
	<?php text(array('name'=>'action', 'id'=>'action'), null, 'Action Name'); ?>
	<?php select(array('name'=>'rule','id'=>'rule'),$ruleNames); ?>
	<?php submit('Add Action'); ?>
</form>

<h3>Delete an Action from a Rule</h3>
<form method="post" action="<?php echo uri('users/deleteRule'); ?>">
	<?php text(array('name'=>'action', 'id'=>'action'), null, 'Action Name'); ?>
	<?php select(array('name'=>'rule','id'=>'rule'),$ruleNames); ?>
	<?php submit('Delete Action'); ?>
</form>

<form action="<?php echo uri('users/deleteRole'); ?>" method="post">
<h3>Delete Roles</h3>
<?php select(array('name' => 'role'), $roles); ?>
<input type="submit" value="Delete The Selected Role" onclick="return confirm('Are you sure you want to delete the selected role?');">
</form>

<br/>
<h3>Alter Role Permissions</h3>
<?php select(array('name' => 'role', 'id'=>'alter_role'), $roles); ?>
<div id="rulesForm"></div>
</div>
<?php foot();?>