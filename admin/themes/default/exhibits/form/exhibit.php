<?php head(); ?>

<form method="post">
	<fieldset>
		<legend>Exhibit Metadata</legend>
		<?php echo flash();?>
	<div class="field"><?php text(array('name'=>'title', 'class'=>'textinput', 'id'=>'title'), $exhibit->title, 'Exhibit Title'); ?></div>
		<div class="field"><?php textarea(array('name'=>'description', 'id'=>'description', 'class'=>'textinput','rows'=>'10','cols'=>'40'), $exhibit->description, 'Exhibit Description'); ?></div>
		<div class="field"><?php textarea(array('name'=>'credits', 'id'=>'credits', 'class'=>'textinput', 'rows'=>'10','cols'=>'40'), $exhibit->credits,'Exhibit Credits'); ?></div>
		
		

		
		<div class="field"><?php text(array('name'=>'tags', 'id'=>'tags', 'class'=>'textinput'), tag_string($exhibit,null,', ',true), 'Exhibit Tags'); ?></div>
		
	<div class="field">
		<div class="label">Exhibit is featured:</div> 
		<div class="radio"><?php radio(array('name'=>'featured', 'id'=>'featured'), array('0'=>'No','1'=>'Yes'), $exhibit->featured); ?></div>
	</div>
	</fieldset>
	<fieldset>
		<legend>Exhibit Display Data</legend>
		<div class="field"><?php select(array('name'=>'theme','id'=>'theme'),get_ex_themes(),$exhibit->theme,'Select a Theme'); ?></div>
			<div class="field"><?php text(array('name'=>'slug', 'id'=>'slug', 'class'=>'textinput'), $exhibit->slug, 'Exhibit Slug (no spaces or special characters)'); ?></div>
		
	</fieldset>
	
		<table>
		<?php foreach( $exhibit->Sections as $key => $section ): ?>
			<tr>
				<td><?php text(array('name'=>"Sections[$key][order]",'size'=>2), $key); ?>
				<td><a href="<?php echo uri('exhibits/editSection/'.$section->id); ?>">[Edit]</a></td>
				<td><a href="<?php echo uri('exhibits/deleteSection/'.$section->id); ?>">[Delete]</a></td>
				<td><?php echo $section->title; ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
		<?php 
			submit('Save &amp; Finish','save_exhibit');
			submit('Re-order the Exhibit Sections','reorder_sections'); 
			submit('Add a New Section to the Exhibit', 'add_section');
		?>
</form>		

<?php foot(); ?>